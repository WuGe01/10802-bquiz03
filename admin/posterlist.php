<?php
include_once "../base.php";

//取得poster資料表的所有資料，並加入排序的語法
$poster=all("poster",[]," order by rank");

//以迴圈來印出所有的資料內容
foreach($poster as $key => $p){

//計算並取得上一筆及下一筆資料的id值
$prev=($key!=0)?$poster[$key-1]['id']:$p['id'];
$next=($key!=(count($poster)-1))?$poster[$key+1]['id']:$p['id'];

?>
<ul class="row">
    <li><img src="./poster/<?=$p['poster'];?>" style="width:80px;height:100px"></li>
    <li><input type="text" name="name[]" value="<?=$p['name'];?>"></li>
    <li>
        <!--在id值中建立要交換的資料id，使用 '-' 來做為區隔-->
        <input type="button" value="往上" id="<?=$p['id'] . "-" . $prev;?>">
        <input type="button" value="往下" id="<?=$p['id'] . "-" . $next;?>">
    </li>
    <li>
        <input type="checkbox" name="sh[]" value="<?=$p['id'];?>" <?=($p['sh']==1)?"checked":"";?>>顯示
        <input type="checkbox" name="del[]" value="<?=$p['id'];?>">刪除
        <select name="ani[]">
            <option value="1" <?=($p['ani']==1)?"selected":"";?>>淡入淡出</option>
            <option value="2" <?=($p['ani']==2)?"selected":"";?>>縮放</option>
            <option value="3" <?=($p['ani']==3)?"selected":"";?>>滑入滑出</option>
        </select>
    </li>
    <!--以隱藏欄位的方式加入每筆資料的id-->
    <input type="hidden" name="id[]" value="<?=$p['id'];?>">
</ul>
<?php
}
?>