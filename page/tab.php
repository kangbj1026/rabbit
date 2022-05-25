<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
	div.tab-container {width:100%;font-size:20px;padding:0;padding-bottom:5%;}
	ul.tabs, ul.tabs2 {padding-bottom: 2%;list-style: none;}
	ul.tabs li, ul.tabs2 li {background: none;color: #222;display: inline-block;padding: 10px 15px;cursor: pointer;}
	ul.tabs li.current, ul.tabs2 li.current {color: #222;border-bottom: 3px solid #CF5906;padding-bottom: 1%;}
	.tab-content, .tab-contents {display: none;background: #ededed;padding: 15px;height: 20vh;}
	.tab-content.current, .tab-contents.current {display: inherit;}

	div.ta {width:100%;height:200px;}
	div.ta .tt {display:flex;}
	div.ta > div.tt > span {text-align:center;width:20%;margin:1%;background-color:#ffe701;font-weight: bold;}
	div.ta > div.tt > span:nth-child(1) {background-color:#e90101;}
	div.ta > div.tt > span:nth-child(2) {background-color:#ffe200;}
	div.ta > div.tt > span:nth-child(3) {background-color:#00ff22;}
	div.ta > div.tt > span:nth-child(4) {background-color:#ff00e9;}
	div.ta > div.tt > span:nth-child(5) {background-color:#00f1ff;}
	div.ta > div.tt > span > img {height:inherit;width:100%;}
	div.ta > div.tb > div.t-content {display:none;}
	div.ta > div.tb > div.ts {display:flex;}
	div.ta > div.tb > div.ts > ul {display:flex;width:40%;}
	div.ta > div.tb > div.ts > ul > li {list-style:none;margin:2%;padding:5%;border:1px solid;}
	div.ta > div.tb > div.ts > select {width:10%;padding:1%;margin:2%;}

</style>
<?php
$tab_div = array(
array('name'=>"a",'photo'=>G5_IMG_URL."/ts01.png"),
array('name'=>"b",'photo'=>G5_IMG_URL."/ts02.png"),
array('name'=>"c",'photo'=>G5_IMG_URL."/ts03.png"),
array('name'=>"d",'photo'=>G5_IMG_URL."/logo.png"),
array('name'=>"e",'photo'=>G5_IMG_URL."/kakao_logo.png"),
array('name'=>"f",'photo'=>G5_IMG_URL."/w.png"),
array('name'=>"g",'photo'=>G5_IMG_URL."/kakao.png")
);
?>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("tab"); ?>
				</ul>
		</section>
		<section class="page-right">
			<h2> Tab 1 </h2>
			<div class="tab-container">

				<ul class="tabs">
					<li class="tab-link current" data-tab="tab-1">ul.tabs li:nth-child(1)</li>
					<li class="tab-link" data-tab="tab-2">ul.tabs li:nth-child(2)</li>
					<li class="tab-link" data-tab="tab-3">ul.tabs li:nth-child(3)</li>
				</ul>

				<div id="tab-1" class="tab-content current">data-tab="tab-1" tab content1</div>
				<div id="tab-2" class="tab-content">data-tab="tab-2" tab content2</div>
				<div id="tab-3" class="tab-content">data-tab="tab-3" tab content3</div>

			</div>
			<h2> Tab 2 </h2>
			<div class="tab-container">

				<ul class="tabs2">
					<?php 
						$tab_array = ["아스팔트 슁글","테릴기와","물받이류","벤트","롤슁글","금속기와","이지기와"];
						for($i = 0;$i < count($tab_array);$i++){
							if($i == 0){
								echo "<li class='tab-link current' data-tab='tabs-$i'>$tab_array[$i]</li>";
							} else {
								echo "<li class='tab-link' data-tab='tabs-$i'>$tab_array[$i]</li>";
							}
						}
					?>
				</ul>
						<?php
						for($y = 0;$y < count($tab_div);$y++){ 
							if($y == 0) { ?>
							<div id='tabs-<?php echo $y?>' class='tab-contents current'><img src='<?php echo $tab_div[$y]['photo'] ?>'></div>
						<?php 
							} else { ?>
							<div id='tabs-<?php echo $y?>' class='tab-contents'><img src='<?php echo $tab_div[$y]['photo'] ?>'></div>
						<?php 
							} 
						} ?>
			</div>
			<h2> Tab 3 </h2>
			<div class="ta">
				<div class="tt">
					<span class="t1 ts" data-tab="tab-01">
						data-tab="tab-01"
					</span>
					<span class="t2" data-tab="tab-02">
						data-tab="tab-02"
					</span>
					<span class="t3" data-tab="tab-03">
						data-tab="tab-03"
					</span>
					<span class="t4" data-tab="tab-04">
						data-tab="tab-04"
					</span>
					<span class="t4" data-tab="tab-05">
						data-tab="tab-05"
					</span>
				</div>
				<div class="tb">
					<?php
					$data = [];
					$data1 = ["250","255","260","265"];
					$data2 = ["250","255","260","265","270","275","280","285","290"];
					$data3 = ["265","270","275","280","285","290"];
					$data4 = ["255","260","265"]; 
					$data5 = ["255","260","265","270","275","280","285","290","295","300","305","310","315"]; 
					$datalist = [$data,$data1,$data2,$data3,$data4,$data5];
					for($y = 0; $y < count($datalist); $y++) { ?>
							<div id="tab-0<?php echo $y?>" class="t-content">
								<!-- data가 12개 이상이면 select 으로 출력 -->
								<?php if(count($datalist[$y]) > 12) { ?>
									<select>
									<?php
									for($a = 0; $a < count($datalist[$y]);$a++){ ?>
											<option class="datalist"><?php echo $datalist[$y][$a] ?></option>
									<?php } ?>
									</select>
								<!-- data가 12개 이하이면 ul li 로 출력 -->
								<?php } else if(count($datalist[$y]) < 12) {?>
								<ul>
									<?php
									for($i = 0; $i < count($datalist[$y]);$i++){ ?>
										<li class="datalist">
											<?php echo $datalist[$y][$i] ?>
										</li>
									<?php }  ?>
								</ul>
								<?php } ?>
							</div>
					<?php } ?>
				</div>
			</div>
		</section>
	</div>
</div>
<script>

	let ttl = $('div.tt > span');
	let tsli = $('div.tb ul li');
	let tsop = $('div.tb select');
	let tc = $('.t-content');

	$(function(){

		$('ul.tabs li').click(function(){
			let tab_id = $(this).attr('data-tab');

			console.log(tab_id);

			$('ul.tabs li').removeClass('current');
			$('.tab-content').removeClass('current');

			$(this).addClass('current');
			$("#"+tab_id).addClass('current');
		})

		$('ul.tabs2 li').click(function(){
			let tab_id = $(this).attr('data-tab'); // 속성값 가져오기

			$('ul.tabs2 li').removeClass('current'); // class 제거
			$('.tab-contents').removeClass('current'); // class 제거

			$(this).addClass('current'); // class 추가
			$("#"+tab_id).addClass('current'); // class 추가
		})

		ttl.click(function() {
			let tab_id = $(this).attr('data-tab');
			
			ttl.removeClass('ts');
			tc.removeClass('ts');

			$(this).addClass('ts');
			$("#"+tab_id).addClass('ts');
		});

		tsli.click(function(e){
			alert(this);
			console.log(this);
			console.log(e);
		});

		tsop.change(function(e){
			alert(this);
			console.log(this.value);
			console.log(e);
		});

	});

</script>