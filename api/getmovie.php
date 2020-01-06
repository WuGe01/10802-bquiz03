<?php

include_once "../base.php";

//取得前端傳過來的電影id值，如果值為0則表示要從第一筆開始顯示
//如果id有值，則表示要將該部電影設為selected
$id=$_POST['id'];

//建立今天的日期字串
$today=date("Y-m-d");

//計算到今天為止可以訂票的電影上映日(從今天開始起算後退兩天)
$ondate=date("Y-m-d",strtotime("-2 days"));

//建立起SQL語法用來取得符合條件的電影，排序可有可無，題目並沒有要求選單需要排序
$sql="select * from movie where ondate >='$ondate' && ondate <='$today' && sh='1' order by rank";
$movies=q($sql);

//使用foreach來建立起電影的選項內容
foreach($movies as $k => $m){

  //判斷電影id是否和傳過來的id一樣，是的話
  //則這部電影要設為selected
  $selected=($m['id']==$id)?"selected":"";
  echo "<option value='".$m['id']."' $selected>".$m['name']."</option>";
  
}

?>