<?php
include_once "../base.php";

$table=$_POST['table'];
$id=$_POST['id'];

$row=find($table,$id);
$row['sh']=($row['sh']+1)%2;
save($table,$row);
?>