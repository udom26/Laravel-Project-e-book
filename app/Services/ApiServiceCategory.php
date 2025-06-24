<?php
namespace App\Services;

use App\Services\ApiServiceRefreshtoken;

class ApiServiceCategory
{
    protected $refreshService;

    public function __construct(ApiServiceRefreshtoken $refreshService)
    {
        $this->refreshService = $refreshService;
    }

    public function createCategory($cate_name, $cate_cover_url)
    {
        $url = env('NGROK_API_URL') . 'categories';
        $data = [
            'cate_name' => $cate_name,
            'cate_cover_url' => $cate_cover_url,
        ];
        return $this->refreshService->callApiWithAutoRefresh('post', $url, $data);
    }

    public function getAllCategories()
    {
        $url = env('NGROK_API_URL') . 'categories';
        return $this->refreshService->callApiWithAutoRefresh('get', $url);
    }

    public function updateCategory($id, $cate_name, $cate_cover_url)
    {
        $url = env('NGROK_API_URL') . "categories/{$id}";
        $data = [
            'cate_name' => $cate_name,
            'cate_cover_url' => $cate_cover_url,
        ];
        return $this->refreshService->callApiWithAutoRefresh('patch', $url, $data);
    }

    public function deleteCategory($id)
    {
        $url = env('NGROK_API_URL') . "categories/{$id}";
        return $this->refreshService->callApiWithAutoRefresh('delete', $url);
    }
}