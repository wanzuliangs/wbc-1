<?php

require_once ('util/db.php');

@$cb = $_GET['callback'];
@$pageSize = $_GET['size'];
@$page = $_GET['page'];

if (!isset($page)) {
    $page = 0;
}

if (!isset($pageSize)) {
    $pageSize = 20;
}

$start = $pageSize * $page;

$sql = "select * from talk where 1=1";
$sql2 = "select count(*) as count from talk where 1=1";

$sql .= " order by id desc limit $start, $pageSize";

$books = $db -> rawQuery($sql);

$books_count = $db -> rawQuery($sql2);
$total = $books_count[0]['count'];

if ($books) {
	echo $cb . '(' . json_encode(Array("success" => true, "total" => $total, "data" => $books, "message" => "请求成功")) . ')';
} else {
	echo $cb . '(' . json_encode(Array("success" => true, "total" => 0, "data" => [], "message" => "请求失败"))  . ')';
}

?>