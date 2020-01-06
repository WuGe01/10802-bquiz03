<?php 

//建立PDO
$dsn="mysql:host=localhost;charset=utf8;dbname=db03";
$pdo=new PDO($dsn,"root","");

//啟用session
session_start();

//設定時區
date_default_timezone_set("Asia/Taipei");

//建立一個分級資訊的陣列，儲存分級的icon檔名及分級的字串
$level=[
  1 => ["03C01.png","普遍級"],
  2 => ["03C02.png","輔導級"],
  3 => ["03C03.png","保護級"],
  4 => ["03C04.png","限制級"],
];

//建立一個場次的文字陣列，儲存場次的字串，方便取用
$sess=[
  1 => "14:00~16:00",
  2 => "16:00~18:00",
  3 => "18:00~20:00",
  4 => "20:00~22:00",
  5 => "22:00~24:00"
];

//取得單筆資料
function find($table,...$arg){
  global $pdo;

  $sql="select * from $table where ";

  if(is_array($arg[0])){

    foreach($arg[0] as $key => $value){

      $tmp[]=sprintf("`%s`='%s'",$key,$value);

    }

    $sql=$sql . implode(" && ",$tmp);

  }else{

    $sql=$sql . " `id`='".$arg[0]."'";

  }

  //echo $sql;

  return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

}


//取得全部資料
function all($table,...$arg){
  global $pdo;

  $sql="select * from $table ";

    if(!empty($arg[0])){

      foreach($arg[0] as $key => $value){

        $tmp[]=sprintf("`%s`='%s'",$key,$value);

      }
      $sql=$sql . " where " . implode(" && ",$tmp);

    }    

    if(!empty($arg[1])){

      $sql=$sql . $arg[1];

    }

  //echo $sql;

  return $pdo->query($sql)->fetchAll();
}

//計算資料筆數
function nums($table,...$arg){
  global $pdo;

  $sql="select count(*) from $table ";

    if(!empty($arg[0])){

      foreach($arg[0] as $key => $value){

        $tmp[]=sprintf("`%s`='%s'",$key,$value);

      }

      $sql=$sql . " where " . implode(" && ",$tmp);

    }    

    if(!empty($arg[1])){

      $sql=$sql . $arg[1];

    }

  //echo $sql;

  return $pdo->query($sql)->fetchColumn();  

}

//新增/編輯單筆資料
function save($table,$data){
  global $pdo;

  if(!empty($data['id'])){
    //update

    foreach($data as $key => $value){

      if($key!="id"){

        $tmp[]=sprintf("`%s`='%s'",$key,$value);

      }

    }

    $sql="update $table set ".implode(",",$tmp)." where `id`='".$data['id']."'";

  }else{
    //insert
    $sql="insert into $table (`".implode("`,`",array_keys($data))."`) value('".implode("','",$data)."')";

  }

  //echo $sql;
  return $pdo->exec($sql);
}


//刪除資料
function del($table,...$arg){
  global $pdo;

  $sql="delete from $table where ";

  if(is_array($arg[0])){

    foreach($arg[0] as $key => $value){

      $tmp[]=sprintf("`%s`='%s'",$key,$value);

    }

    $sql=$sql . implode(" && ",$tmp);

  }else{

    $sql=$sql . " `id`='".$arg[0]."'";

  }

  //echo $sql;

  return $pdo->exec($sql);
}


//查詢資料
function q($sql){
  global $pdo;

  return $pdo->query($sql)->fetchAll();

}

//頁面導向
function to($path){
  
  header("location:".$path);

}

?>