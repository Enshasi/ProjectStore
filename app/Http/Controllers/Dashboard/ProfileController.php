<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Countries;
class ProfileController extends Controller
{
   public function edit(){
    $user = Auth::user();
    $languages = Languages::getNames();
    $countries = Countries::getNames();
    return view('dashboard.profiles.edit' , compact('user' , 'languages' , 'countries'));
   }
   public function update(Request $request){

    $user = $request->user(); //=== Auth::user();
    $request->validate([
        'first_name' =>['required' , 'min:5' , 'max:100'],
        'last_name' =>['required' , 'min:5' , 'max:100'],
        'country' =>['required'],
        'birthday' =>['nullable' , 'date'],
        'gender' => ['in:male,female'],
    ]);


    $user->profile->fill($request->all())->save();
    toastr()->success('Successfully Update Profile');
    return redirect()->route('dashboard.profile.edit');
   }
}
