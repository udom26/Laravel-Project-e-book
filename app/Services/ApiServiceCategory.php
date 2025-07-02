<?php
namespace App\Services;

class ApiServiceCategory
{
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->authService = $authService;
    }

    public function createCategory($cate_name, $cate_cover_url)
    {
        $url = env('NGROK_API_URL') . 'categories';
        $data = [
            'cate_name' => $cate_name,
            'cate_cover_url' => $cate_cover_url,
        ];
        return $this->authService->apiRequestWithAutoRefresh('POST', $url, ['json' => $data]);
    }

    public function getAllCategories()
    {
        $url = env('NGROK_API_URL') . 'categories';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function updateCategory($id, $cate_name, $cate_cover_url)
    {
        $url = env('NGROK_API_URL') . "categories/{$id}";
        $data = [
            'cate_name' => $cate_name,
            'cate_cover_url' => $cate_cover_url,
        ];
        return $this->authService->apiRequestWithAutoRefresh('PATCH', $url, ['json' => $data]);
    }

    public function deleteCategory($id)
    {
        $url = env('NGROK_API_URL') . "categories/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('DELETE', $url);
    }
}