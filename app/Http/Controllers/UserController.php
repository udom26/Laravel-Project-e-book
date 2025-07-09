<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceUser;

class UserController extends Controller
{
    protected $apiServiceUser;

    public function __construct(ApiServiceUser $apiServiceUser)
    {
        $this->apiServiceUser = $apiServiceUser;
    }

    // READ: แสดงรายการผู้ใช้
    public function index()
    {
        $response = $this->apiServiceUser->getUsers();
        $users = $response->successful() ? $response->json() : [];
        return view('admin.user', compact('users'));
    }

    // EDIT: แสดงฟอร์มแก้ไขผู้ใช้
    public function edit($id)
    {
        $response = $this->apiServiceUser->getUser($id);
        $user = $response->successful() ? $response->json() : null;
        if (!$user) {
            return redirect()->route('user')->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }
        return view('admin.user_edit', compact('user'));
    }

    // UPDATE: อัปเดตข้อมูลผู้ใช้
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลที่ส่งไป
        // dd($request->all());

        $response = $this->apiServiceUser->updateUser($id, $request->all());
        if ($response->successful()) {
            return redirect()->route('user')->with('success', 'แก้ไขผู้ใช้สำเร็จ');
        }
        return back()->with('error', 'เกิดข้อผิดพลาด');
    }

    // DELETE: ลบผู้ใช้
    public function destroy($id)
    {
        $response = $this->apiServiceUser->deleteUser($id);
        if ($response->successful()) {
            return redirect()->route('user')->with('success', 'ลบผู้ใช้สำเร็จ');
        }
        return back()->with('error', 'เกิดข้อผิดพลาด');
    }

    // BORROWED: แสดงประวัติการยืมของผู้ใช้
    public function borrowed($id)
    {
        $response = app(\App\Services\ApiServiceTransaction::class)->getAllTransactions();
        $transactions = $response->successful() ? $response->json() : [];

        $userId = $id;
        $borrowedBooks = array_filter($transactions, function($trx) use ($userId) {
            // กรณี userId เป็น array และมี $oid
            if (is_array($trx['userId']) && isset($trx['userId']['$oid'])) {
                return trim($trx['userId']['$oid']) == trim($userId);
            }
            // กรณี userId เป็น string
            if (is_string($trx['userId'])) {
                return trim($trx['userId']) == trim($userId);
            }
            return false;
        });
        $borrowedBooks = array_values($borrowedBooks); // << สำคัญ!

       dd($userId, $transactions, $borrowedBooks);

        $user = $this->apiServiceUser->getUser($userId)->json();

        return view('admin.user_borrowed', compact('user', 'borrowedBooks'));
    }
}
