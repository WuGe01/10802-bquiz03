<style>
.row{
    background:white;
    margin:2px auto;
    width:95%;
    list-style-type:none;
    padding:3px;
    display:flex;
    color:black;
}
.row li:nth-child(1){
    width:15%;  
}
.row li:nth-child(2){
    width:20%;  
}
.row li:nth-child(3){
    width:65%;
}

</style>
<?php
include_once "../base.php";

//取出所有的電影資料並增加排序的語法
$movies=all("movie",[]," order by rank");

foreach($movies as $key => $m){

//計算前一筆及下一筆資料id    
$prev=($key!=0)?$movies[$key-1]['id']:$m['id'];
$next=($key!=(count($movies)-1))?$movies[$key+1]['id']:$m['id'];
?>
<ul class="row">
    <li>
        <img src="./movie/<?=$m['poster'];?>" style="width:100px;height:120px">
    </li>
    <li>
        <div>分級：<img src="./icon/<?=$level[$m['level']][0];?>" style="width:20px;height:20px"></div>
        <div>片名：<?=$m['name'];?></div>
        <div>片長：<?=$m['length'];?></div>
        <div>上映時間：<?=$m['ondate'];?></div>
    </li>
    <li>
        <div>
        <button class="shBtn" data-show="<?=$m['id'];?>"><?=($m['sh']==1)?"顯示":"隱藏";?></button>
            <button class="shiftBtn" id="<?=$m['id'] . "-" . $prev;?>">往上</button>
            <button class="shiftBtn" id="<?=$m['id'] . "-" . $next;?>">往下</button>
            <!--增加資料id在編輯電影的連結上，方便後續製作編輯電影功能時使用-->
            <button onclick="javascript:location.href='admin.php?do=editmovie&id=<?=$m['id'];?>'">編輯電影</button>
            <button class="delBtn" data-del="<?=$m['id'];?>">刪除電影</button>
        </div>
        <div>
            <?=$m['intro'];?>
        </div>
    </li>
</ul>
<?php
}
?>