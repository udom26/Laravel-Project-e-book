<?php
namespace App\Services;

use App\Services\ApiServiceRefreshtoken;

class ApiServiceBook
{
    protected $refreshService;

    public function __construct(ApiServiceRefreshtoken $refreshService)
    {
        $this->refreshService = $refreshService;
    }

    public function createBook($book_name, $book_author, $book_description, $book_cover_image_url, $book_reader_url, $categories)
    {
        $url = env('NGROK_API_URL') . 'books';
        $data = [
            'book_name' => $book_name,
            'book_author' => $book_author,
            'book_description' => $book_description,
            'book_cover_image_url' => $book_cover_image_url,
            'book_reader_url' => $book_reader_url,
            'categories' => $categories,
        ];
        return $this->refreshService->callApiWithAutoRefresh('post', $url, $data);
    }

    public function getAllBooks()
    {
        $url = env('NGROK_API_URL') . 'books';
        return $this->refreshService->callApiWithAutoRefresh('get', $url);
    }

    public function getBookById($id)
    {
        $url = env('NGROK_API_URL') . "books/{$id}";
        return $this->refreshService->callApiWithAutoRefresh('get', $url);
    }

    public function updateBook($id, $book_name, $book_author, $book_description, $book_cover_image_url, $book_reader_url, $categories)
    {
        $url = env('NGROK_API_URL') . "books/{$id}";
        $data = [
            'book_name' => $book_name,
            'book_author' => $book_author,
            'book_description' => $book_description,
            'book_cover_image_url' => $book_cover_image_url,
            'book_reader_url' => $book_reader_url,
            'categories' => $categories,
        ];
        return $this->refreshService->callApiWithAutoRefresh('patch', $url, $data);
    }

    public function deleteBook($id)
    {
        $url = env('NGROK_API_URL') . "books/{$id}";
        return $this->refreshService->callApiWithAutoRefresh('delete', $url);
    }

    public function refreshToken()
    {
        $url = env('NGROK_API_URL') . 'auth/refresh';
        $refreshToken = session('refresh_token');
        $response = \Illuminate\Support\Facades\Http::post($url, [
            'refresh_token' => $refreshToken,
        ]);
        if ($response->successful()) {
            // สมมติว่า response มี access_token ใหม่
            session(['access_token' => $response['access_token']]);
            return true;
        }
        return false;
    }
}