<?php

namespace App\Http\Controllers;

use App\Services\ApiServiceBook;

class BookController extends Controller
{
    public function index()
    {
        $suggestions = app(ApiServiceBook::class)->getSuggestions();
        $suggestions = $suggestions->successful() ? $suggestions->json() : [];

        // ดึงรายการหนังสือที่ user ยืมอยู่
        $borrowedBookIds = [];
        if (auth()->check()) {
            $myBooksResponse = app(ApiServiceBook::class)->getMyBooks();
            $borrowedBooks = $myBooksResponse->successful() ? $myBooksResponse->json('borrowedBooks') : [];
            $borrowedBookIds = collect($borrowedBooks)->pluck('_id')->toArray();
        }

        // เพิ่ม is_borrowed ให้แต่ละเล่ม
        if (!empty($suggestions['data'])) {
            foreach ($suggestions['data'] as &$book) {
                $book['is_borrowed'] = in_array($book['_id'], $borrowedBookIds);
            }
        }

        return view('ebook.home', compact('suggestions'));
    }
}