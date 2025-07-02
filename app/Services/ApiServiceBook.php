<?php
namespace App\Services;

class ApiServiceBook
{
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->authService = $authService;
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
        return $this->authService->apiRequestWithAutoRefresh('POST', $url, ['json' => $data]);
    }

    public function getAllBooks()
    {
        $url = env('NGROK_API_URL') . 'books';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function getBookById($id)
    {
        $url = env('NGROK_API_URL') . "books/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
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
        return $this->authService->apiRequestWithAutoRefresh('PATCH', $url, ['json' => $data]);
    }

    public function deleteBook($id)
    {
        $url = env('NGROK_API_URL') . "books/{$id}";
        return $this->authService->apiRequestWithAutoRefresh('DELETE', $url);
    }

    public function getMyBooks()
    {
        $url = env('NGROK_API_URL') . 'books/my-borrowed';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function getBookSuggestions()
    {
        $url = env('NGROK_API_URL') . 'books/suggestions';
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function getBooksByName($book_name)
    {
        $url = env('NGROK_API_URL') . 'books?book_name=' . urlencode($book_name);
        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }

    public function advancedSearchBooks($params = [])
    {
        $url = env('NGROK_API_URL') . 'books/search/advanced';

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $this->authService->apiRequestWithAutoRefresh('GET', $url);
    }
}