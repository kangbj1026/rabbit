<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'CMB';

// 게시판 제목 폰트 설정
$font = 'font-16 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

// 사이드 위치 설정 - left, right
$side = ($at_set['side']) ? 'left' : 'right';

?>
<style>
	.widget-index .at-main,
	.widget-index .at-side { width:100%;padding-bottom:0px; }
	.widget-index .div-title-underbar { margin-bottom:15px; }
	.widget-index .div-title-underbar span { padding-bottom:4px; }
	.widget-index .div-title-underbar span b { font-weight:500; }
	.widget-index .widget-img img { display:block; max-width:100%; /* 배너 이미지 */ }
	.widget-box { margin-bottom:25px; }
</style>

<div class="at-container widget-index">

	<div class="h20"></div>

	<?php echo apms_widget('basic-title', $wid.'-wt1', 'height=260px', 'auto=0'); //타이틀 ?>

	<div class="row at-row">
		<!-- 메인 가운데 레이아웃 영역 -->
		<div class="col-md-9<?php echo ($side == "left") ? ' pull-right' : '';?> at-col at-main">

			<div class="row">
				<div class="col-sm-6">

					<!-- 이슈 시작-->
					<div class="widget-box">
						<?php echo apms_widget('basic-post-garo', $wid.'-wm1', 'icon={아이콘:caret-right} date=1 center=1 strong=1,2'); ?>
					</div>
					<!-- 이슈 끝-->

				</div>
				<div class="col-sm-6">

					<!-- 뉴스 시작 -->

					<!-- 뉴스 끝 -->

				</div>
			</div>

			<!-- 갤러리 시작 -->

			<!-- 갤러리 끝 -->	

			<!-- 웹진 시작 -->

			<!-- 웹진 끝 -->	

			<!-- 이미지 배너 시작 -->	

			<!-- 이미지 배너 끝 -->	

			<div class="row">
				<div class="col-sm-6">

					<!-- 가이드 시작 -->

					<!-- 가이드 끝 -->

				</div>
				<div class="col-sm-6">

					<!-- 팁 시작 -->

					<!-- 팁 끝 -->

				</div>

			</div>

			<div class="row">
				<div class="col-sm-6">

					<!-- Q & A 시작 -->

					<!-- Q & A 끝 -->

				</div>
				<div class="col-sm-6">

					<!-- 토크 시작 -->

					<!-- 토크 끝 -->

				</div>

			</div>

			<!-- 배너 시작 -->

			<!-- 배너 끝 -->	
			
		</div>

	</div>
</div>
