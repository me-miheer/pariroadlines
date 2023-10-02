<?php

namespace App\Http\Controllers;

use App\Models\profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request){
        $profiles = profiles::all();
        $data = $profiles->toArray();
        return view('billing.profile')->with(['data' => $data]);
    }

    public function Create(Request $request){
        return view('billing.new-profile');
    }

    public function Save(Request $request){

        // dd(request()->all());exit;

        $validator = $request->validate(
            [
                'name' => 'required|min:3',
                'address' => 'required:min:3',
                'email' => 'required|min:3|email',
                'mobile1' => 'required|min:10',
                'mobile2' => 'required|min:10',
                'gst' => 'required|min:3',
                'account_number' => 'required|min:3',
                'ifsc_code' => 'required|min:3',
                'bank_name' => 'required|min:3',
                'pancard_number' => 'required|min:3',
                'logo' => 'required|image|mimes:png',
                'signature' => 'required|image|mimes:png',
            ]
        );

        $logo_file_name = Crypt::encryptString(time().$request->file('logo')->getClientOriginalName()).'.png';
        $signature_file_name = Crypt::encryptString(time().$request->file('signature')->getClientOriginalName()).'.png';

        $request->file('logo')->storeAs('logo', $logo_file_name, 'public');
        $request->file('signature')->storeAs('signature', $signature_file_name, 'public');

        $requested_data = request()->all();
        $requested_data['logo'] = $logo_file_name;
        $requested_data['signature'] = $signature_file_name;
        $query = profiles::create($requested_data);

        if($query){
            return redirect()->route('profile')->with(['profile_created'=>true, 'profile_created_message'=>'Profile has been created successfully']);
        }else{
            return redirect()->route('profile')->with(['profile_created'=>false, 'profile_created_message'=>'Oops! somthing went wrong.']);
        }
        
    }
}
