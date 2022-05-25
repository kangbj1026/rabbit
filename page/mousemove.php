<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
add_stylesheet('<link rel="stylesheet" href="/page/test.css">', 0);
?>

<style>
	section.page-right {border:5px solid;height:500px;display:flex;justify-content:center;align-items:center;}
	div#move_div {width:100%;height:500px;position:relative;margin-top:7px;}
	div#move_div_inside {border:1px solid;position:absolute;top:0;left:0;background-color:#0af1e3;width:50px;height:50px;cursor:pointer;cursor : move;}
</style>
<div class="page-content">
	<div class="content-wrap">
		<!-- page contnet -->
		<section class="page-left">
			<ul>
				<?php page_list("mousemove"); ?>
			</ul>
		</section>
		<section class="page-right">
			<div id="move_div" class="move_div">
				<div id='move_div_inside' class="move_div_inside"></div>
			</div>
		</section>
		<section>
			<button class="insideadd" id="insideadd"> Add </button>
		</section>
	</div>
</div>
<script>
	let i = 0;
	let y = 0;
	let pageRight = $('.page-right');
	let moveDivInside = $('#move_div_inside');
	let insideAdd = $('#insideadd');
	let moveDiv = $('#move_div');
	let moveDivS = "";
	let moveDivInsideS;
	
	moveDivInsideS = $('#move_div_inside'+y);
	y++;
	let moveDisInsideReS = moveDivInsideS.selector.replace(/#/g, '');

	$('.page-right').resizable();
	
	moveDivInside.draggable({
		containment: ".page-right",
	});
	moveDivInside.resizable({
		containment: ".page-right",
	});
	moveDivInsideS.resizable({
		containment: ".page-right",
	});

		moveDivS += "<div id='"+moveDisInsideReS+"'>";
		moveDivS += "<div class='ui-resizable-handle ui-resizable-e' style='z-index: 90;'></div>";
		moveDivS += "<div class='ui-resizable-handle ui-resizable-s' style='z-index: 90;'></div>";
		moveDivS += "<div class='ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se' style='z-index: 90;'></div>";
		moveDivS += "</div>";

	$('#insideadd').click(function(){
		i++;
		console.log(i);
		$('#move_div').prepend(moveDivS);
		$('#move_div_inside'+i).addClass("move_div_inside ui-draggable ui-draggable-handle ui-resizable");
	});

</script>