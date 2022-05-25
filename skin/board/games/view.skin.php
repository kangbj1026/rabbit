<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$attach_list = '';
define('GLIST', '../'.G5_LIST_DIR.'/');

// 가변 파일
$j = 0;
for ($i=0; $i<count($view['file']); $i++) {
	if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
		if ($board['bo_download_point'] < 0 && $j == 0) {
			$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
		}
		$file_tooltip = '';
		if($view['file'][$i]['content']) {
			$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
		}
		$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
		$attach_list .= '<span class="label label-primary pull-right view-cnt">'.number_format($view['file'][$i]['download']).'</span>';
		$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;';
		$attach_list .= '<span class="en font-11 text-muted"><i class="fa fa-clock-o"></i> '.apms_datetime(strtotime($view['file'][$i]['datetime']), "Y.m.d").'</span></a>'.PHP_EOL;
		$j++;
	}
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

?>
<style>
<?php if($boset['video']) { ?>
	.view-wrap .apms-autowrap { max-width:<?php echo (G5_IS_MOBILE) ? '100%' : $boset['video'];?> !important;}
<?php } ?>
	.at-body {height:40em;}
</style>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div class="view-wrap<?php echo (G5_IS_MOBILE) ? ' view-mobile font-14' : '';?>">
	<h1><?php if($view['photo']) { ?>
		<img src="<?php echo $view['photo'];?>" class="photo" alt="">
			<?php } ?><?php echo cut_str(get_text($view['wr_subject']), 70); ?>
	</h1>
	<div>
		<a href="<?php echo $list_href ?>" class="btn btn-black btn-sm">
			<i class="fa fa-bars"></i><span class="hidden-xs"> 목록</span>
		</a>
		<?php if ($update_href || $is_member['admin']) { ?>
		<a href="<?php echo $update_href ?>" class="btn btn-black btn-sm" title="수정">
			<i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span>
		</a>
		<?php } ?>
		<?php if ($delete_href || $is_member['admin']) { ?>
		<a href="<?php echo $delete_href ?>" class="btn btn-black btn-sm" title="삭제" onclick="del(this.href); return false;">
			<i class="fa fa-times"></i><span class="hidden-xs"> 삭제</span>
		</a>
		<?php } ?>
	</div>
	<div class="view-content">
		<?php echo get_view_thumbnail($view['content']); ?>
		
		<?php
		$gNo = $_GET['wr_id'];
		$select = "SELECT * FROM g5_ranking where";
		$g_no = "g_no = ".$_GET['wr_id']."";
		$ob = "order by g_score desc";
		if($gNo == 2) {
			$ob = "order by g_score asc";
		}
		$result = sql_query("$select $g_no $ob");
		switch ($wr_id) {
			case 1:
				include_once(GLIST."a1.php");
			break;
			case 2:
				include_once(GLIST."a2.php");
			break;
		}
		?>
	</div>

	<div class="clearfix"></div>
</div>

<script>

</script>