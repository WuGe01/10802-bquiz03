<?php
include_once "../base.php";

//取得資料表名
$table=$_POST['table'];

//取得要交換的兩個id
$id1=$_POST['id'][0];
$id2=$_POST['id'][1];

//分別取出要交換的兩筆資料
$row1=find($table,$id1);
$row2=find($table,$id2);

//分別紀錄兩筆資料的rank值
$rank1=$row1['rank'];
$rank2=$row2['rank'];

//將兩筆資料的rank值交換指定
$row1['rank']=$rank2;
$row2['rank']=$rank1;

//將交換排序值的資料存回資料表
save($table,$row1);
save($table,$row2);
?>