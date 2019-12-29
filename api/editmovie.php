<?php
include_once "../base.php";
 
 //建立資料表變數，但因為只會有院線片功能使用到這個API，所以不建這個變數也沒關係。
 $table="movie";

 //判斷是否有帶id這個變數，如果有id值的話表示是編輯資料，如果沒有id值的話那就是新增資料
 if(!empty($_POST['id'])){

     //如果是編輯資料的話，先取得資料
     $data=find($table,$_POST['id']);

 }else{

     //如果是新增資料的話，先從資料表中取得最大的id值加1成為排序欄位的值
     $data['rank']=q("select max(`id`) from $table")[0][0]+1;

     //預設資料都是顯示
     $data['sh']=1;
 }

 //判斷是否有上傳海報檔案
 if(!empty($_FILES['poster']['tmp_name'])){
     $data['poster']=$_FILES['poster']['name'];
     move_uploaded_file($_FILES['poster']['tmp_name'],"../movie/".$data['poster']);
 }

 //判斷是否有上傳預告影片
 if(!empty($_FILES['trailer']['tmp_name'])){
     $data['trailer']=$_FILES['trailer']['name'];
     move_uploaded_file($_FILES['trailer']['tmp_name'],"../movie/".$data['trailer']);
 }

 //利用迴圈來檢查一次$_POST陣列，看看有那些資料是要更新或寫入欄位的
 foreach($_POST as $key => $value){
    switch($key){
        case "year":  //針對年月日三個表單欄位先跳過不處理
        case "month":
        case "day":
        break;
        default:
            $data[$key]=$value;  //除了年月日三個欄位外，其它欄位的名稱和值都直接寫入$data陣列中
    } 
 }
    //將年月日的欄位組合成日期字串格式
    $data['ondate']=$_POST["year"]."-".$_POST['month']."-".$_POST['day'];

 //新增/更新資料表
 save($table,$data);

 //回到院線片管理頁面
 to("../admin.php?do=movie");
?>