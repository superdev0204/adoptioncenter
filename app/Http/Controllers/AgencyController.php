<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReCaptcha\ReCaptcha;
use App\Models\Agency;
use App\Models\Agencylog;
use App\Models\Questions;
use App\Models\Answers;
use App\Helper\Helper;
use App\Models\States;
use App\Models\Resources;
use App\Models\Comments;
use App\Models\Cities;
use Carbon\Carbon;
use App\Services\BadWordService;

class AgencyController extends Controller
{
    protected $badWordService;

    public function __construct(BadWordService $badWordService)
    {
        $this->badWordService = $badWordService;
    }

    public function state(Request $request)
    {
        $user = Auth::user();

        $stateName = request()->route()->parameter('statename');
        
        $state = States::where('statefile', $stateName)->first();

        if (!$state) {
            return redirect('/');
        }

        $cities = Cities::where('state', $state->state_code)
                        ->where('agencies_count', '>', 0)
                        ->get();

        $resources = Resources::where('approved', 1)
                            ->orderBy('created_date', 'desc')
                            ->limit(2)
                            ->get();

        $agencies = Agency::where('approved', 1)
                        ->where('state', $state->state_code)
                        ->limit(10)
                        ->get();

        $parsedUrl = parse_url(url()->current());
        // Get the path and query
        $page_url = $parsedUrl['path'] . (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');
        $questions = Questions::where(function($query) use ($page_url) {
                                $query->where('agency_id', 0)
                                    ->orWhere('page_url', $page_url);
                            })
                            ->where('approved', '1')
                            ->orderBy('created_at', 'desc')
                            ->get();
        foreach ($questions as $question) {
            $answers = Answers::where('question_id', $question->id)
                                ->where('page_url', $page_url)
                                ->where('approved', '1')
                                ->orderBy('created_at', 'desc')
                                ->get();
            if( !empty($answers) ){
                foreach ($answers as $answer) {
                    $answer->answer_by = $this->badWordService->maskBadWords($answer->answer_by);
                    $answer->answer = $this->badWordService->maskBadWords($answer->answer);
                }
                $question->answers = $answers;
            }
            else{
                $question->answers = [];
            }

            $created = Carbon::createFromFormat('Y-m-d H:i:s', $question->created_at);
            $now = Carbon::now();
            $interval = $now->diff($created);

            $question->passed = $this->formatInterval($interval);
            $question->question_by = $this->badWordService->maskBadWords($question->question_by);
            $question->question = $this->badWordService->maskBadWords($question->question);
        }

        return view('agency_state', compact('user', 'agencies', 'state', 'cities', 'resources', 'questions', 'page_url'));
    }

    public function city(Request $request)
    {
        $user = Auth::user();

        $filename = request()->route()->parameter('filename');

        /** @var City $city */
        
        $city = Cities::where('filename', $filename)->first();

        if (!$city) {
            return redirect('/');
        }

        $resources = Resources::where('approved', 1)
                            ->orderBy('created_date', 'desc')
                            ->limit(2)
                            ->get();

        /** @var State $state */
        $state = States::where('state_code', $city->state)->first();
        
        $agencies = Agency::where('approved', 1)
                        ->where('state', $city->state)
                        ->where('city', $city->city)
                        ->get();

        $parsedUrl = parse_url(url()->current());
        // Get the path and query
        $page_url = $parsedUrl['path'] . (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');
        $questions = Questions::where(function($query) use ($page_url) {
                                $query->where('agency_id', 0)
                                    ->orWhere('page_url', $page_url);
                            })
                            ->where('approved', '1')
                            ->orderBy('created_at', 'desc')
                            ->get();
        foreach ($questions as $question) {
            $answers = Answers::where('question_id', $question->id)
                                ->where('page_url', $page_url)
                                ->where('approved', '1')
                                ->orderBy('created_at', 'desc')
                                ->get();
            if( !empty($answers) ){
                foreach ($answers as $answer) {
                    $answer->answer_by = $this->badWordService->maskBadWords($answer->answer_by);
                    $answer->answer = $this->badWordService->maskBadWords($answer->answer);
                }
                $question->answers = $answers;
            }
            else{
                $question->answers = [];
            }

            $created = Carbon::createFromFormat('Y-m-d H:i:s', $question->created_at);
            $now = Carbon::now();
            $interval = $now->diff($created);

            $question->passed = $this->formatInterval($interval);
            $question->question_by = $this->badWordService->maskBadWords($question->question_by);
            $question->question = $this->badWordService->maskBadWords($question->question);
        }

        return view('agency_city', compact('user', 'agencies', 'state', 'city', 'resources', 'questions', 'page_url'));
    }
    
    public function view(Request $request)
    {
        $user = Auth::user();

        /** @var Agency $agency */
        $agency = Agency::where('id', request()->route()->parameter('id'))->first();

        if (!$agency) {
            return redirect('/');
        }

        if (!$agency->lat || !$agency->lng) {
            $coordinates = $this->geocode($agency->address, $agency->city, $agency->state, $agency->zip);
            if ($coordinates) {
                $coordinatesSplit = explode(",", $coordinates,2);
                $agency->lat = $coordinatesSplit[1];
                $agency->lng = $coordinatesSplit[0];

                $agency->save();
            }
        }

        /** @var City $city */
        $city = Cities::where('state', $agency->state)
                    ->where('city', $agency->city)
                    ->first();

        $state = null;
        if ($city) {
            /** @var State $state */
            $state = States::where('state_code', $city->state)->first();
        }

        $resources = Resources::where('approved', 1)
                            ->orderBy('created_date', 'desc')
                            ->limit(2)
                            ->get();

        $comments = Comments::where('approved', 1)
                            ->where('agency_id', $agency->id)
                            ->get();

        foreach($comments as $comment){
            $comment->name = $this->badWordService->maskBadWords($comment->name);
            $comment->comment = $this->badWordService->maskBadWords($comment->comment);
        }

        $agency->website = $this->formatURL($agency->website);

        $agencyId = $agency->id;
        $questions = Questions::where(function($query) use ($agencyId) {
                                $query->where('agency_id', 0)
                                    ->orWhere('agency_id', $agencyId);
                            })
                            ->where('approved', '1')
                            ->orderBy('created_at', 'desc')
                            ->get();
        foreach ($questions as $question) {
            $answers = Answers::where('question_id', $question->id)
                                ->where('agency_id', $agencyId)
                                ->where('approved', '1')
                                ->orderBy('created_at', 'desc')
                                ->get();
            if( !empty($answers) ){
                foreach ($answers as $answer) {
                    $answer->answer_by = $this->badWordService->maskBadWords($answer->answer_by);
                    $answer->answer = $this->badWordService->maskBadWords($answer->answer);
                }
                $question->answers = $answers;
            }
            else{
                $question->answers = [];
            }

            $created = Carbon::createFromFormat('Y-m-d H:i:s', $question->created_at);
            $now = Carbon::now();
            $interval = $now->diff($created);

            $question->passed = $this->formatInterval($interval);
            $question->question_by = $this->badWordService->maskBadWords($question->question_by);
            $question->question = $this->badWordService->maskBadWords($question->question);
        }

        return view('agency_show', compact('agency', 'state', 'city', 'resources', 'comments', 'questions', 'user'));
    }

    public function comment(Request $request)
    {        
        $user = Auth::user();
        
        if ( !$request->id ) {
            return redirect('/');
        }

        /** @var Agency $agency */
        $agency = Agency::where('id', $request->id)->first();

        if (!$agency) {
            return redirect('/');
        }

        $message = 'You can leave a message using the form below.';
        $review = [];

        if ($request->isMethod('post')){
            $recaptcha = new ReCaptcha(env('DATA_SECRETKEY'));
            $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

            $withErrors = [];
            if(!$request->comment){
                $withErrors['comment'] = 'The comment field is required';
            }

            if ($response->isSuccess()) {
                // reCAPTCHA verification successful, process the form submission
            }
            else{
                $withErrors['recaptcha-token'] = 'The recaptcha-token field is required.';
            }

            if(!$request->email){
                $withErrors['email'] = 'The email field is required';
            }

            if(!$request->name){
                $withErrors['name'] = 'The name field is required';
            }

            if($request->name && strlen($request->name) < 5){
                $withErrors['name'] = 'The name field must be at least 5 characters.';
            }

            if(count($withErrors) > 0){
                return view('review', compact('user', 'review', 'message', 'request', 'agency'))->withErrors($withErrors);
            }
            
            $review = Comments::create([
                'agency_id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
                'approved' => 0,
                'ip_address' => request()->ip(),
                'created' => new \DateTime()
            ]);
            
            $message = 'Your comment is successfully save.  It will be displayed after we review and approve your comment.';
        }

        return view('review', compact('user', 'review', 'agency', 'message'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        // if(!$user){
        //     return redirect('/user/login');
        // }

        $states = States::orderBy('id')->get();
        $message = '';
        $agency = [];
        $recaptcha = new ReCaptcha(env('DATA_SECRETKEY'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

        if ($request->isMethod('post')){
            $valid_item = [
                'name' => 'required|min:5',
                'address' => 'required|min:5',
                'city' => 'required|min:3',
                'county' => 'required|min:3',
                'state' => 'required',
                'zip' => 'required|min:5',
                'phone' => 'required|min:10',
                'contact' => 'required|min:5',
                'email' => 'required|email',
            ];

            if($request->details){
                $valid_item['details'] = 'required|min:50';
            }

            if ($response->isSuccess()) {
                // reCAPTCHA verification successful, process the form submission
            }
            else{
                $valid_item['recaptcha-token'] = 'required';
            }

            $validated = $request->validate($valid_item);
            
            $push_data = [
                'name' => $request->name,
                'address' => $request->address,
                'city' => $request->city,
                'county' => $request->county,
                'state' => $request->state,
                'zip' => $request->zip,
                'phone' => $request->phone,
                'contact' => $request->contact,
                'email' => $request->email,
                'website' => ($request->website) ? $request->website : "",
                'details' => ($request->details) ? $request->details : "",
                'created_date' => new \DateTime(),
                'approved' => 0,
                'status' => '',
                'district_office' => '',
                'do_phone' => '',
                'license_no' => '',
                'services' => '',
                'adoption_process' => '',
                'lat' => 0,
                'lng' => 0,
            ];

            $agency = Agency::create($push_data);
            $message = '<br/> Thank you for submiting the information.  <br/> <br/> The listing will be verified before being set LIVE on AdoptionCenter.us';
        }

        return view('agency_form', compact('message', 'states', 'user', 'request', 'agency'));
    }
    
    public function edit(Request $request)
    {
        $user = Auth::user();
        if(!$user){
            return redirect('/user/login?return_url='.$request->fullUrl());
        }

        $states = States::all();
        
        $id = $request->id;

        if (!$id) {
            return redirect('/');
        }

        $method = $request->method();
        $message = '';
        $recaptcha = new ReCaptcha(env('DATA_SECRETKEY'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());

        $agency = Agency::where('id', $id)->first();

        if (!$agency) {
            return redirect('/');
        }

        if ($method == "POST") {
            $valid_item = [
                'name' => 'required|min:5',
                'address' => 'required|min:5',
                'city' => 'required|min:3',
                'county' => 'required|min:3',
                'state' => 'required',
                'zip' => 'required|min:5',
                'phone' => 'required|min:10',
                'contact' => 'required|min:5',
                'email' => 'required|email',
            ];

            if($request->details){
                $valid_item['details'] = 'required|min:50';
            }

            if ($response->isSuccess()) {
                // reCAPTCHA verification successful, process the form submission
            }
            else{
                $valid_item['recaptcha-token'] = 'required';
            }

            $validated = $request->validate($valid_item);

            $push_data = [];
            if ( !isset($user->type) || (isset($user->type) && $user->type != "ADMIN") ) {
                $push_data = [
                    'agency_id' => $id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'city' => $request->city,
                    'county' => $request->county,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'phone' => $request->phone,
                    'contact' => $request->contact,
                    'email' => $request->email,
                    'website' => ($request->website) ? $request->website : "",
                    'details' => ($request->details) ? $request->details : "",
                    'created' => new \DateTime(),
                    'updated' => new \DateTime(),
                    'approved' => 0,
                    'user_id' => $user->id,
                    'ip_address' => request()->ip(),                    
                ];

                $agency = Agencylog::create($push_data);
                $message = 'Thank you for the updates. The changes have been saved. <br/>All updated listings will be verified before being set LIVE on AdoptionCenter.us';
            }
            else{
                $agency->name = $request->name;
                $agency->address = $request->address;
                $agency->city = $request->city;
                $agency->county = $request->county;
                $agency->state = $request->state;
                $agency->zip = $request->zip;
                $agency->phone = $request->phone;
                $agency->contact = $request->contact;
                $agency->email = $request->email;
                $agency->website = ($request->website) ? $request->website : "";
                $agency->details = ($request->details) ? $request->details : "";
                
                $agency->save();
                $message = 'The information is updated successfully';
            }
        }

        return view('agency_edit', compact('agency', 'states', 'user', 'message', 'request'));
    }

    public function geocode($street, $city, $state, $zip)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false";

        $address = $street . " " . $city . " " . $state . " " . $zip;

        $requestUrl = $url . "&address=" . urlencode($address);
        $xml = simplexml_load_file($requestUrl);

        if (!$xml) {
            return false;
        }

        $status = $xml->status;

        if (strcmp($status, "OK") == 0) {
            $location = $xml->result->geometry->location;

            return $location->lng . "," . $location->lat;
        } else {
            return false;
        }
    }

    public function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);

		if(strlen($phoneNumber) == 7) {
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phoneNumber);
        } elseif(strlen($phoneNumber) == 10) {
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phoneNumber);
        } else {
            return $phoneNumber;
        }
	}

    public function formatURL($url)
    {
        if(preg_match( "/[http|https]:/i",$url)) {
			return "<a href=\"$url\" rel=\"nofollow\" target=\"blank\">$url</a>";			
		} else if(preg_match( "/[@|\s]/i",$url) == false && preg_match( "/\.[com|org|net|info|us|co|biz]/i",$url)) {
			return "<a href=\"http://$url\" rel=\"nofollow\" target=\"blank\">$url</a>";
		} else {
			return $url;
		}
	}

    public function formatInterval($interval) {
        if ($interval->y > 0) {
            return $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
        } elseif ($interval->m > 0) {
            return $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
        } elseif ($interval->d > 0) {
            return $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
        } elseif ($interval->h > 0) {
            return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '');
        } elseif ($interval->i > 0) {
            return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
        } else {
            return $interval->s . ' second' . ($interval->s > 1 ? 's' : '');
        }
    }
}
