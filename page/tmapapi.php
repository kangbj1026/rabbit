<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
/* 거리표시 팝업*/
.mPop{
    border: 1px;
    background-color: #FFF;
    font-size: 12px;
    border-color: #FF0000;
    border-style: solid;
    text-align: center;
}
/*공통사용 클래스*/
.mPopStyle {
    border: 1px;
    background-color: #FFF;
    font-size: 12px;
    border-color: #FF0000;
    border-style: solid;
    text-align:left;
}
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("tmapapi"); ?>
				</ul>
		</section>
		<section class="page-right" onload="initTmap()">
			<div id="map_div">
			</div>        
		</section>
	</div>
</div>
<script src="https://apis.openapi.sk.com/tmap/jsv2?version=1&appKey=l7xxb98a8b1b39c14cb7b472dea555cb09cc"></script>
<script>
$(document).ready(function() {
	initTmap();
});

function setVariables(){    
    zoom = 16;  // zoom level입니다.  0~19 레벨을 서비스 하고 있습니다. 
}
function initTmap(){
	var map = new Tmapv2.Map("map_div",  
	{
		center: new Tmapv2.LatLng(37.566481622437934,126.98502302169841), // 지도 초기 좌표
		width: "890px", 
		height: "400px",
		zoom: 15
	});

	var marker = new Tmapv2.Marker({
		position: new Tmapv2.LatLng(37.566481622437934,126.98502302169841),
		map: map
	});
}
</script>