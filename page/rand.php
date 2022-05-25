<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>
<div class="page-content">
	<div class="content-wrap">
		<section class="page-left">
				<ul>
					<?php page_list("rand"); ?>
				</ul>
		</section>
		<section class="page-right">
			<div id="table-responsive" class="table-responsive">
				<table class="table div-table list-pc bg-white">
					<thead>
						<tr>
							<?php if ($is_checkbox) { ?>
							<th scope="col">
								<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
								<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
							</th>
							<?php } ?>
							<th colspan="6"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
						<?php for($i = 0;$i < 6;$i++) {?>
							<td width="5%" class="text-center font-5r hash-tag"><?php print_r(rand(1,45))?></td>
						<?php } ?>
						</tr>
					</tbody>
				</table>
			</div>
			<input class="in-btn" type="button" onclick="remove()" value="숫자 새로고침">
		</section>
	</div>
</div>
<script>
	function remove(){
		let listUl = $("#table-responsive");
		listUl.load(" #table-responsive table");
	}
</script>