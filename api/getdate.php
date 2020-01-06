<?php

include_once "../base.php";

//取得前端傳過的電影id值
$id=$_POST['id'];

//建立今天的時間數值以做比較之用
$today=strtotime(date("Y-m-d"));

//取得電影資料
$movie=find("movie",$id);

//取得電影的上映日期並轉成數值
$ondate=strtotime($movie['ondate']);

//上映期間為上映日起算的三天，因此使用for迴圈來跑三次
//並逐一比對日期數值是否大於今天的時間，比今天晚的電影才是可以訂票的電影
for($i=0;$i<3;$i++){

  //利用strtotime()來轉換上映期間的日期為數值
  $date=strtotime("+$i days",$ondate);

  //將上映日期與今天相比，只有今天以後的日期才能被訂票
  if($date>=$today){
    echo "<option value='".date("Y-m-d",$date)."'>".date("m月d日 l",$date)."</option>";
  }
}

?>