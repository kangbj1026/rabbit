<?php
include_once('../common.php');

$search = trim(strip_tags($_GET['search']));
$result = sql_query("select * FROM {$g5['write_prefix']}manage where wr_subject LIKE '%$search%' group by wr_subject order by wr_subject asc;");
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$subject = str_replace($search,"<b>".$search."</b>",$row['wr_subject']);
	$return_arr[] = array("wrId" => $row['wr_id'], "subject" => $subject, "search" => $search);
}
echo json_encode($return_arr);

?>
