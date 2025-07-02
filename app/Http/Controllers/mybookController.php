<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceBook;

class MybookController extends Controller
{
    public function index(Request $request)
    {
        $response = app(ApiServiceBook::class)->getMyBooks();
        $borrowedBooks = $response->successful() ? collect($response->json('borrowedBooks')) : collect();

        // แปลงเป็น LengthAwarePaginator
        $perPage = 2;
        $page = $request->input('page', 1);
        $pagedData = $borrowedBooks->slice(($page - 1) * $perPage, $perPage)->values();
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $borrowedBooks->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('ebook.mybook', ['borrowedBooks' => $paginated]);
    }
}