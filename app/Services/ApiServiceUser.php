<?php

namespace App\Services;

class ApiServiceUser
{
    protected $baseUrl;
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->baseUrl = env('NGROK_API_URL');
        $this->authService = $authService;
    }

    public function getUsers()
    {
        $url = $this->baseUrl . 'user/all';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function getUser($id)
    {
        $url = $this->baseUrl . "user/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function createUser($data)
    {
        $url = $this->baseUrl . 'user/create';
        return $this->authService->apiRequestWithAutoRefresh('POST', $url, ['json' => $data]);
    }

    public function updateUser($id, $data)
    {
        $url = $this->baseUrl . "user/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('PATCH', $url, ['json' => $data]);
    }

    public function deleteUser($id)
    {
        $url = $this->baseUrl . "user/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('DELETE', $url);
    }
}