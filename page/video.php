<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("video"); ?>
				</ul>
		</section>
		<section class="page-right">
			<video id='my-video' class='video-js' controls preload='auto' width='640' height='264' data-setup='{}'> 
				<source src='<?php echo G5_DATA_URL?>/files/video2.mp4' type='video/mp4'>
			</video>
		</section>
	</div>
</div>
<script>
</script>