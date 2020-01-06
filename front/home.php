<!--預告片介紹-->
<style>
#slider{
  height:350px;
}

/*設定#slider的所有子元表都有border-box的模式，比較好控制大小 */
#slider *{
  box-sizing:border-box;
}

/*設定海報展示區和按鈕區的大小和位置，這邊最重要的是position的設定
 *由於我們會進行物件位置及大小的屬性改變，因此定位要設為relative或absolute
 *這樣物件本身才會擁有一些參數可供javascript做修改 */

#slider .lists{
  width:180px;
  height:240px;
  margin:auto;
  position:relative;
}
#slider .controls{
  width:90%;
  height:100px;
  margin:5px auto 0 auto;
  position:relative;

  display:flex;
  align-items:center;
  justify-content:space-between;
}

/*箭頭的製作這邊採用css的方式來產生兩個方向的按鈕
 *也可以使用第一題的兩個按鈕或是自行繪製 */

.la,.ra{
  border-top:15px solid transparent;
  border-bottom:15px solid transparent;
}
.la{
  border-right:25px solid yellow;
}
.ra{
  border-left:25px solid yellow;
}
.btns{
  width:80%;
  display:flex;
  overflow:hidden;
}

.btns .icon{
  width:25%;
  height:80px;
  padding:5px;
  flex-shrink:0;
  position:relative;
}
.poster{
  position:absolute;
  display:none;
}
.poster img{
  width:100%;
  display:block;
}
.poster .name{
  text-align:center;
  font-weight:bold;
}
.icon img{
  width:70%;
  display:block;
  margin:auto;
  border:1px solid white;  
}
.icon img:hover{
  border:2px solid white;  
}
.icon .name{
  font-size:12px;
  text-align:center;
}
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="slider">
            <div class="lists">
              <?php

              //取得符合條件的資料並排序資料
              $pos=all("poster",["sh"=>1]," order by rank");

              //使用迴圈來取出每一筆資料
              foreach($pos as $k => $p){
              ?>
              <!--在標籤中加入data-ani屬性，用來代表這筆資料的轉場動畫-->
              <div class="poster" data-ani="<?=$p['ani'];?>">
                <img src="./poster/<?=$p['poster'];?>" >
                <div class="name"><?=$p['name'];?></div>
              </div>
              <?php
              }
              ?>
            </div>
            <div class="controls">
              <div class="la"></div>
              <div class="btns">
                <?php

                //再次用迴圈來將每筆資料再印出一次，圖片的大小及排列方式由css來控制
                foreach($pos as $k => $p){
                ?>
                <div class="icon">
                  <img src="./poster/<?=$p['poster'];?>">
                  <div class="name"><?=$p['name'];?></div>

                </div>
                <?php
                }
                ?>
              </div>
              <div class="ra"></div>
            </div>
        </div>
    </div>
</div>
<script>
//先讓第一張圖顯示出來
$(".poster").eq(0).show();

//計算有多少張預告片海報
let total=$(".poster").length

//設定一個變數用來表示目前要置換的下一張海報索引值
let next=1;

//設定每2.5秒執行一次預告片的輪播，並執行自訂函式ani
let slide=setInterval(ani,2500)

//建置一個轉場動畫的函式
function ani(){

  //取得目前顯示中的預告片海報物件
  let show=$(".poster:visible")

  //取得要轉場的下一張預告片海報的動畫值
  let ani=$(".poster").eq(next).data("ani")

  //利用switch()來切換要執行的轉場動畫
  switch(ani){
    case 1:
      //淡入淡出
      $(show).fadeOut(1000,function(){
        
        //先執行1秒長度的fadeOut淡出後，再接著執行1秒長度的fadeIN淡入
        $(".poster").eq(next).fadeIn(1000)
        
        //整個動畫執行完畢後再接著檢查下一張輪播的索引值
        chkNext()
      })
      
    break;
    case 2:
    //滑入滑出
      $(show).slideUp(1000,function(){

        //先執行1秒長度的slideUp滑出後，再接著執行1秒長度的slideDown滑入
        $(".poster").eq(next).slideDown(1000)
        chkNext()
      })
    break;
    case 3:
    //縮放
      $(show).hide(1000,function(){

        //先執行1秒長度的hide縮小及淡出後，再接著執行1秒長度的放大及淡入
        $(".poster").eq(next).show(1000)
        chkNext()
      })
    break;
  }
}

function chkNext(){
  //檢查next值是否己經到了索引值的上限(假設總張數為6，那索引值會是0~5)
  //如果next值未到上限，則下一張海報為next++，如果己經到了上限則next=0
  if(next<(total-1)){
    next++
  }else{
    next=0;
  } 
}
//對icon區的按鈕進行點擊事件註冊，點擊後會更改next變數的值，會在下一次輪播時改成顯示點擊的預告片海報
$(".icon").on("click",function(){
  next=$(this).index(".icon")

  //如果有啟用暫停輪播的功能，那這邊要入執行轉場的函式
  ani();
})

//建立一個變數mov用來紀錄向左及向右的次數
let mov=0;

//建立一個變數w用來紀錄目前按鈕區的每個按鈕寬度
let w=$(".icon").outerWidth()

//註冊.ra及.la兩個按鈕的點擊事件
$(".ra,.la").on("click",function(){

  //依照class的名稱來切換是要向右移動還是向左移動
  switch($(this).attr("class")){
    case "ra":
      //按鈕區一次顯示四個，因此最多可以向右的次數為(total-4)
      //向右移動時，先檢查mov值是否超過total-4
      if(mov<(total-4)){

        //將移動次數加一
        mov++

        //使用animate函式將所有的按鈕都移動至右方w*mov的位置
        $(".icon").animate({right:w*mov})
      }
    break;
    case "la":
    //向左移動

      //向左移動時，先判斷mov值是否大於0
      if(mov>0){

        //將移動次數減一
        mov--

        //使用animate函式將所有的按鈕都移動至右方w*mov的位置
        $(".icon").animate({right:w*mov})
      }
    break;
  }
  showArrow();
})
showArrow();
//不做也不會扣分,僅供參考
//偵測mov來判斷是否顯示向右向左按鈕
function showArrow(){
  //以直接修改css的方式來改變按鈕的顏色，這個做法不會變動dom的位置和大小
  //如果直接使用hide()或show()來改變按鈕，則按鈕區會因為位置和大小的變化而有不同的排列方式
       if(mov==0){
        $(".la").css({"border-right":"25px solid transparent"});
      }else if(mov==(total-4)){
        $(".ra").css({"border-left":"25px solid transparent"});
      }else{
        $(".la").css({"border-right":"25px solid yellow"});
        $(".ra").css({"border-left":"25px solid yellow"});
      } 
}

//不做也不會扣分,僅供參考
//偵測滑鼠是否有進入按鈕區，有的話先暫停自動輪播，離開時再重新輪播，
//這是為了避免在動畫執行完畢前，next值或其它變數如果被突然改變時，可能會發生問題
$(".btns").hover(
  function(){
    //滑鼠移入時清除輪播
    clearInterval(slide)
  },
  function(){
    //滑鼠移出時繼續輪播
    slide=setInterval(ani,2500);
  }
) 
    
</script>

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