import { test, expect } from '@playwright/test';

test.describe('สมัครสมาชิก', () => {
  test('สมัครสมาชิกสำเร็จ', async ({ page }) => {
    await page.goto('http://127.0.0.1:8000/login');
    await page.click('text=สมัครสมาชิก');
    await expect(page).toHaveURL(/register/);

    await page.fill('input[placeholder="ชื่อ"]', 'testuser');
    await page.fill('input[placeholder="นามสกุล"]', 'testsurname');
    await page.fill('input[placeholder="อีเมล"]', 'testuser' + Date.now() + '@mail.com');
    await page.fill('input[placeholder="รหัสผ่าน"]', 'password123');
    await page.fill('input[placeholder="ยืนยันรหัสผ่าน"]', 'password123');
    await page.click('button:has-text("สมัครสมาชิก")');
  });

  test('สมัครสมาชิกไม่สำเร็จเมื่อข้อมูลไม่ครบ', async ({ page }) => {
    await page.goto('http://127.0.0.1:8000/login');
    await page.click('text=สมัครสมาชิก');
    await expect(page).toHaveURL(/register/);

    // ไม่กรอกข้อมูลใดๆ แล้วกดสมัครสมาชิก
    await page.click('button:has-text("สมัครสมาชิก")');
    await expect(page.locator('text=กรุณากรอกชื่อ')).toBeVisible();
    await expect(page.locator('text=กรุณากรอกนามสกุล')).toBeVisible();
    await expect(page.locator('text=กรุณากรอกอีเมล')).toBeVisible();
    await expect(page.locator('text=กรุณากรอกรหัสผ่าน')).toBeVisible();
    await expect(page.locator('text=กรุณากรอกยืนยันรหัสผ่าน')).toBeVisible();
  });

  test('สมัครสมาชิกไม่สำเร็จเมื่ออีเมลซ้ำ', async ({ page }) => {
    await page.goto('http://127.0.0.1:8000/login');
    await page.click('text=สมัครสมาชิก');
    await expect(page).toHaveURL(/register/);

    await page.fill('input[placeholder="ชื่อ"]', 'testuser');
    await page.fill('input[placeholder="นามสกุล"]', 'testsurname');
    await page.fill('input[placeholder="อีเมล"]', 'admin3@gmail.com'); // อีเมลที่มีอยู่แล้ว
    await page.fill('input[placeholder="รหัสผ่าน"]', 'password123');
    await page.fill('input[placeholder="ยืนยันรหัสผ่าน"]', 'password123');
    await page.click('button:has-text("สมัครสมาชิก")');
    await expect(page.locator('text=อีเมลนี้ถูกใช้ไปแล้ว')).toBeVisible();
  });
});