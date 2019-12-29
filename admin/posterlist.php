<?php
include_once "../base.php";

//取得poster資料表的所有資料，並加入排序的語法
$poster=all("poster",[]," order by rank");

//以迴圈來印出所有的資料內容
foreach($poster as $p){
?>
<ul class="row">
    <li><img src="./poster/<?=$p['poster'];?>" style="width:80px;height:100px"></li>
    <li><input type="text" name="name[]" value="<?=$p['name'];?>"></li>
    <li><input type="button" value="往上"><input type="button" value="往下"></li>
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