<?php
include_once "../base.php";

//先將$_POST['seats']的陣列內容做排序
sort($_POST['seats']);

//將座位陣列轉為序列字串的形式才能存入資料庫
$data['seat']=serialize($_POST['seats']);
$data['movie']=$_POST['movie'];
$data['date']=$_POST['date'];
$data['session']=$_POST['session'];

//訂單編號的產生
$data['no']=date("Ymd") . sprintf("%04d",q("select max(`id`)+1 from ord")[0][0]);

//計算這筆訂單的座位數
$data['qt']=count($_POST['seats']);

//存入資料庫
save("ord",$data);

?>
<!--產生結果頁面內容-->
<table class="result">
  <tr>
    <td colspan="2">感謝您的訂購，您的訂單編號是：<?=$data['no'];?></td>

  </tr>
  <tr>
    <td>電影名稱：</td>
    <td><?=$data['movie'];?></td>
  </tr>
  <tr>
    <td>日期：</td>
    <td><?=$data['date'];?></td>
  </tr>
  <tr>
    <td>場次時間：</td>
    <td><?=$data['session'];?></td>
  </tr>
  <tr>
    <td colspan="2">
      <div>座位：</div>
      <?php
        foreach($_POST['seats'] as $seat){
          echo "<div>".(floor($seat/5)+1)."排".(($seat%5)+1)."號</div>";
        }

      ?>
      <div>共<?=$data['qt'];?>張電影票</div>
    </td>
  </tr>
  <tr>
    <td colspan="2">
        <button onclick="javascrpt:location.href='index.php'">確定</button>
    </td>
    
  </tr>
</table>
