<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceTransaction;

class BorrowController extends Controller
{
    protected $apiServiceTransaction;

    public function __construct(ApiServiceTransaction $apiServiceTransaction)
    {
        $this->apiServiceTransaction = $apiServiceTransaction;
    }

public function borrow($id)
{
    $userToken = session('access_token');
    $url = $this->apiServiceTransaction->getBorrowUrl($id);
    $response = \Illuminate\Support\Facades\Http::withToken($userToken)->post($url, [
        'bookId' => $id,
    ]);

    if ($response->successful()) {
        return redirect()->route('ebook.success', $id)->with('success', 'ยืมหนังสือสำเร็จ');
    }

    // ตรวจสอบ error 400 (ยืมซ้ำ)
    if ($response->status() === 400) {
        return redirect()->back()->with('error', 'คุณมีหนังสือนี้อยู่แล้วในคลัง');
    }

    return redirect()->back()->with('error', 'ไม่สามารถยืมหนังสือได้');
}
}