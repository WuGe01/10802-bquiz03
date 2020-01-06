<?php

include_once "../base.php";

//取得前端傳過來的電影id及日期資料
$id=$_POST['id'];
$date=$_POST['date'];

//取得目前的小時
$now=date("H");

//計算要開始顯示的場次(1,2,3,4,5)
$start=($date==date("Y-m-d") && $now >= 14)?floor(($now-10)/2):1;

//最多顯示五個場次，所以使用for迴圈來顯示可以訂票的場次選項內容
for($i=$start;$i<=5;$i++){

  //根據場次來計算已被訂走的座位
  $qt=q("select sum(`qt`) from ord where movie='".find("movie",$id)['name']."' && date='$date' && session='".$sess[$i]."'")[0][0];
  
  //顯示場次資料及剩餘座位數
  echo "<option value='".$sess[$i]."'>".$sess[$i]." 剩餘座位 ".(20-$qt)."</option>";
}

?>