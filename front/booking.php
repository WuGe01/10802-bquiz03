<style>
.load *{
  box-sizing:border-box;
}
.info{
  background:#ccc;
  width:540px;
  margin:auto;
  padding:5px 90px;
}
.info li{
  list-style-type:none;
  padding:0;
  margin:5px 0;
}
.room{
  width:540px;
  height:370px;
  margin:auto;
  background:url("./icon/03D04.png") no-repeat center;
  display:flex;
  flex-wrap:wrap;
  align-content:start;
  padding:17px 110px 0 110px;

}
.room .seat{
  width:64px;
  height:87px;
  position:relative;
}
.room .null{
  background:url("./icon/03D02.png") no-repeat center;
}
.room .pick{
  background:url("./icon/03D03.png") no-repeat center;
}
.room .chk{
  position:absolute;
  bottom:5px;
  right:5px;
}
</style>
<?php

include_once "../base.php";

//取得選單傳送過來的電影id 及日期和場次資料
$id=$_POST['id'];
$date=$_POST['date'];
$session=$_POST['session'];

//根據以上條件，從ord資料表中取出符合的場次訂票紀錄
$row=all("ord",["movie"=>find("movie",$id)['name'],
                "date"=>$date,
                "session"=>$session]);

//宣告一個空陣列
$seat=[];
foreach($row as $r){

  //利用array_merge()函式將每筆訂票的座位合併成一個陣列
  $seat=array_merge($seat,unserialize($r['seat']));
}

//利用array_fill()函式來建立一個有20個元素，且值都為0的陣列
$new=array_fill(0,20,0);

//利用迴圈將$new陣列中對應$seat陣列中的座位位置設為1，表示該座位己經被訂走了
foreach($seat as $k){
  $new[$k]=1;
}

?>
<div class="room">
<?php

for($i=0;$i<20;$i++){

  //判斷該位置是否已經被訂走了，用來決定要顯示的內容
  if($new[$i]==1){
    echo "<div class='seat pick'>";
  }else{
    echo "<div class='seat null'>";
    echo "<input type='checkbox' value='".$i."' class='chk'>";
  }

  //利用計算式來顯示畫面上要求的幾排幾號
  echo "<div class='ct'>".(floor($i/5)+1)."排".(($i%5)+1)."號</div>";
  echo "</div>";
}

?>

</div>
<div class="info">
  <!--顯示上一個步驟傳過來的電影資訊內容-->
  <li>您選擇的電影是：<?=find("movie",$id)['name'];?></li>
  <li>您選擇的時刻是：<?=$date."&nbsp;&nbsp;".$session;?></li>
    <!--建立一個<span></span>標籤區用來放置票數-->
  <li>您已經勾選<span class="ticket"></span>張票，最多可以購買四張票</li>
  <li class="ct">
    <button class="prev">上一步</button>
    <button class="order">訂購</button>
  </li>
</div>

<script>

//建立一個全域變數count及一個用來放置座位的陣列
let count=0;
let seats=new Array();

//註冊checkbox的點擊事件
$(".chk").on("click",function(){
  
  //取得座位值
  let seat=$(this).val();

  //利用jQuery()的.prop()方法來取得checkbox的狀態
  if($(this).prop("checked")==true){

    //如果票數小於4張則把票數加1，同時把座位號加入到座位陣列中
    if(count<4){
      count++;
      seats.push(seat)
      
    }else{

      //如果票數超過四張，則出現提示訊息，並把checkbox設為未選取
      alert("最多只能訂四張票")
      $(this).prop("checked",false)

    }

  }else{

    //如果使用者是取消選取，則票數減一，
    //同時也要在座位陣列中把座位號刪除
    count--;
    seats.splice(seats.indexOf(seat),1)

  }

  //在ticket的區塊中顯示票數
  $(".ticket").html(count)
})

//點擊上一步時，讓選單區塊顯示出來，同時把.load區塊的內容清空
$(".prev").on("click",function(){
  $("form").show();
  $(".load").html("")
})

//點擊訂購按鈕時，傳送劃位的資訊給result.php，
//同時把result.php處理完的結果頁面載入到load區塊中
$(".order").on("click",function(){

  $(".load").load("./front/result.php",{seats,"movie":"<?=find("movie",$id)['name'];?>","date":"<?=$date;?>","session":"<?=$session;?>"})
})
</script>