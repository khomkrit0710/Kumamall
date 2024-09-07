<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KUMA ま Official Shop - Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Mitr', Arial, sans-serif;
            background-image: url('http://kuma.test/wp-content/uploads/2024/08/cropped-main-banner-2-1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .login-container {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            width: 800px;
        }
        .logo-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            border-right: 1px solid rgba(0, 0, 0, 0.1); /* เส้นแบ่งจางๆ */
        }
        .logo-container {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo-container img {
            width: 80%;
            height: auto;
        }
        .shop-title {
            font-size: 24px;
            color: #CA975E;
            text-align: center;
        }
        .form-section {
            flex: 1;
            padding: 15px;
        }
        .login-form h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .remember-me {
            display: flex;
            align-items: center;
        }
        .remember-me input {
            margin-right: 5px;
        }
        .forgot-password a {
            color: #CA975E;
            text-decoration: none;
        }
        .login-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #D29A79;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .login-button:hover {
            background-color: #B78141;
        }
        .or-divider {
            text-align: center;
            margin: 20px 0;
            color: #666;
        }
        .line-login {
            text-align: center;
        }
        .line-login img {
            width: 50px;
            height: 50px;
        }
        .required {
            color: red;
        }
		.login-form {
        margin-bottom: 5px !important; /* ลดระยะห่างด้านล่างของแบบฟอร์ม */
    }

    @media screen and (max-width: 768px) {
        .login-box {
            flex-direction: column;
            width: 90%;
            max-width: 400px;
        }
        .logo-section {
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-section {
            padding: 5px 20px;
        }
        .login-form {
            margin-bottom: 10px; /* ลดระยะห่างด้านล่างของแบบฟอร์มในอุปกรณ์เล็กลง */
        }
    }

    @media screen and (max-width: 480px) {
        .login-box {
            width: 95%;
        }
        .logo-container {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }
        .shop-title {
            font-size: 20px;
        }
        .form-footer {
            flex-direction: column;
            align-items: flex-start;
        }
        .remember-me {
            margin-bottom: 10px;
        }
    }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-section">
                <div class="logo-container">
                    <img src="http://kuma.test/wp-content/uploads/2024/09/kuma.png" alt="KUMA Logo">
                </div>
                <h2 class="shop-title">KUMA ま Official Shop</h2>
            </div>
            <div class="form-section">
                <form class="login-form" method="post">
                    <h2><?php esc_html_e( 'เข้าสู่ระบบ', 'woocommerce' ); ?></h2>

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <div class="form-group">
                        <label for="username"><?php esc_html_e( 'ชื่อผู้ใช้หรือที่อยู่อีเมล', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="password"><?php esc_html_e( 'รหัสผ่าน', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                    </div>

                    <?php do_action( 'woocommerce_login_form' ); ?>

                    <div class="form-footer">
                        <div class="remember-me">
                            <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                            <label for="rememberme"><?php esc_html_e( 'จำฉันไว้', 'woocommerce' ); ?></label>
                        </div>
                        <div class="forgot-password">
                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'ลืมรหัสผ่าน', 'woocommerce' ); ?></a>
                        </div>
                    </div>

                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="login-button" name="login" value="<?php esc_attr_e( 'เข้าสู่ระบบ', 'woocommerce' ); ?>"><?php esc_html_e( 'เข้าสู่ระบบ', 'woocommerce' ); ?></button>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
