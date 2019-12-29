<?php
include_once "../base.php";

//利用迴圈來檢查每一筆資料的狀態及要進行的動作
foreach($_POST['id'] as $key => $id){

    //檢查del陣列是否存在，及id是否在陣列中
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
        del("poster",$id);
    }else{

        //取出資料
        $data=find("poster",$id);

        //檢查每一個對應的陣列內容並更新資料內容
        $data['sh']=(in_array($id,$_POST['sh']))?1:0;
        $data['name']=$_POST['name'][$key];
        $data['ani']=$_POST['ani'][$key];

        //存回資料表
        save("poster",$data);
    }
}

//回到預告片海報頁面
to("../admin.php?do=poster");
?>