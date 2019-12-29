<style>
.form{
    list-style-type:none;
    padding:10px;
}
.form li{
    margin:3px 0;
}

</style>
<?php
$id=$_GET['id'];
$row=find("movie",$id);

?>
<form action="./api/editmovie.php" method="post" enctype="multipart/form-data">
    <ul class="form">
        <li>影片資料</li>
        <li>片名：<input type="text" name="name" value="<?=$row['name'];?>"></li>
        <li>分級：
            <select name="level" >
                <option value="1" <?=($row['level']==1)?"selected":"";?>>普遍級</option>
                <option value="2" <?=($row['level']==2)?"selected":"";?>>保護級</option>
                <option value="3" <?=($row['level']==3)?"selected":"";?>>輔導級</option>
                <option value="4" <?=($row['level']==4)?"selected":"";?>>限制級</option>
            </select>
        </li>
        <li>片長：<input type="text" name="length" value="<?=$row['length'];?>"></li>
        <li>上映日期：
            <?php
                $year=date("Y",strtotime($row['ondate']));
                $month=date("m",strtotime($row['ondate']));
                $day=date("d",strtotime($row['ondate']));

            ?>
            <!--emmet 快速語法  select[name="year"]>option[value="$@2019"]*3>{$@2019}-->
            <select name="year">
                <option value="2019" <?=($year==2019)?"selected":"";?>>2019</option>
                <option value="2020" <?=($year==2020)?"selected":"";?>>2020</option>
                <option value="2021" <?=($year==2021)?"selected":"";?>>2021</option>
            </select> 年
            <!--emmet 快速語法  select[name="month"]>option[value="$$"]*12>{$$}-->
            <select name="month">
                <option value="01"  <?=($month=="01")?"selected":"";?>>01</option>
                <option value="02"  <?=($month=="02")?"selected":"";?>>02</option>
                <option value="03"  <?=($month=="03")?"selected":"";?>>03</option>
                <option value="04"  <?=($month=="04")?"selected":"";?>>04</option>
                <option value="05"  <?=($month=="05")?"selected":"";?>>05</option>
                <option value="06"  <?=($month=="06")?"selected":"";?>>06</option>
                <option value="07"  <?=($month=="07")?"selected":"";?>>07</option>
                <option value="08"  <?=($month=="08")?"selected":"";?>>08</option>
                <option value="09"  <?=($month=="09")?"selected":"";?>>09</option>
                <option value="10"  <?=($month=="10")?"selected":"";?>>10</option>
                <option value="11"  <?=($month=="11")?"selected":"";?>>11</option>
                <option value="12"  <?=($month=="12")?"selected":"";?>>12</option>
            </select> 月
            <!--emmet 快速語法  select[name="day"]>option[value="$$"]*31>{$$}-->
            <select name="day">
                <option value="01" <?=($day=="01")?"selected":"";?>>01</option>
                <option value="02" <?=($day=="02")?"selected":"";?>>02</option>
                <option value="03" <?=($day=="03")?"selected":"";?>>03</option>
                <option value="04" <?=($day=="04")?"selected":"";?>>04</option>
                <option value="05" <?=($day=="05")?"selected":"";?>>05</option>
                <option value="06" <?=($day=="06")?"selected":"";?>>06</option>
                <option value="07" <?=($day=="07")?"selected":"";?>>07</option>
                <option value="08" <?=($day=="08")?"selected":"";?>>08</option>
                <option value="09" <?=($day=="09")?"selected":"";?>>09</option>
                <option value="10" <?=($day=="10")?"selected":"";?>>10</option>
                <option value="11" <?=($day=="11")?"selected":"";?>>11</option>
                <option value="12" <?=($day=="12")?"selected":"";?>>12</option>
                <option value="13" <?=($day=="13")?"selected":"";?>>13</option>
                <option value="14" <?=($day=="14")?"selected":"";?>>14</option>
                <option value="15" <?=($day=="15")?"selected":"";?>>15</option>
                <option value="16" <?=($day=="16")?"selected":"";?>>16</option>
                <option value="17" <?=($day=="17")?"selected":"";?>>17</option>
                <option value="18" <?=($day=="18")?"selected":"";?>>18</option>
                <option value="19" <?=($day=="19")?"selected":"";?>>19</option>
                <option value="20" <?=($day=="20")?"selected":"";?>>20</option>
                <option value="21" <?=($day=="21")?"selected":"";?>>21</option>
                <option value="22" <?=($day=="22")?"selected":"";?>>22</option>
                <option value="23" <?=($day=="23")?"selected":"";?>>23</option>
                <option value="24" <?=($day=="24")?"selected":"";?>>24</option>
                <option value="25" <?=($day=="25")?"selected":"";?>>25</option>
                <option value="26" <?=($day=="26")?"selected":"";?>>26</option>
                <option value="27" <?=($day=="27")?"selected":"";?>>27</option>
                <option value="28" <?=($day=="28")?"selected":"";?>>28</option>
                <option value="29" <?=($day=="29")?"selected":"";?>>29</option>
                <option value="30" <?=($day=="30")?"selected":"";?>>30</option>
                <option value="31" <?=($day=="31")?"selected":"";?>>31</option>
            </select> 日
        
        </li>
        <li>發行商：<input type="text" name="publish" value="<?=$row['publish'];?>"></li>
        <li>導演：<input type="text" name="director" value="<?=$row['director'];?>"></li>
        <li>預告影片：<input type="file" name="trailer" value="<?=$row['trailer'];?>"></li>
        <li>電影海報：<input type="file" name="poster" value="<?=$row['poster'];?>"></li>
        <li>劇情簡介</li>
        <li><textarea name="intro" style="width:300px;height:100px"><?=$row['intro'];?></textarea></li>
        <li>
            <!--建立一個隱藏欄位並填入資料的id值-->
            <input type="hidden" name="id" value="<?=$row['id'];?>">
            <input type="submit" value="修改"><input type="reset" value="重置">
        </li>
    </ul>
</form>