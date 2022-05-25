<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<div class="page-content">
	<div class="content-wrap">
		<?php if(!$header_skin) { // 헤더 미사용시 출력 ?>
		<section class="page-left">
				<ul>
					<?php page_list("noemail"); ?>
				</ul>
		</section>
		<?php } ?>
		<section class="page-right">
			<?php if(!$header_skin) { // 헤더 미사용시 출력 ?>
				<div class="text-center" style="margin:15px 0px;">
					<h3 class="div-title-underline-bold border-color">
						이메일 무단수집거부
					</h3>
				</div>
			<?php } ?>

			<div class="text-center">
				<p>본 사이트에 게시된 이메일 주소가 전자우편 수집 프로그램이나 그 밖의 기술적 장치를 이용하여 무단으로 수집 되는 것을 거부합니다.</p>
				<p>이를 위반시 <b>「정보통신망 이용촉진 및 정보보호 등에 관한 법률」</b>에 의해 형사처벌됨을 유념하시기 바랍니다.</p>
				<br>
				<p><i class="fa fa-at" style="font-size:80px;"></i></p>
			</div>
		</section>
	</div>
</div>

<div class="h30"></div>
