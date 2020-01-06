<!--預告片介紹-->
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
            <ul class="lists">
            </ul>
            <ul class="controls">
            </ul>
        </div>
    </div>
</div>

<!--院線片清單功能-->
<style>
.movie-list{
  display:flex;
  flex-wrap:wrap;
  justify-content:start;
}
.movie-box{
  width:48%;
  margin:0.5%;
  box-sizing:border-box;
  border:1px solid #ccc;
  border-radius:10px;
  display:flex;
  flex-wrap:wrap;
  padding:10px 3px;
}
.movie-poster{
  width:30%;
}
.movie-poster img{
  width:55px;
  height:70px;
  border:2px solid white;
}
.movie-info{
  width:70%;
}
.movie-info li{
  padding-left:5px;
  list-style-type:none;
  font-size:14px;
}
.movie-info li:nth-child(1){
  font-size:18px;
}
.movie-info li img{
  width:20px;
  vertical-align:middle;
}
.movie-btn{
  width:100%;
}
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
      <div class="movie-list">
      <?php
        //建立以觀影當日為基礎的上映期間資訊
        $today=date("Y-m-d");
        $startDay=date("Y-m-d",strtotime("-2 days"));

        //取得符合條件的電影數量
        $total=q("select count(*) from movie where sh=1 && ondate >='$startDay' && ondate <='$today'")[0][0];

        //四筆分一頁
        $div=4;

        //計算總頁數
        $pages=ceil($total/$div);

        //取得當前頁
        $now=(!empty($_GET['p']))?$_GET['p']:1;

        //計算資料表中的起始值
        $start=($now-1)*$div;

        //取得符合條件的電影內容
        $movies=q("select * from movie where sh=1 && ondate >='$startDay' && ondate <='$today' order by rank limit $start,$div");

        //使用迴圈來印出電影列表內容
        foreach($movies as $m){
        ?>
          <div class="movie-box">
          <div class="movie-poster">
          <!--在圖片連結中增加簡介需要的資訊-->
          <a href="index.php?do=intro&id=<?=$m['id'];?>"><img src="./movie/<?=$m['poster'];?>"></a>
          </div>
          <div class="movie-info">
          <li><?=$m['name'];?></li>
          <li>分級：
            <img src="./icon/<?=$level[$m['level']][0];?>" alt="">
            <?=$level[$m['level']][1];?>
          </li>
          <li>上映日期：<br><?=$m['ondate'];?></li>
          </div>
          <div class="movie-btn">
            <!--使用js來做導頁，並在連結中增加需要的資訊-->
            <button onclick="javascript:location.href='index.php?do=intro&id=<?=$m['id'];?>'">劇情簡介</button>
            <button onclick="javascript:location.href='index.php?do=order&id=<?=$m['id'];?>'">線上訂票</button>
          </div>
          </div>
        <?php
        }

      ?>

      </div>

        <div class="ct a"> 
        
        <?php
        //建立分頁導覽列
        if(($now-1)>0){
          echo "<a href='index.php?p=".($now-1)."' style='font-size:18px'> < </a>";
        }

        for($i=1;$i<=$pages;$i++){
          $fontSize=($now==$i)?"24px":"18px";
          echo "<a href='index.php?p=$i' style='font-size:$fontSize'> $i </a>";
        }

        if(($now+1)<=$pages){
          echo "<a href='index.php?p=".($now+1)."' style='font-size:18px'> > </a>";
        }
        ?>
        
        </div>
    </div>
</div>