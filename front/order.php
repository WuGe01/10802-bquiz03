<style>

/*設定標題橫條的css內容 */
h3{
    margin:0;
    padding:5px;
    background:#555;
    color:white;
    text-align:center;
    border:1px solid black;
}

table{
    width:50%;
    padding:20px;
    margin:20px auto;
    border:1px solid #ccc;
    background:#eee;
}
table td{
    padding:5px 0;
    text-align:center;
    border:1px solid #999;
}
table tr:nth-child(odd){
    background:#aaa;
}
table tr:nth-child(even){
   
    background:#ccc;
}
table td:nth-child(1){
    width:100px;
}
table td select{
    width:98%;
}
</style>
<h3>線上訂票</h3>
<form action="" method="post">
    <table>
        <tr>
            <td>電影：</td>
            <td><select name="movie" id="movie"></select></td>
        </tr>
        <tr>
            <td>日期：</td>
            <td><select name="date" id="date"></select></td>
        </tr>
        <tr>
            <td>場次：</td>
            <td><select name="session" id="session"></select></td>
        </tr>
        <tr>
            <td colspan="2" class="ct">
                <input type="button" value="確定">
                <input type="reset" value="重置">
            </td>
            
        </tr>
    </table>
</form>

<script>

//註冊電影選單選項改變時的事件
$("#movie").on("change",function(){

  //將電影選單目前選中的電影id傳給getDate()以取得日期選項
  getDate(getForm().id)

})

//註冊日期選單選項改變時的事件
$("#date").on("change",function(){
  
  //將電影id及日期傳給getSession()以取得場次選項
  getSession(getForm().id,getForm().date)

})

//頁面載入後先執行一次getMovie()函式來取得電影選項
//並藉此觸發後續的單連動事件
getMovie()

function getMovie(){
    //利用URL API建立一個網址物件，並將目前的網址傳入
    let url=new URL(location.href)

    //取得網址物件中的參數id的值
    let param=url.searchParams.get("id")

    //先建立一個id變數，值為0
    let id=0;

    //利用jQuery的isEmptyObject()函式來判斷網址中是否有id這個參數，
    //如果網址中有帶id這個參數，則將值指定給id這個變數，否則id維持0
    if(!$.isEmptyObject(param)){
      id=param
    }
    
    //向getmovie.php傳遞id值，並取得目前選單該顯示那些電影的回應
    $("#movie").load("./api/getmovie.php",{id},function(){

     //建立完電影表單選項後，判斷id值是否為0，如果為0
      //則將選單第一部電影的值設為id值，如果不為0
      //則維持原本的id值並傳向下一個選單
      if(id==0){
        id=$("#movie").val();
      }

      //呼叫getDate函式並傳入電影id值，藉此取得電影的可訂票日期
      getDate(id)

    })
}

//取得日期選項的函式
function getDate(id){

  //將電影id傳給getdate.php去計算該電影尚有幾天可以訂票
  $("#date").load("./api/getdate.php",{id},function(){

    //建立完日期選項後,我們要取得第一個選項的日期並
    //並將電影id及日期傳給下一個選單
    let date=$("#date").val();
    getSession(id,date)
  })
}

//取得場次選項的函式
function getSession(id,date){

  //將電影id及想要訂票的日期傳給getsession.php去計算有那些場次可以訂
  $("#session").load("./api/getsession.php",{id,date})
}

//建立一個函式用來取得三個選單的值
//以物件的方式來回傳的優點是可以在執行函式馬上取值
function getForm(){
  let id=$("#movie").val()
  let date=$("#date").val()
  let session=$("#session").val()

  //以js物件的格式來包裝三個選單的值，方便取用
  return {"id":id,"date":date,"session":session}
}

</script>