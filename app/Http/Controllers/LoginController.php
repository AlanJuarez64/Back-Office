<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
{
    $response = Http::asForm()->post('http://localhost:8001/oauth/token', [
        'grant_type' => 'password',
        'client_id' => env('CLIENT_ID'),
        'client_secret' => env('CLIENT_SECRET'),
        'username' => $request->input('email'),
        'password' => $request->input('password'),
        'scope' => '',
    ]);

    if ($response->successful()) {
        $accessToken = $response->json()['access_token'];;
        Session::put('api_token', $accessToken);
        return redirect('/');
    } else {
        $error = $response->json()['error'];

        return back()->withInput()->withErrors(['login' => $error]);
    }
}

public function logout(Request $request)
{

    $apiToken = session('api_token');
    if ($apiToken) {
        Auth::logout();
        $request->session()->forget('api_token');

        return redirect('/login')->with('logout', true);
    }

    return redirect('/');
}

}
