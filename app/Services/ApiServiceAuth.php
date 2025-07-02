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

    public function apiRequestWithAutoRefresh($method, $url, $options = [])
    {
        $accessToken = session('access_token');
        $refreshToken = session('refresh_token');

        $response = Http::withToken($accessToken)->send($method, $url, $options);

        if ($response->status() === 401 && $refreshToken) {
            // ขอ access token ใหม่
            $refreshResponse = Http::withToken($refreshToken)
                ->post($this->baseUrl . 'auth/refresh');
            if ($refreshResponse->successful()) {
                $newAccessToken = $refreshResponse->json('accessToken');
                session(['access_token' => $newAccessToken]);
                // retry request เดิม
                $response = Http::withToken($newAccessToken)->send($method, $url, $options);
            } else {
                session()->flush();
                return response()->json(['message' => 'กรุณาเข้าสู่ระบบใหม่'], 401);
            }
        }
        return $response;
    }

    public function logout()
    {
        $accessToken = session('access_token');
        return \Illuminate\Support\Facades\Http::withToken($accessToken)
            ->post($this->baseUrl . 'auth/logout');
    }
}