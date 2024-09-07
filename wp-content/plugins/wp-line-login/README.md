# WP LINE Login
-Tested up to: 6.2.2
-Tags: register, login, logout


### Plugin name
WP LINE Login


### Description 
ปลักอินสำหรับล้อกอินเข้าสู่ระบบเวิร์ดเพรสด้วย LINE


### Current version
2.1 (25 ตุลาคม 2566)


### Features
* สามารถเปิดปิดการใช้งาน
* สามารถล้อกอินเข้าสู่ระบบเวิร์ดเพรสด้วย LINE 
* สามารถล้อกอินเข้าสู่ระบบ WooCommerce ด้วย LINE
* ระบบอัปเดตปลักอินอัตโนมัติ
* สามารถสร้างปุ่มล้อกอินด้วย LINE ที่ใดๆด้วย shortcode [line_login_button]


### Version
2.1 (25 ตุลาคม 2566)
* เพิ่ม shortcode [line_login_button]

2.0 (01 กรกฎาคม 2566)
* Enhancement: ระบบอัปเดตปลักอินอัตโนมัติ 
* Enhancement: ปรับปรุง error message ให้เดฟรู้เรื่องมากขึ้น มี error code, error message ที่ส่งกลับมาจากเซิฟเวอร์ 
* Enhancement: แสดง Info box รายละเอียดของปลักอิน 
* Fixebug: WP_Error cannot use as array 

1.1 (24 มิถุนายน 2566)
* Fixed: เอาโค้ดไปรันบนเวิร์ดเพรสเวอร์ชั่นต่ำกว่า 6.2.2 แล้วรีไดเร็กไปแต่หน้า index หลังล้อกอิน 

1.0 (23 มิถุนายน 2566)
* สามารถล้อกอินเข้าสู่ระบบเวิร์ดเพรสด้วย LINE 
* สามารถล้อกอินเข้าสู่ระบบ WooCommerce ด้วย LINE


### Installation ###
1. ก้อปปี้ปลักอิน WP LINE Login ไปยัง wp-content/plugins/
2. เข้าสู่ระบบหลังบ้านของเวิร์ดเพรส
3. ไปยังเมนู plugins จากนั้นทำการ activate ปลักอิน WP LINE Login
4. ไปยังเมนู ตั้งค่า > LINE Login Settings หรือคลิกเมนู Settings ที่อยู่ใต้ปลักอิน  
5. ป้อน LINE Login Settings
   - Channel ID
   - Channel Secret
6. คลิกปุ่ม บันทึกการเปลี่ยนแปลง

*หมายเหตุ Channel ID, Channel Secret ได้มาจากระบบ LINE Login


### วิธีการขอ Channel ID, Channel Secret ###
1. ล้อกอินเข้าสู่ LINE Console https://developers.line.biz/console/
2. คลิกปุ่ม Create Provider เพื่อสร้าง Provider
   2.1 ป้อน test-provide ในช่อง Provider name  ตั้งชื่อ Provider
   2.2 คลิกปุ่ม Create
3. คลิก Create a LINE Login channel 
4. ป้อนรายละเอียด LINE Login
   4.1 Channel type: LINE Login
   4.2 Provider: test-provider
   4.3 Region to provide the service: Thailand
   4.4 Company or owner's country or region: Thailand
   4.5 Channel name: Test-Channel
   4.6 Channel description: -
   4.7 App types: Web app
   4.8 Email address: test@email.com
   4.9 ติ๊กถูกหน้า I have read and agree to the LINE Developers Agreement
   4.10 ติ๊กถูกหน้า I have read and acknowledge LINE Privacy Policy
   4.11 คลิกปุ่ม Create
5. ตั้งค่า  Basic settings 
   5.1 คลิกปุ่ม Apply หลัง Email address permission
   5.2 ติ๊กถูกหน้า My app only collects a user's email address ...
   5.3 ติ๊กถูกหน้า I will follow LINE user data policy
   5.4 คลิก Register Screenshot (เลือกภาพเอามาทำ screenshot)
   5.5 คลิกปุ่ม Submit
6. ตั้งค่า  LINE Login 
   6.1 คลิกปุ่ม Edit Callback URL
   6.2 ป้อนค่า Callback URL ด้วยค่า Callback URL ที่แสดงในหน้า LINE Login Settings ของเว็บ
   6.3 กดปุ่ม Update

