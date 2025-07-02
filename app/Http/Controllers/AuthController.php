<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiServiceAuth;

class AuthController extends Controller
{
    protected $apiService;

    public function __construct(ApiServiceAuth $apiService)
    {
        $this->apiService = $apiService;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-zA-Z]/', // ต้องมีตัวอักษรอย่างน้อย 1 ตัว
                'confirmed'
            ],
        ], [
            'password.min' => 'รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร',
            'password.regex' => 'รหัสผ่านต้องมีตัวอักษรอย่างน้อย 1 ตัว',
            'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
            'email.unique' => 'อีเมลนี้ถูกใช้งานไปแล้ว', // ใช้กรณีตรวจสอบกับ DB Laravel
        ]);

        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $name = $request->input('name'); 
            $surname = $request->input('surname'); 

            $response = $this->apiService->register($email, $password, $name, $surname);

            if (!$response->successful()) {
                // ดักจับ error 400 สำหรับอีเมลซ้ำ
                if ($response->status() == 400) {
                    // รับข้อความ error จาก backend
                    $error = $response->json('message') ?? 'อีเมลนี้ถูกใช้งานไปแล้ว';
                    return redirect()->route('register')
                        ->with('error', $error)
                        ->withInput();
                }
                // กรณี error อื่น ๆ
                $error = $response->json('message') ?? 'เกิดข้อผิดพลาดในการสมัครสมาชิก';
                return redirect()->route('register')->with('error', $error)->withInput();
            }

            // สมัครสำเร็จ
            return redirect()->route('login')->with('success', 'สมัครสมาชิกสำเร็จ! กรุณาเข้าสู่ระบบ');
        } catch (\Throwable $e) {
            return redirect()->route('register')->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage())->withInput();
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $response = $this->apiService->login($email, $password);

        if (!$response->successful()) {
            $error = $response->json('message') ?? 'เข้าสู่ระบบไม่สำเร็จ';
            return redirect()->route('login')->with('error', $error);
        }

        $data = $response->json();
        $accessToken = $data['accessToken'] ?? null;
        $refreshToken = $data['refreshToken'] ?? null; // รับค่า refreshToken

        // เรียก API /user/profile ด้วย accessToken
        $userResponse = \Illuminate\Support\Facades\Http::withToken($accessToken)
            ->get(env('NGROK_API_URL') . 'user/profile');

        if (!$userResponse->successful()) {
            return redirect()->route('login')->with('error', 'ไม่สามารถดึงข้อมูลผู้ใช้ได้');
        }

        $user = $userResponse->json();

        session([
            'user_id' => $user['_id'] ?? null,
            'user_email' => $user['email'] ?? $email,
            'user_name' => $user['name'] ?? '',
            'user_roles' => $user['roles'] ?? [],
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken, 
        ]);

        if (in_array('admin', $user['roles'] ?? [])) {
            return redirect('/dashboard')->with('success', 'เข้าสู่ระบบสำเร็จ!');
        } else {
            return redirect('/')->with('success', 'เข้าสู่ระบบสำเร็จ!');
        }
    }

    public function logout(Request $request)
    {
        // เรียก logout ที่ backend ก่อน
        $this->apiService->logout();

        // ล้าง session ฝั่ง client
        $request->session()->flush();
        return redirect('/')->with('success', 'ออกจากระบบสำเร็จ!');
    }
}