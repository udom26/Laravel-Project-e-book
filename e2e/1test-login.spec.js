import { test, expect } from '@playwright/test';

test.describe('ล็อคอิน', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('http://127.0.0.1:8000/login');
  });

  test('ล็อกอินสำเร็จด้วยข้อมูลที่ถูกต้อง', async ({ page }) => {
    await page.fill('input[placeholder="Email"]', 'admin3@gmail.com');
    await page.fill('input[placeholder="Password"]', '123456789zz');
    await page.click('button:has-text("ล็อกอินเข้าสู่ระบบ")');
    // ตรวจสอบว่า redirect ออกจากหน้า login
    await expect(page).not.toHaveURL(/login/);
  });

  test('ล็อกอินไม่สำเร็จเมื่อกรอกข้อมูลผิด', async ({ page }) => {
    await page.fill('input[placeholder="Email"]', 'wrong@email.com');
    await page.fill('input[placeholder="Password"]', 'wrongpassword');
    await page.click('button:has-text("ล็อกอินเข้าสู่ระบบ")');
    // ตรวจสอบว่าหน้าไม่ redirect
    await expect(page).toHaveURL(/login/);
    // ตรวจสอบข้อความ error ที่แสดง (แก้ไขข้อความให้ตรงกับระบบจริง)
    await expect(page.locator('text=อีเมลหรือรหัสผ่านไม่ถูกต้อง')).toBeVisible();
  });

  test('ล็อกอินไม่สำเร็จเมื่อกรอกข้อมูลไม่ครบ', async ({ page }) => {
    await page.fill('input[placeholder="Email"]', '');
    await page.fill('input[placeholder="Password"]', '');
    await page.click('button:has-text("ล็อกอินเข้าสู่ระบบ")');
    // ตรวจสอบว่ายังอยู่ที่หน้า login
    await expect(page).toHaveURL(/login/);
  
  });
});