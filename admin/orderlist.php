<style>
.row{
    background:white;    
    margin:2px auto;
    width:95%;
    list-style-type:none;
    padding:3px;
    display:flex;
    color:black;
    align-items:center;

}
.row li{
    width:calc( 100% / 7 );
    text-align:center;
    margin:3px 1px;
}


</style>
<ul class="row">
  <li>訂單編號</li>
  <li>電影名稱</li>
  <li>日期</li>
  <li>場次時間</li>
  <li>訂購數量</li>
  <li>訂購位置</li>
  <li>操作</li>
</ul>

<?php
include_once "../base.php";

//取出所有的電影資料並增加排序的語法
$ords=all("ord",[]," order by no desc");

foreach($ords as $key => $o){

?>
<ul class="row">
<li><?=$o['no'];?></li>
<li><?=$o['movie'];?></li>
<li><?=$o['date'];?></li>
<li><?=$o['session'];?></li>
<li><?=$o['qt'];?></li>
<li>
<?php
  //將座位字串以unserialize()還原成為陣列
  $o['seat']=unserialize($o['seat']);

  //印出座位，並計算幾排幾號
  foreach($o['seat'] as $seat){
    echo "<div>".(floor($seat/5)+1)."排".(($seat%5)+1)."號</div>";
  }

?>
</li>
<li><button class="delBtn" data-del="<?=$o['id'];?>">刪除</button></li>
</ul>
<?php
}
?>