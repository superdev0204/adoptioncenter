<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use App\Models\Resources;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $states = States::where('country', 'US')->get();

        $agencies = Agency::where('approved', 1)
                        ->orderByDesc('created_date')
                        ->limit(20)
                        ->get();

        $resources = Resources::where('approved', 1)
                            ->orderByDesc('created_date')
                            ->limit(2)
                            ->get();

        // foreach ($shelters as $shelter){
        //     $shelter->phone = $this->formatPhoneNumber($shelter->phone);
        // }

        return view('index', compact('states', 'agencies', 'resources', 'user'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $message = 'Please enter one of the following criteria for search.';
        return view('search', compact('user', 'message'));
    }

    public function search_results(Request $request)
    {
        $user = Auth::user();
        
        $withErrors = [];
        if(!$request->location){
            $withErrors['location'] = 'The location field is required';
        }

        if($request->location && strlen($request->location) < 3){
            $withErrors['location'] = 'The location field must be at least 5 characters.';
        }

        // if(!$request->name){
        //     $withErrors['name'] = 'The name field is required';
        // }
        
        if($request->name && strlen($request->name) < 5){
            $withErrors['name'] = 'The name field must be at least 5 characters.';
        }

        // if(!$request->address){
        //     $withErrors['address'] = 'The address field is required';
        // }
        
        if($request->address && strlen($request->address) < 5){
            $withErrors['address'] = 'The address field must be at least 5 characters.';
        }

        // if(!$request->phone){
        //     $withErrors['phone'] = 'The phone field is required';
        // }
        
        if($request->phone && strlen($request->phone) < 10){
            $withErrors['phone'] = 'The phone field must be at least 10 characters.';
        }

        if(count($withErrors) > 0){
            $message = 'Please enter one of the following criteria for search.';
            return view('search', compact('user', 'message', 'request'))->withErrors($withErrors);
        }

        $query = Agency::where('approved', 1)
                        ->limit(100);

        if (preg_match('/\d+/', $request->location, $matches)) {
            $query->where('zip', $matches[0]);
        } else {
            @list($city, $stateCode) = explode(',', $request->location);

            if ($city) {
                $query->where('city', trim($city));
            }

            if ($stateCode) {
                $query->where('state', trim($stateCode));
            }
        }

        if ($request->name) {
            $query->where('name', $request->name);
        }

        if ($request->address) {
            $query->where('address', $request->address);
        }

        if ($request->phone) {
            $query->where('phone', $request->phone);
        }

        $agencies = $query->get();

        if (!count($agencies)) {
            $message = 'There is no result for your selected criteria.  Please try again with different criteria.';
        }
        else{
            $message = 'There are ' . count($agencies) . ' agencies found.';
        }
    
        return view('search_results', compact('agencies', 'user', 'message', 'request'));
    }

    public function about()
    {
        $user = Auth::user();
        return view('about', compact('user'));
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
}
