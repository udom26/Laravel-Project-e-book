<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceBook;
use App\Services\ApiServiceCategory;

class BookController extends Controller
{
    protected $apiServiceBook;
    protected $apiServiceCategory;

    public function __construct(ApiServiceBook $apiServiceBook, ApiServiceCategory $apiServiceCategory)
    {
        $this->apiServiceBook = $apiServiceBook;
        $this->apiServiceCategory = $apiServiceCategory;
    }

    public function index(Request $request)
    {
        // รับค่าหมวดหมู่ที่เลือกจากหน้าเว็บ (category_id)
        $selectedCategoryId = $request->input('category_id');
        $itemlimit = $request->input('itemlimit');
        $page = $request->input('page');

        // ดึง list หมวดหมู่ทั้งหมดสำหรับ select
        $categoriesResponse = $this->apiServiceCategory->getAllCategories();
        $categoriesJson = $categoriesResponse->json();

        if (is_array($categoriesJson) && isset($categoriesJson['data'])) {
            $categories = $categoriesJson['data'];
        } elseif (is_array($categoriesJson) && isset($categoriesJson[0]['_id'])) {
            $categories = $categoriesJson;
        } else {
            $categories = [];
        }

        // หา cate_name จาก id ที่เลือก
        $selectedCategoryName = null;
        if ($selectedCategoryId && !empty($categories)) {
            $cate = collect($categories)->firstWhere('_id', $selectedCategoryId);
            $selectedCategoryName = $cate['cate_name'] ?? null;
        }

        $params = [
            // ส่ง cate_name ไปเป็น categories ให้ API
            'categories' => $selectedCategoryName,
            'itemlimit' => $itemlimit,
            'page' => $page,
        ];

        $booksResponse = $this->apiServiceBook->advancedSearchBooks($params);
        $books = $booksResponse->successful() ? $booksResponse->json() : [];
        $bookList = isset($books['data']) ? $books['data'] : [];

        return view('admin.book', [
            'books' => $bookList,
            'categories' => $categories,
            'meta' => $books['meta'] ?? null
        ]);
    }

    public function create()
    {
        $categories = $this->apiServiceCategory->getAllCategories()->json();
        return view('admin.book-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name' => 'required|string',
            'book_author' => 'required|string',
            'book_description' => 'required|string',
            'book_cover_image_url' => 'required|string',
            'book_reader_url' => 'required|string',
            'categories' => 'required|array',
        ]);

        // ดึงข้อมูลหมวดหมู่ที่เลือก
        $selectedCategories = [];
        foreach ($data['categories'] as $cateId) {
            $selectedCategories[] = [
                '_id' => $cateId,
                'cate_name' => $request->input('cate_name_' . $cateId, ''),
            ];
        }

        $response = $this->apiServiceBook->createBook(
            $data['book_name'],
            $data['book_author'],
            $data['book_description'],
            $data['book_cover_image_url'],
            $data['book_reader_url'],
            $selectedCategories
        );

        if ($response->successful()) {
            return redirect()->route('book')->with('success', 'เพิ่มหนังสือสำเร็จ!');
        } else {
            $errorMsg = $response->json('message') ?? 'เพิ่มหนังสือไม่สำเร็จ';
            return redirect()->back()->with('error', $errorMsg);
        }
    }

    public function show($id)
    {
        $response = $this->apiServiceBook->getBookById($id);
        if ($response->successful()) {
            $book = $response->json();
            return view('admin.book-show', compact('book'));
        }
        return redirect()->route('book')->with('error', 'ไม่พบข้อมูลหนังสือ');
    }

    public function edit($id)
    {
        $bookResponse = $this->apiServiceBook->getBookById($id);
        $categoriesResponse = $this->apiServiceCategory->getAllCategories();
        $categoriesJson = $categoriesResponse->json();

        if ($bookResponse->successful()) {
            $book = $bookResponse->json();
            if (is_array($categoriesJson) && isset($categoriesJson['data'])) {
                $categories = $categoriesJson['data'];
            } elseif (is_array($categoriesJson)) {
                $categories = $categoriesJson;
            } else {
                $categories = [];
            }
            return view('admin.book-edit', compact('book', 'categories'));
        }
        return redirect()->route('book')->with('error', 'ไม่พบข้อมูลหนังสือหรือหมวดหมู่');
    }

    public function destroy($id)
    {
        $response = $this->apiServiceBook->deleteBook($id);
        if ($response->successful()) {
            return redirect()->route('book')->with('success', 'ลบหนังสือสำเร็จ');
        }
        return redirect()->route('book')->with('error', 'ลบหนังสือไม่สำเร็จ');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'book_name' => 'required|string',
            'book_author' => 'required|string',
            'book_description' => 'required|string',
            'book_cover_image_url' => 'required|string',
            'book_reader_url' => 'required|string',
            'categories' => 'required|array',
        ]);

        // ดึงหมวดหมู่ทั้งหมด
        $allCategories = $this->apiServiceCategory->getAllCategories()->json();
        if (isset($allCategories['data'])) {
            $allCategories = $allCategories['data'];
        }

        // เตรียม categories สำหรับ API (มีทั้ง _id และ cate_name)
        $selectedCategories = [];
        foreach ($data['categories'] as $cateId) {
            $cate = collect($allCategories)->firstWhere('_id', $cateId);
            $selectedCategories[] = [
                '_id' => $cateId,
                'cate_name' => $cate['cate_name'] ?? '',
            ];
        }

        $response = $this->apiServiceBook->updateBook(
            $id,
            $data['book_name'],
            $data['book_author'],
            $data['book_description'],
            $data['book_cover_image_url'],
            $data['book_reader_url'],
            $selectedCategories
        );

        if ($response->successful()) {
            return redirect()->route('book')->with('success', 'อัปเดตหนังสือสำเร็จ!');
        } else {
            $errorMsg = $response->json('message') ?? 'อัปเดตหนังสือไม่สำเร็จ';
            return redirect()->back()->with('error', $errorMsg);
        }
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $categoryId = $request->input('category_id');

        $params = [];
        if ($q) {
            $params['book_name'] = $q;
        }
        if ($categoryId) {
            $params['categories'] = $categoryId;
        }

        $booksResponse = $this->apiServiceBook->advancedSearchBooks($params);
        $books = $booksResponse->successful() ? ($booksResponse->json()['data'] ?? []) : [];

        $categoriesResponse = $this->apiServiceCategory->getAllCategories();
        $categories = $categoriesResponse->successful()
            ? ($categoriesResponse->json()['data'] ?? [])
            : [];

        return view('ebook.search', compact('books', 'categories'));
    }

    public function detail($id)
    {
        $book = app(\App\Services\ApiServiceBook::class)->getBookById($id)->json();
        return view('ebook.detail', compact('book'));
    }

    public function suggestions()
    {
        $booksResponse = $this->apiServiceBook->getBookSuggestions();
        $books = $booksResponse->successful() ? $booksResponse->json() : [];

        return view('ebook.suggestions', [
            'books' => $books
        ]);
    }
}