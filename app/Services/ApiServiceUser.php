<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiServiceUser
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = env('NGROK_API_URL');
        $this->token = session('api_token'); // หรือดึงจาก Auth ตามระบบคุณ
    }
    
    protected function headers()
    {
        return [
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json',
        ];
    }

    public function getUsers()
    {
        return Http::withHeaders($this->headers())
            ->get($this->baseUrl . 'user/all'); 
    }

    public function getUser($id)
    {
        return Http::withHeaders($this->headers())
            ->get($this->baseUrl . "user/{$id}");
    }

    public function createUser($data)
    {
        return Http::withHeaders($this->headers())
            ->post($this->baseUrl . 'user/create', $data);
    }

    public function updateUser($id, $data)
    {
        return Http::withHeaders($this->headers())
            ->patch($this->baseUrl . "user/{$id}", $data);
    }

    public function deleteUser($id)
    {
        return Http::withHeaders($this->headers())
            ->delete($this->baseUrl . "user/{$id}");
    }
}