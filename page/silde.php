<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	.swiper {width:80%;}
	.swiper-wrapper { height:300px}
	/* Center slide text varertically */
	.swiper-slide {background-color:#340df8c9;display: flex;justify-content: center;align-items: center;}
	.swiper-slide img {display: block;width: 100%;height: 100%;object-fit: contain;}
	.swiper-pagination-bullets.swiper-pagination-horizontal {bottom:40%;right:25%;}
	.swiper-pagination-horizontal.swiper-pagination-bullets .swiper-pagination-bullet {width:5%;height:6px;border-radius:5px;margin:1%;background:#ffe701;}
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("silde"); ?>
				</ul>
		</section>
		
			<div class="swiper mySwiper" >
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<img src="<?php echo G5_IMG_URL?>/w.png">
					</div>
					<div class="swiper-slide">Slide 2</div>
					<div class="swiper-slide">Slide 3</div>
					<div class="swiper-slide">Slide 4</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>

	</div>
</div>
<script>

	let swiper = new Swiper(".mySwiper", {
		slidesPerView: 1,
		spaceBetween: 30,
		speed: 2000,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false
		},
		loop : true,
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
	});

</script>
