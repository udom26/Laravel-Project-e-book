import { test, expect } from '@playwright/test';

test.describe('ลืมรหัสผ่าน', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('http://127.0.0.1:8000/login');
  });

  test('ลิงก์ลืมรหัสผ่านต้องคลิกได้', async ({ page }) => {
    await page.click('text=ลืมรหัสผ่าน?');
    await expect(page).toHaveURL(/resetpass/);
    await expect(page.locator('input[placeholder="อีเมล"]')).toBeVisible();
  });

  test('รีเซ็ตรหัสผ่าน', async ({ page }) => {
    await page.click('text=ลืมรหัสผ่าน?');
    await expect(page).toHaveURL(/resetpass/);

    await page.fill('input[placeholder="อีเมล"]', 'testuser@gmail.com');
    await page.click('button:has-text("ส่งลิงก์รีเซ็ตรหัสผ่าน")');
    await expect(page.locator('input[placeholder="อีเมล"]')).toBeVisible();
  });
});