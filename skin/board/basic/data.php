<?php
	// 전체 검색 data
	include_once('../../../common.php');
	$bo_tbl = "offer";
	$bo_tbl1 = "search";
	$sql = "( SELECT wr_subject FROM {$g5['write_prefix']}{$bo_tbl} ) 
			UNION 
			( SELECT wr_subject FROM {$g5['write_prefix']}{$bo_tbl1} ORDER BY wr_subject DESC )";
	//$sql = " SELECT wr_subject FROM {$g5['write_prefix']}{$bo_table} WHERE 1 ORDER BY wr_subject DESC";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))
    {	
		echo $row['wr_subject'].'|';
	}
?>