<?php
include_once "../base.php";

//檢查是否有上傳檔案
if(!empty($_FILES['poster']['tmp_name'])){

    //從$_FILES陣列中取得資料
    $data["poster"]=$_FILES['poster']['name'];

    //搬移上傳的檔案到指定的目錄下
    move_uploaded_file($_FILES['poster']['tmp_name'],"../poster/".$data['poster']);

    //建立要存入資料表的資料陣列
    $data['name']=$_POST['name'];

    //利用max函式來取得當前資料表的id欄位最大值，將最大值加1後就是這筆資料的id值，同時也是預設的排序值
    $data['rank']=q("select max(`id`) from `poster`")[0][0]+1;

    //預設顯示和動畫的值都是1
    $data['sh']=1;
    $data['ani']=1;

    //新增至資料庫
    save("poster",$data);
}

//回到預告片管理頁面
to("../admin.php?do=poster");

?>