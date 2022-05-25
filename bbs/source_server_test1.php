<?php
include_once("./_common.php");
//DB 조회 쿼리문
$sql = "SELECT * FROM g5_ajax_test";
//SQL 명령어 실행~
$result = sql_query($sql);

//DB에서 가져온 데이타를 PHP 배열에 각각 넣어서 JSON으로 전달해 주자.
$db_seq = array();
$db_name = array();
$db_age = array();
$db_email = array();
$test_array = array();

//한글은 iconv를 해줘야 안깨지더군요. 이부분은 환경에 맞춰서 각자 하시면 좋을듯.
while($row = sql_fetch_array($result)) {
    array_push($db_seq, $row['seq']);
    array_push($db_name,$row['name']);
    array_push($db_age, $row['age']);
    array_push($db_email, $row['email']);
}

//최종 결과를 json으로 전달해 주자.
echo(json_encode(array("mode" => $_REQUEST['mode'], "seq" => $db_seq, "name" => $db_name, "age" => $db_age, "email" => $db_email)));

?>