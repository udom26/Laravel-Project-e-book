<?php

namespace App\Services;

class ApiServiceTransaction
{
    protected $baseUrl;
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->baseUrl = env('NGROK_API_URL');
        $this->authService = $authService;
    }

    public function getAllTransactions()
    {
        $url = $this->baseUrl . 'transactions';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function getTransactionById($id)
    {
        $url = $this->baseUrl . "transactions/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }
    
    public function createTransaction($data)
    {
        $url = $this->baseUrl . 'transactions';
        return $this->authService->apiRequestWithAutoRefresh('POST', $url, ['json' => $data]);
    }

    public function getBorrowUrl($id)
    {
        return $this->baseUrl . "books/{$id}/borrow";
    }
}