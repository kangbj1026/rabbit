<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$g5['title'] = 'scoressever';

$g5_ranking  = "g5_ranking";
//if(!$board['bo_table']) {
//	exit; //존재하지 않는 게시판은 작동안함
//}
$gNo = $_POST['wr_id'];
$gName = $_POST['bo_table'];
$gScore = $_POST['clicknum'];
$uName = $_POST['wr_name'];
$w = $_POST['w'];

if(!$w){

} else {
	$sql = "INSERT INTO $g5_ranking (g_no,g_name,g_score,u_name) VALUES ($gNo, '$gName', $gScore, '$uName');";
	echo "<h2>";
	echo print_r($sql);
	echo "</h2>";
	sql_query($sql);
	goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr);
}
?>