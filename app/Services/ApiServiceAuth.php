<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiServiceAuth
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('NGROK_API_URL');
    }

    public function login($email, $password)
    {
        return Http::post($this->baseUrl . 'auth/login', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function register($email, $password, $name, $surname)
    {
        return Http::post($this->baseUrl . 'user/register', [
            
            'email' => $email,
            'password' => $password,
            'name' => $name,
            'surname' => $surname, 
        ]);
    }

    public function refreshToken()
    {
        $refreshToken = session('refresh_token');
        $response = \Illuminate\Support\Facades\Http::post(env('NGROK_API_URL') . 'auth/refresh', [
            'refresh_token' => $refreshToken,
        ]);
        if ($response->successful()) {
            session([
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
            ]);
            return true;
        }
        session()->flush();
        return false;
    }
}