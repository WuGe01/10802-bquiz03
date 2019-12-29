<?php

include "base.php";

for($i=1;$i<=10;$i++){
    $data['level']=rand(1,4);
    $data['name']="院線片".$i;
    $data['length']=90;
    $data['ondate']=date("Y-m-d",strtotime("+".(($i-2)%5)." days"));
    $data['publish']="發行商".$i;
    $data['director']="導演".$i;
    $data['trailer']="03B".sprintf("%02d",$i)."v.mp4";
    $data['poster']="03B".sprintf("%02d",$i).".png";
    $data['intro']="院線片".$i."的劇情簡介"."院線片".$i."的劇情簡介"."院線片".$i."的劇情簡介"."院線片".$i."的劇情簡介"."院線片".$i."的劇情簡介"."院線片".$i."的劇情簡介";
    $data['rank']=$i;
    $data['sh']=1;
    save("movie",$data);
  }

?>