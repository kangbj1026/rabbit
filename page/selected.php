<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<style>
</style>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("selected"); ?>
				</ul>
		</section>
		<section class="page-right">
			<input type="text" name="wr_1" id="wr_1" class="wr_1" autocomplete="off" onkeydown="onSearchs(this);">
				<ul class="searchdata">
					<li class='li_item'></li>
				</ul>
		</section>
	</div>
</div>
<?php
	for ($y = 1;$y <= 9;$y++) {
		for ($i = 1;$i <= 9;$i++)
			echo "$y * $i = ". $y * $i . "<br>";
	}
?>
<script>
	let itemNo = [];
	let itemId = [];
	// 건물검색 입력시 실행
	function onSearchs(t) {
		$('.ul_item').attr('class','searchdata');
		// jquery-ui.js 추가를 해야 autocomplete 사용 가능
		$("#"+t.id).autocomplete({
			minLength: 1,
			maxHeight: 200,
			autoFocus:true,
			source: function(request, response) {
				$.ajax({
					url: "<?php echo G5_BBS_URL?>/searchdata.php?search="+$("#"+t.id).val(),
					type: "GET",
					dataType: "json",
					success: function(data) {
						let dL = "";
						let searchData = $(".searchdata");
						response($.map(data, function(item) {
							let ex =  /<(\/b|b)([^>]*)>/gi;
							dL+= "<li class='li_item list"+item.wrId+"'>"+item.subject+"</li>";
							dL+= "<input type='hidden' id='"+item.wrId+"' value='"+item.subject.replace(ex,"")+"' >";
							searchData.attr('class','ul_item');
							searchData.html(dL);
							itemNo.push("list"+item.wrId);
							itemId.push(item.wrId);
						}));
						for(let s = 0;s < itemNo.length;s++){
							$("."+itemNo[s]).on("click", function(){
								$("#wr_1").val($("#"+itemId[s]).val());
								$('.ul_item').attr('class','searchdata');
							});
						}
					}
				});
			},
		});
	}
	// 건물검색시 value 값이 없을 경우
	$(function(){
		$("#wr_1").keyup(function()
		{
			if($("#wr_1").val() == "") {
				$('.ul_item').attr('class','searchdata');
			}
		});
	});
</script>