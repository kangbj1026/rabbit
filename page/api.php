<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	.customoverlay {position:relative;bottom:85px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;float:left;}
	.customoverlay:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
	.customoverlay a {display:block;text-decoration:none;color:#000;text-align:center;border-radius:6px;font-size:14px;font-weight:bold;overflow:hidden;background: #d95050;background: #d95050 url(https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png) no-repeat right 14px center;}
	.customoverlay .title {display:block;text-align:center;background:#fff;padding:10px 15px;font-size:14px;font-weight:bold;}
	.customoverlay:after {content:'';position:absolute;margin-left:-12px;left:50%;bottom:-12px;width:22px;height:12px;background:url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')}

	.map_wrap {position:relative;overflow:hidden;width:100%;height:350px;font-family:'Malgun Gothic', '맑은 고딕', sans-serif;}
	.radius_border{border:1px solid #919191;border-radius:5px;}     
	.custom_typecontrol {position:absolute;top:10px;right:10px;overflow:hidden;width:130px;height:30px;margin:0;padding:0;z-index:1;font-size:12px;}
	.custom_typecontrol span {display:block;width:50%;height:30px;float:left;text-align:center;line-height:30px;cursor:pointer;}
	.custom_typecontrol .btn {background:#fff;background:linear-gradient(#fff,  #e6e6e6);padding: 0px;}       
	.custom_typecontrol .btn:hover {background:#f5f5f5;background:linear-gradient(#f5f5f5,#e3e3e3);}
	.custom_typecontrol .btn:active {background:#e6e6e6;background:linear-gradient(#e6e6e6, #fff);}    
	.custom_typecontrol .selected_btn {color:#fff;background:#425470;background:linear-gradient(#425470, #5b6d8a);}
	.custom_typecontrol .selected_btn:hover {color:#fff;}   
	.custom_zoomcontrol {position:absolute;top:50px;right:10px;width:36px;height:80px;overflow:hidden;z-index:1;background-color:#f5f5f5;} 
	.custom_zoomcontrol1 {position:absolute;top:140px;right:10px;width:36px;height:40px;overflow:hidden;z-index:1;background-color:#f5f5f5;} 
	.custom_zoomcontrol span, .custom_zoomcontrol1 span {display:block;width:36px;height:40px;text-align:center;cursor:pointer;}     
	.custom_zoomcontrol span img, .custom_zoomcontrol1 span img {width:15px;padding:12px 0;border:none;}

	section.page-right {width:100%;font-size:2rem;}
	section.page-right > div.map_wrap > div#map {width:100%;height:100%;position:relative;}
	section.page-right > div.wrap_controllers {border:1px solid #dfdfdf;background-color:#f9f9f9;overflow:hidden;padding:7px 11px;}
	section.page-right > div.wrap_controllers > a > img {display:block;width:72px;height:16px;float:left;}
	section.page-right > div.wrap_controllers > div.wrap_btn_roadview {float:right;font-size:13px;}
	section.page-right > div.wrap_controllers > div.wrap_btn_roadview > span {width: 1px;padding: 0;margin: 0 8px 0 9px;height: 11px;vertical-align: top;position: relative;top: 2px;border-left: 1px solid #d0d0d0;}

	#textArea {resize: none;border:0;line-height: initial;}
	.copyAddress {background: transparent;border:0}
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("api"); ?>
				</ul>
		</section>
		<section class="page-right" style="width:80%;font-size:2rem;">
		<div class="map_wrap">
			<div id="map" style="width:100%;height:100%;position:relative;overflow:hidden;"></div> 
			<!-- 지도타입 컨트롤 div -->
			<div class="custom_typecontrol radius_border">
				<span id="btnRoadmap" class="selected_btn" onclick="setMapType('roadmap')">지도</span>
				<span id="btnSkyview" class="btn" onclick="setMapType('skyview')">스카이뷰</span>
			</div>
				<!-- 지도 확대, 축소 -->
			<div class="custom_zoomcontrol radius_border"> 
				<span onclick="zoomIn()"><img src="<?php echo G5_IMG_URL?>/ico_plus.png" alt="확대"></span>  
				<span onclick="zoomOut()"><img src="<?php echo G5_IMG_URL?>/ico_minus.png" alt="축소"></span>
			</div>
				<!-- 새로고침 -->
			<div class="custom_zoomcontrol1 radius_border "> 
				<span onclick="reMap()"> <img src="<?php echo G5_IMG_URL?>/refresh.png" alt="새로고침"></span>
			</div>
		</div>
		<!-- map 하단 -->
		<div class="wrap_controllers">
			<a class="tit_controllers" href="https://map.kakao.com" target="_blank">
				<img src="//t1.daumcdn.net/localimg/localimages/07/2018/pc/common/logo_kakaomap.png" width="72" height="16" alt="카카오맵">
			</a>
			<div class="wrap_btn_roadview">
				<a class="txt" target="_blank" href="https://map.kakao.com/?from=roughmap&srcid=11824803&q=경기%20부천시%20상동%20459-1&urlX=446143&urlY=1108405&rv=on">로드뷰</a>
				<span class="txt_bar"></span>
				<a class="txt" target="_blank" href="https://map.kakao.com/?from=roughmap&amp;eName=컬러스&amp;eX=446143&eY=1108405">길찾기</a>
				<span class="txt_bar"></span>
				<a class="txt" target="_blank" href="https://map.kakao.com?map_type=TYPE_MAP&amp;from=roughmap&amp;srcid=11824803&amp;q=경기 부천시 상동 459-1&amp;urlX=446143&amp;urlY=1108405">지도 크게 보기</a>
			</div>
		</div>

			<button onclick="copyAddress()" class="copyAddress" >
				<textarea id="textArea" cols="29" readonly>경기도 부천시 원미구 상동 부일로237번길 23 컬러스</textarea>
			</button>
			<a href='tel:010-0000-0000'>032-0000-0000</a>
		</section>
		<section class="page-right" onload="initTmap()">
			<div id="map_div">
			</div>        
		</section>
	</div>
</div>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=f6be6560e9467d8a60f6cf5fdda25553&libraries=services"></script>
<script>
	function copyAddress() {
		var content = document.getElementById('textArea');

		content.select();
		document.execCommand('copy');

		alert("복사 완료!");
	}
	var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
		mapOption = { 
		//center: new kakao.maps.LatLng(37.308052584637885, 127.33385351145606), // 지도의 중심좌표
		center: new kakao.maps.LatLng(37.489576312998324, 126.75645221330605), // 지도의 중심좌표
        level: 2 // 지도의 확대 레벨
    };

	var map = new kakao.maps.Map(mapContainer, mapOption);

	var imageSrc = '<?php echo G5_IMG_URL?>/map-icon.png', // 마커이미지의 주소입니다    
		imageSize = new kakao.maps.Size(64, 69), // 마커이미지의 크기입니다
		imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

	// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
	var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
		markerPosition = new kakao.maps.LatLng(37.489576312998324, 126.75645221330605); // 마커가 표시될 위치입니다

	// 마커를 생성합니다
	var marker = new kakao.maps.Marker({
		position: markerPosition,
		image: markerImage // 마커이미지 설정 
	});

	// 마커가 지도 위에 표시되도록 설정합니다
	marker.setMap(map);

	// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
	var content = '<div class="customoverlay">' +
		'  <a href="https://map.kakao.com/link/map/11824803" target="_blank">' +
		'    <span class="title">Colours ( 컬러스 )</span>' +
		'  </a>' +
		'</div>';

	// 커스텀 오버레이가 표시될 위치입니다 
	var position = new kakao.maps.LatLng(37.489576312998324, 126.75645221330605);  

	// 커스텀 오버레이를 생성합니다
	var customOverlay = new kakao.maps.CustomOverlay({
		map: map,
		position: position,
		content: content,
		yAnchor: 1 
	});

	var points = [
		new kakao.maps.LatLng(37.489576312998324, 126.75645221330605)
	];

	var bounds = new kakao.maps.LatLngBounds();

	var i, marker;
	for (i = 0; i < points.length; i++) {
		// 배열의 좌표들이 잘 보이게 마커를 지도에 추가합니다
		marker = new kakao.maps.Marker({ position : points[i] });
		
		// LatLngBounds 객체에 좌표를 추가합니다
		bounds.extend(points[i]);
	}

	// 지도타입 컨트롤의 지도 또는 스카이뷰 버튼을 클릭하면 호출되어 지도타입을 바꾸는 함수입니다
	function setMapType(maptype) { 
		var roadmapControl = document.getElementById('btnRoadmap');
		var skyviewControl = document.getElementById('btnSkyview'); 
		if (maptype === 'roadmap') {
			map.setMapTypeId(kakao.maps.MapTypeId.ROADMAP);    
			roadmapControl.className = 'selected_btn';
			skyviewControl.className = 'btn';
		} else {
			map.setMapTypeId(kakao.maps.MapTypeId.HYBRID);    
			skyviewControl.className = 'selected_btn';
			roadmapControl.className = 'btn';
		}
	}

	// 지도 확대, 축소 컨트롤에서 확대 버튼을 누르면 호출되어 지도를 확대하는 함수입니다
	function zoomIn() {
		map.setLevel(map.getLevel() - 1);
	}

	// 지도 확대, 축소 컨트롤에서 축소 버튼을 누르면 호출되어 지도를 확대하는 함수입니다
	function zoomOut() {
		map.setLevel(map.getLevel() + 1);
	}
	// 지도 새로고침
	function reMap() {
		 map.setBounds(bounds);
	}
</script>
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