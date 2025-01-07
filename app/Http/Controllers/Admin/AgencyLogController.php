<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agencylog;
use App\Models\Agency;

class AgencyLogController extends Controller
{
    public function show(Request $request, string $id)
    {
        $user = Auth::user();

        if(isset($user->type) && $user->type == 'ADMIN'){
            $agencyLog = Agencylog::with('agency')->find($id);

            return view('admin.agencylog', compact('agencyLog', 'user'));
        }
        else{
            return redirect('/user/login');
        }
    }

    public function approve(Request $request)
    {
        // dd($request->all());
        if (!$request->isMethod('post')){

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $agencyLog = Agencylog::with('agency')->find($request->id);

        $fields = array_keys($agencyLog->getEditableFields());

        $update_agency = [];

        $agency = Agency::find($agencyLog->agency_id);
        
        foreach ($fields as $key => $field) {
            if ($agencyLog->$field == $agencyLog->agency->$field) {
                continue;
            }

            $update_agency[$field] = $agencyLog->$field;
        }
        $current_date = date('Y-m-d H:i:s');
        $update_agency['updated'] = $current_date;
        $update_agency['user_id'] = $agencyLog->user_id;

        $agency->update($update_agency);
        
        $_agencyLog = Agencylog::find($request->id);
        $_agencyLog->update(['approved' => 1, 'updated' => $current_date]);

        return redirect()->route('admin');
    }

    public function disapprove(Request $request)
    {
        $agencyLog = Agencylog::with('agency')->find($request->id);

        if (!$request->isMethod('post')){

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $agencyLog->update(['approved' => -1]);

        return redirect()->route('admin');
    }

    public function delete(Request $request)
    {
        $agencyLog = Agencylog::with('agency')->find($request->id);

        if (!$request->isMethod('post')){

            return response()->json(['error' => true, 'data' => []], 404);
        }

        $agencyLog->delete($agencyLog->id);

        return redirect()->route('admin');
    }
}
