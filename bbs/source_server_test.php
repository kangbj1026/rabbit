<?php
include_once("./_common.php");
//DB 조회 쿼리문
$sql = "SELECT * FROM g5_ajax_test";
//SQL 명령어 실행~
$result = sql_query($sql);

//데이타베이스에 있는 정보를 가져오자~ 루프를 돌면서 전체 데이타를 HTML 만들어서 보내줘야지.
while($row = sql_fetch_array($result)) {
	echo "<tr>";
	echo '<td width="1%">'.$row['seq'].'</td>';
	echo '<td width="3%">'.$row['name'].'</td>';
	echo '<td width="2%">'.$row['age'].'</td>';
	echo '<td width="5%">'.$row['email'].'</td>';
	echo "</tr>";
}
?>