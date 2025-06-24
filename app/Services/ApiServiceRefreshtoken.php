<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiServiceRefreshtoken
{
    public function refreshToken()
    {
        $refreshToken = session('refresh_token');
        $response = Http::post(env('NGROK_API_URL') . 'auth/refresh', [
            'refresh_token' => $refreshToken,
        ]);
        if ($response->successful()) {
            session([
                'access_token' => $response['access_token'],
                'refresh_token' => $response['refresh_token'],
            ]);
            return true;
        }
        // ถ้า refresh ไม่สำเร็จ
        session()->flush();
        return false;
    }
    
    public function callApiWithAutoRefresh($method, $url, $data = [])
    {
        $token = session('access_token');
        $response = \Illuminate\Support\Facades\Http::withToken($token)->$method($url, $data);

        if ($response->status() === 401) {
            // ลอง refresh token
            if (app(\App\Services\ApiServiceAuth::class)->refreshToken()) {
                // ได้ access token ใหม่ ลองเรียก API ซ้ำ
                $token = session('access_token');
                $response = \Illuminate\Support\Facades\Http::withToken($token)->$method($url, $data);
            }
        }
        return $response;
    }
}