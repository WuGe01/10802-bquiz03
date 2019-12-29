<style>
/*設定.list及 .add樣式共同的內容 */
.list, .add{
width:98%;
border:2px solid #ccc;
padding:5px;
background:#999;
}

/*單獨設定.list的高度 */
.list{
    height:300px;
}

/*單獨設定.add的高度 */
.add{
    height:150px;
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

/*設定.header , .row 共同的css內容 */
.header,.row{
    list-style-type:none;
    width:100%;
    color:black;
    display:flex;
    margin:0;
    padding:0;
    text-align:center;
    align-items:center;
}
/*設定.header , .row 中子元素li的css內容 */
.header li , .row li{
    width:24.5%;
    margin:0.25%;
    background:#ccc;
}

/*設定.row及子元素的的背景色 */
.row, .row li{
    background:white;
}

/*設定列表區塊為固定高度並且自動出現滾動軸 */
.items{
    height:190px;
    overflow:auto;
}
</style>
<!--預告片海報管理區段-->
<div class="list">
<h3>預告片清單</h3>
<ul class="header">
    <li>預告片海報</li>
    <li>預告片片名</li>
    <li>預告片排序</li>
    <li>操作</li>
</ul>
<form action="./api/editposter.php" method="post" >
    <div class="items">
        <!--這邊用來放置ajax函式取得的海報列表內容-->
    </div>
   <div class="ct"> <input type="submit" value="編輯確定"><input type="reset" value="重置"></div>
</form>
</div>
<hr>
<!--新增預告片海報區段-->
<div class="add">
<h3>新增預告片海報</h3>
<form action="./api/addposter.php" method="post" enctype="multipart/form-data">
    <table class='ct'>
        <tr>
            <td>預告片海報：<input type="file" name="poster" id="poster"></td>
            <td>預告片片名：<input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="新增"><input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
</div>

<script>

//在頁面載入完成後先執行一次getList()函式，用來取得預告片海報的列表內容
getList();


//用來向posterlist.php取得資料的ajax函式，會將取得的資料寫入指定的區塊中
function getList(){
    $.get("./admin/posterlist.php",function(res){
        $(".items").html(res)
    })
}

</script>