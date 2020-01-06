<style>
.orderist{
    width:100%;
    height:400px;
    overflow:auto;
}
/*設定標題橫條的css內容 */
h3{
    margin:0;
    padding:5px;
    background:#555;
    color:white;
    text-align:center;
    border:1px solid black;
}
</style>
<h3>訂單清單</h3>
<div class="fun">
  快速刪除：
  <input type="radio" name="type" value="1" checked>依日期
  <input type="text" name="date" id="date">
  <input type="radio" name="type" value="2">依電影
  <select name="movie" id="movie">
    <?php
      $sql="select movie from ord group by movie";
      $mlist=q($sql);
      foreach($mlist as $m){
        echo "<option value='".$m['movie']."'>".$m['movie']."</option>";
      }
    ?>

  </select>
  <button onclick="qDel()">刪除</button>
</div>

<div class="orderlist">



</div>

<script>

//在頁面載入完成後先執行一次getList()函式，用來取得預告片海報的列表內容
getList();

//用來向movielist.php取得資料的ajax函式，會將取得的資料寫入指定的區塊中
function getList(){
    $.get("./admin/orderlist.php",function(res){
        $(".orderlist").html(res)
        

        //刪除按鈕事件註冊
        $(".delBtn").on("click",function(){
        
            //取得資料id資料
            let id=$(this).data("del")
            
            let chk=confirm("是否確定要刪除此筆訂單?")
            if(chk==true){
              //將資料表名及id陣列傳送至api/del.php中進行資料刪除
              $.post("./api/del.php",{"table":"ord",id},function(){
              
                  //資料刪除完畢後，重新載入一次列表
                  getList();
              })
          }
        })        
        
    }) 
}

//快速刪除函式
function qDel(){

  //取得快速刪除的類別(日期/電影)
  let type=$("input[name='type']:checked").val()

  //建立一個空物件來裝載要傳到api的資料
  let data={};

  //利用switch() 來根據不同的刪除類別做不同的事，要用if..else也是可以
  switch(type){
    case "1":

      //建立刪除日期時的物件內容
      data={"date":$("#date").val()};

    break;
    case "2":
      //建立刪除電影時的物件內容
      data={"movie":$("#movie").val()};

    break;
  }

  //建立詢問確認視窗，利用Object.value()來取得物件data的第一個成員的值
  let chk=confirm(`你確定要刪除${Object.values(data)[0]}的全部訂單嗎?`)
  
  //根據確認結果進行刪除或取消的行為
  if(chk==true){

    //將刪除條件的data物件傳至api，完成後重新執行一次getList()  
    $.post("./api/qdel.php",data,function(){
      getList()
    })
  }
}
</script>