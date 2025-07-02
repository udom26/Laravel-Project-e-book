<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceTransaction;

class TransactionController extends Controller
{
    protected $apiServiceTransaction;
    protected $authService;

    public function __construct(\App\Services\ApiServiceAuth $authService)
    {
        $this->authService = $authService;
        $this->apiServiceTransaction = new ApiServiceTransaction($authService);
    }

    // แสดงรายการประวัติการยืม-คืน
    public function index(Request $request)
    {
        $response = $this->apiServiceTransaction->getAllTransactions();
        $transactions = $response->successful() ? $response->json() : [];

        // Filter by date if provided
        if ($request->filled('date')) {
            $date = $request->input('date');
            $transactions = array_filter($transactions, function ($transaction) use ($date) {
                if (!isset($transaction['startTime'])) return false;
                // เปรียบเทียบแค่วันที่ (ไม่เอาเวลา)
                return \Carbon\Carbon::parse($transaction['startTime'])->toDateString() === $date;
            });
        }

        return view('admin.transaction', compact('transactions'));
    }

    // ดูรายละเอียดรายการเดียว
    public function show($id)
    {
        $response = $this->apiServiceTransaction->getTransactionById($id);
        $transaction = $response->successful() ? $response->json() : null;
        return view('admin.transaction_show', compact('transaction'));
    }
}