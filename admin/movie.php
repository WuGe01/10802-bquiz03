<style>
.movielist{
    width:100%;
    height:400px;
    overflow:auto;
}
</style>
<button onclick="javascript:location.href='admin.php?do=addmovie'">新增電影</button>
<hr>
<div class="movielist">



</div>

<script>

//在頁面載入完成後先執行一次getList()函式，用來取得預告片海報的列表內容
getList();

//用來向movielist.php取得資料的ajax函式，會將取得的資料寫入指定的區塊中
function getList(){
    $.get("./admin/movielist.php",function(res){
        $(".movielist").html(res)
        
        //按鈕事件註冊
        $(".shiftBtn").on("click",function(){

            //取得id的內容，並使用split函式將原本的"1-2","3-4"字串分解成[1,2],[3,4]的陣列形式
            let id=$(this).attr("id").split("-")
            
            //將資料表名及id陣列傳送至api/switch.php中進行資料交換
            $.post("./api/switch.php",{"table":"movie",id},function(){
               
                //資料交換完畢後，重新載入一次列表
                getList();
            })
        })    
    }) 
}
</script>