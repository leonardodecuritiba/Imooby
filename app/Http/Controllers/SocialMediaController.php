<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\Models\Contact;

use Socialite;

class SocialMediaController extends Controller
{
    function __construct()
    {
        $this->middleware('guest')->only(['facebookRedirect']);
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookHandle()
    {
        $fb_user = Socialite::driver('facebook')->user();
        $fb_id = $fb_user->getId();
        if ($user = User::where('social_media_id', $fb_id)->first()) {
            \Auth::login($user);
            return redirect('/');
        } else {
            $email = $fb_user->getEmail();
            if(User::where('email', $email)->count()>0) {
                return redirect()->route('clients.beginForm')->withErrors(['Esse email já está sendo usado em alguma conta']);
            }
            $address = Address::create();
            $contact = Contact::create();
            $user = User::create([
                'email'=>$email,
                'social_media_id'=>$fb_id,
                ]);
            $user->attachRole(2);
            $user->client()->create([
                'idaddress'=>$address->id,
                'idcontact'=>$contact->id,
                'name'=>$fb_user->getName()
                ]);
            \Auth::login($user);
            return redirect('/');
        }
    }
}
