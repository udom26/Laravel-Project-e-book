<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceCategory;

class CategoryController extends Controller
{
    protected $apiServiceCategory;

    public function __construct(ApiServiceCategory $apiServiceCategory)
    {
        $this->apiServiceCategory = $apiServiceCategory;
    }

    public function store(Request $request)
    {
        // ตรวจสอบค่าที่รับมาจากฟอร์ม
        if (!$request->has(['cate_name', 'cate_cover_url'])) {
            return redirect()->back()->with('error', 'กรุณากรอกข้อมูลให้ครบถ้วน');
        }

        $cate_name = $request->input('cate_name');
        $cate_cover_url = $request->input('cate_cover_url');

        // ตรวจสอบค่าที่รับมา
        if (empty($cate_name) || empty($cate_cover_url)) {
            return redirect()->back()->with('error', 'ชื่อหมวดหมู่และ URL รูปภาพต้องไม่ว่าง');
        }

        $response = $this->apiServiceCategory->createCategory($cate_name, $cate_cover_url);

        // Debug response จาก API (แนะนำให้ใช้เฉพาะตอนพัฒนา)
        // dd($response->json());

        if ($response->successful()) {
            return redirect()->back()->with('success', 'เพิ่มหมวดหมู่สำเร็จ!');
        } else {
            // ส่ง error message จาก API กลับไปแสดง
            $errorMsg = $response->json('message') ?? 'เพิ่มหมวดหมู่ไม่สำเร็จ';
            return redirect()->back()->with('error', $errorMsg);
        }
    }

    public function index()
    {
        $response = $this->apiServiceCategory->getAllCategories();
        $categories = $response->successful() ? $response->json() : [];
        return view('admin.category', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $cate_name = $request->input('cate_name');
        $cate_cover_url = $request->input('cate_cover_url');

        $response = $this->apiServiceCategory->updateCategory($id, $cate_name, $cate_cover_url);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'แก้ไขหมวดหมู่สำเร็จ!');
        } else {
            $errorMsg = $response->json('message') ?? 'แก้ไขหมวดหมู่ไม่สำเร็จ';
            return redirect()->back()->with('error', $errorMsg);
        }
    }

    public function destroy($id)
    {
        $response = $this->apiServiceCategory->deleteCategory($id);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'ลบหมวดหมู่สำเร็จ!');
        } else {
            $errorMsg = $response->json('message') ?? 'ลบหมวดหมู่ไม่สำเร็จ';
            return redirect()->back()->with('error', $errorMsg);
        }
    }
}