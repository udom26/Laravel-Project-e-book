<?php

namespace App\Services;

class ApiServiceSeach
{
    protected $baseUrl;
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->baseUrl = env('NGROK_API_URL');
        $this->authService = $authService;
    }

    public function simpleSearch($query)
    {
        $url = $this->baseUrl . 'books/search/simple?q=' . urlencode($query);
        return $this->authService->apiRequestWithAutoRefresh('GET',$url);
    }
}