<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */
?>
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">
			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' );
			?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap');

/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Footer wrapper styles */
.footer-wrapper {
    font-family: 'Mitr', sans-serif;
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
}

/* Top footer styles */
.footer-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #ffffff;
    padding: 1.5vw 2vw;
    margin-bottom: 2vw;
    border-radius: 1vw;
    box-shadow: 0 0.2vw 0.5vw rgba(0,0,0,0.1);
}

.service-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    font-size: 0.8vw;
    color: #000000; /* Keeping this black as per request */
}

.service-item img {
    width: 2vw;
    height: 2vw;
    margin-bottom: 0.3vw;
}

/* Main footer styles */
.footer-main {
    display: flex;
    justify-content: space-between;
    background-color: #D29A79;
    color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.footer-section {
    flex: 1;
    margin-right: 20px;
    color: #fff ; /* Ensure all text in footer sections is white */
}

.footer-section:last-child {
    margin-right: 0;
}

.footer-logo img {
    width: 60px;
    height: auto;
    margin-bottom: 10px;
}

.footer-title {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #fff; /* Set default color to white */
}

/* Special styling for KUMA ま Official Shop title */
.footer-logo .footer-title {
    color: #B86A4B ;
    -webkit-text-stroke-width: 0.5px;
    -webkit-text-stroke-color: #FFF;
}

.footer-subtitle {
    font-size: 12px;
    margin-bottom: 4px;
    color: #fff;
}

.footer-links {
    list-style-type: none;
}

.footer-links li {
    margin-bottom: 4px;
}

.footer-links a {
    color: #fff;
    text-decoration: none;
    font-size: 12px;
}

.footer-social {
    display: flex;
    margin-top: 8px;
}

.footer-social a {
    margin-right: 8px;
}

.footer-social img {
    width: 20px;
    height: 20px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .footer-main {
        flex-direction: column;
    }

    .footer-section {
        margin-right: 0;
        margin-bottom: 20px;
    }

    /* Restore original sizes for mobile */
    .service-item {
        font-size: 1.2vw;
    }

    .service-item img {
        width: 2.4vw;
        height: 2.4vw;
        margin-bottom: 0.5vw;
    }

    .footer-logo img {
        width: 80px;
    }

    .footer-title {
        font-size: 18px;
    }

    .footer-subtitle,
    .footer-links a {
        font-size: 14px;
    }

    .footer-social img {
        width: 24px;
        height: 24px;
    }
}

/* Minimum font-size for very small screens */
@media (max-width: 480px) {
    .service-item {
        font-size: 10px;
    }
}
</style>
			<div class="footer-wrapper">
				<div class="footer-top">
					<div class="service-item">
						<img src="http://kuma.test/wp-content/uploads/2024/08/deli.png" alt="จัดส่งทุกวัน">
						<span>จัดส่งทุกวัน</span>
					</div>
					<div class="service-item">
						<img src="http://kuma.test/wp-content/uploads/2024/08/Noproduct.png" alt="ไม่แสดงชื่อสินค้า 100%">
						<span>ไม่แสดงชื่อสินค้า 100%</span>
					</div>
					<div class="service-item">
						<img src="http://kuma.test/wp-content/uploads/2024/08/creditcard.png" alt="ชำระเงินอย่างปลอดภัย">
						<span>ชำระเงินอย่างปลอดภัย</span>
					</div>
					<div class="service-item">
						<img src="http://kuma.test/wp-content/uploads/2024/08/promotion.png" alt="สิทธิพิเศษสำหรับสมาชิก">
						<span>สิทธิพิเศษสำหรับสมาชิก</span>
					</div>
					<div class="service-item">
						<img src="http://kuma.test/wp-content/uploads/2024/08/tax.png" alt="ออกใบกำกับภาษีได้">
						<span>ออกใบกำกับภาษีได้</span>
					</div>
				</div>
				<div class="footer-main">
					<div class="footer-section footer-logo">
						<img src="http://kuma.test/wp-content/uploads/2024/08/kuma-1.png" alt="Kuma Official Shop">
						<h2 class="footer-title">KUMA ま Official Shop</h2>
						<p class="footer-subtitle">อุปกรณ์ของใช้สัตว์เลี้ยง</p>
						<p class="footer-subtitle">Japanese Minimalism เกรดพรีเมี่ยม</p>
						<div class="footer-social">
							<a href="#"><img src="http://kuma.test/wp-content/uploads/2024/09/FB.png" alt="Facebook"></a>
							<a href="#"><img src="http://kuma.test/wp-content/uploads/2024/09/IG.png" alt="Instagram"></a>
							<a href="#"><img src="http://kuma.test/wp-content/uploads/2024/09/Line.png" alt="Line"></a>
						</div>
						<p class="footer-subtitle">โทร : 099-999-9999</p>
						<p class="footer-subtitle">E-Mail : kuma.mall@gmail.com</p>
					</div>
					<div class="footer-section">
						<h3 class="footer-title">คำสั่งซื้อของฉัน</h3>
						<ul class="footer-links">
							<li><a href="#">คำสั่งซื้อสินค้า</a></li>
							<li><a href="#">การชำระเงิน</a></li>
							<li><a href="#">สถานะการจัดส่ง</a></li>
							<li><a href="#">นโยบายการเปลี่ยน/คืนสินค้า</a></li>
						</ul>
					</div>
					<div class="footer-section">
						<h3 class="footer-title">โปรโมชั่นสินค้า</h3>
						<ul class="footer-links">
							<li><a href="#">สินค้าเข้าใหม่</a></li>
							<li><a href="#">โปรโมชั่นและคูปองส่วนลด</a></li>
							<li><a href="#">ซื้อยกแพ็คประหยัดกว่า</a></li>
							<li><a href="#">สินค้าลดล้างสต็อค</a></li>
						</ul>
					</div>
					<div class="footer-section">
						<h3 class="footer-title">ระบบสมาชิก</h3>
						<ul class="footer-links">
							<li><a href="#">บัญชีของฉัน</a></li>
							<li><a href="#">การสมัครสมาชิก</a></li>
							<li><a href="#">สิทธิประโยชน์สมาชิก</a></li>
							<li><a href="#">ประวัติการสั่งซื้อ</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- End of New Footer Content -->

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>