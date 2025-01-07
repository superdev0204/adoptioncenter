<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agency;
use App\Models\States;

class AgencyController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();
        $method = $request->method();

        if(!$user || $user->type != 'ADMIN'){
            return redirect('/user/login');
        }

        $states = States::all();
        
        if ($method == "POST") {
            $post = $request->all();
            $post = array_filter($post);
            unset($post['search']);
            unset($post['_token']);

            if (empty($post)) {
                $message = 'Please enter a search criteria!';
                return view('admin.agency_search', compact('user', 'states', 'request', 'message'));
            }

            $query = Agency::orderBy('name', 'asc');
            if($request->name){
                $values = explode(' ', $request->name);
                foreach ($values as $value) {
                    $query->where('name', 'like', '%' . $value . '%');
                }
            }

            if($request->phone){
                $strippedPhoneNumber = preg_replace("/[^0-9]/", "", $request->phone);
                if (strlen($strippedPhoneNumber) == 10) {
                    $query->where('phone', 'like', '%' . substr($strippedPhoneNumber, 0, 3) . '%')
                        ->where('phone', 'like', '%' . substr($strippedPhoneNumber, 3, 3) . '-' . substr($strippedPhoneNumber, -4));
                } else {
                    $query->where('phone', 'like', '%' . $request->phone . '%');
                }
            }

            if($request->address){
                $query->where('address', 'like', '%' . $request->address . '%');
            }

            if($request->zip){
                $query->where('zip', $request->zip);
            }

            if($request->city){
                $query->where('city', $request->city);
            }

            if($request->state){
                $query->where('state', $request->state);
            }

            if($request->email){
                $query->where('email', $request->email);
            }

            if($request->id){
                $query->where('id', $request->id);
            }

            $agencies = $query->limit(100)->get();

            return view('admin.agency_search', compact('user', 'states', 'request', 'agencies'));
        }

        return view('admin.agency_search', compact('user', 'states', 'request'));
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        if(!$user || $user->type != 'ADMIN'){
            return redirect('/user/login');
        }

        $states = States::all();
        
        $id = $request->id;

        if (!$id) {
            return redirect('/');
        }

        $method = $request->method();
        $message = '';
        
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

            $validated = $request->validate($valid_item);

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

        return view('admin.agency_edit', compact('agency', 'states', 'user', 'message', 'request'));
    }

    public function approve(Request $request)
    {
        $user = Auth::user();
        $method = $request->method();
        
        $id = $request->id;

        if (!$method == "POST" || !$id) {
            return redirect('/admin');
        }

        $agency = Agency::where('id', $id)->first();

        $coordinates = $this->geocode($agency->address, $agency->city, $agency->state, $agency->zip);
        if ($coordinates) {
            $coordinatesSplit = explode(",", $coordinates,2);
            $agency->lat = $coordinatesSplit[1];
            $agency->lng = $coordinatesSplit[0];
        }

        $agency->approved = 1;
        $agency->save();
        
        return redirect('/admin');
    }

    public function disapprove(Request $request)
    {
        $user = Auth::user();
        $method = $request->method();

        $id = $request->id;

        if (!$method == "POST" || !$id) {
            return redirect('/admin');
        }

        $agency = Agency::where('id', $id)->first();

        $agency->approved = -2;
        $agency->save();

        return redirect('/admin');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $method = $request->method();

        $id = $request->id;

        if (!$method == "POST" || !$id) {
            return redirect('/admin');
        }

        $agency = Agency::where('id', $id)->first();

        $agency->delete();

        return redirect('/admin');
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
}
