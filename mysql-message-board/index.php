<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$con = mysqli_connect("localhost","root","root",'db_board') or die('<br/>连接数据库错误!<br/>');

// 增
if(@$_REQUEST['username'] and !isset($_POST['editId'])){
    $username = $_REQUEST['username'];
    $title = $_REQUEST['title'];
    $time = time();
    $content = $_REQUEST['content'];
    @$sql = "INSERT INTO `t_message`( `username`, `title`, `time`, `content`) VALUES ('".$username."','".$title."','".$time."','".$content."')";
    $que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
    if($que){
    	echo "<script>alert('留言添加成功!');location.href='./index.php';</script>";
    }else{
    	echo "<script>alert('留言添加失败!');location.href='./index.php';</script>";
    }
}
// 删
if(isset($_GET['deleteId'])){
	$sql = "DELETE FROM `t_message` WHERE `id`=".$_GET['deleteId'];
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		echo "<script>alert('留言删除成功!');location.href='./index.php';</script>";
	}else{
		echo "<script>alert('留言删除失败!');location.href='./index.php';</script>";
	}
}
// 查
$sql = 'SELECT * FROM `t_message`';
$que = mysqli_query($con,$sql) or die('<br/>选择数据库错误：'.mysqli_error($con).'<br/>');
$msgs = mysqli_fetch_all($que,MYSQLI_ASSOC);
// 改
if(isset($_POST['editId'])){
	$id = $_REQUEST['id'];
	$username = $_REQUEST['username'];
	$title = $_REQUEST['title'];
	$time = time();
	$content = $_REQUEST['content'];
	$sql = "UPDATE `t_message` SET `username`='".$username."',`title`='".$title."',`time`='".$time."',`content`='".$content."' WHERE `id`=".$id;
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		echo "<script>alert('留言修改成功!');location.href='./index.php';</script>";
	}else{
		echo "<script>alert('留言修改失败!');location.href='./index.php';</script>";
	}
}
mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <title>留言板-MySQL存储</title>
    <style>
        body{margin:0;padding:0;font-family:'helvetica neue', tahoma, 'hiragino sans gb', stheiti, 'wenquanyi micro hei', Microsoft YaHei, SimSun, sans-serif;line-height:1;padding:20px 20px 50px;}
        a{font-size:14px;padding:2px 6px;border:solid 1px red;margin:4px;display:inline-block;border-radius:3px;color:purple;text-decoration: none;-webkit-transition:all .6s;transition:all .6s;}
        a:hover{-webkit-transform:scale(1.2);transform:scale(1.2);}
        .tips_bg{position:fixed;top:0;right:0;bottom:0;left:0;background:rgba(0,0,0,.3);z-index:998;-webkit-transform-origin:top;transform-origin:top;-webkit-transition:all .6s;transition:all .6s;-webkit-transform:scaleY(0);transform:scaleY(0);}
        .tips_box{position:fixed;top:50%;left:50%;-webkit-transform:translate(-50%,-150%);transform:translate(-50%,-150%);background:#fff;border:solid 2px red;border-radius:5px;padding:10px 50px;-webkit-box-shadow:0 2px 10px rgba(0,0,0,.4);box-shadow:0 2px 10px rgba(0,0,0,.4);z-index: 999;-webkit-transition:all .6s;transition:all .6s;opacity:0;pointer-events:none;}
        .tips_show .tips_bg{-webkit-transform:scaleY(1);transform:scaleY(1);}
        .tips_show .tips_box{-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);opacity:1;pointer-events:auto;}
        .tips_shut{position:absolute;top:0;right:0;width:40px;height:40px;-webkit-transition:all .6s;transition:all .6s;cursor:pointer;}
        .tips_shut:hover{-webkit-transform:rotate(180deg);transform:rotate(180deg);}
        .tips_shut::before{content:'';height:2px;left:8px;right:8px;background:red;position:absolute;top:50%;margin-top:-1px;border-radius:4px;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);}
        .tips_shut::after{content:'';height:2px;left:8px;right:8px;background:red;position:absolute;top:50%;margin-top:-1px;border-radius:4px;-webkit-transform:rotate(45deg);transform:rotate(45deg);}
        input[type="submit"],input[type="reset"]{cursor:pointer;-webkit-transition:all .6s;transition:all .6s;}
        input[type="submit"]:hover,input[type="reset"]:hover{-webkit-transform:translateY(-6px);transform:translateY(-6px);color:red;}
        label{width:54px;font-size:14px;display:inline-block;}
        input,textarea{resize:none;font-size:14px;}
        .header{overflow:hidden;padding:10px 0 20px;}
        h1{float:left;margin:0;line-height:40px;padding-right:30px;}
        .header_btn{height:40px;line-height:40px;padding:0 12px;float:left;background:purple;color:#fff;border-radius:5px;cursor:pointer;-webkit-transition:all .4s;transition:all .4s;}
        .header_btn:hover{color:red;}
        td{padding:12px;line-height:1.4;text-align: justify;word-break:break-all;}
        td:last-child{text-align:center;}
        td:nth-of-type(1),td:nth-of-type(6){width:8%;text-align:center;}
        td:nth-of-type(2),td:nth-of-type(3),td:nth-of-type(4){width:12%;text-align:center;}
    </style>
</head>
<body>
<div class="header">
	<h1>留言板</h1>
	<div class="header_btn">添加留言</div>
</div>
<?php if(is_array($msgs)&&count($msgs)>0): ?>
<table border="1" cellpadding="0" cellspacing="0" width="100%" bgcolor="#cfe6d0">
	<tr style="background:#ccc;">
	    <td>编号</td>
	    <td>用户名</td>
	    <td>标题</td>
	    <td>时间</td>
	    <td>内容</td>
	    <td>操作</td>
	</tr>
	<?php foreach (array_reverse($msgs) as $key => $value):?>
		<tr>
			<td><?php echo count($msgs)-$key; ?></td>
		    <td><?php echo $value['username']; ?></td>
		    <td><?php echo $value['title']; ?></td>
		    <td><?php echo date("Y-m-d H:i:s",$value['time']); ?></td>
		    <td><?php echo $value['content']; ?></td>
		    <td>
		    	<a href="./index.php?editId=<?php echo count($msgs)-$key; ?>">编辑</a>
		    	<a href="javascript:void(0);" onclick="deleteFn('<?php echo $value['username']; ?>','<?php echo $value['id']; ?>');">删除</a>
		    </td>
		</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>
<!-- 弹框 -->
<?php if(isset($_GET['editId'])): ?>
<div class="tips tips_show">
<?php else: ?>
<div class="tips">
<?php endif; ?>
	<div class="tips_bg"></div>
	<div class="tips_box">
		<div class="tips_shut"></div>
		<form action="./index.php" method="post">
			<?php if(isset($_GET['editId'])): ?>
			<h2 id="#edit">请编辑：</h2>
			<input type="hidden" name="id" value="<?php echo @$msgs[$_GET['editId']-1]['id']; ?>">
			<p>
			    <label for="editId">编号</label>
			    <input type="text" id="editId" name="editId" placeholder="请输入用户名" value="<?php echo @$_GET['editId']; ?>" readonly="readonly">
			</p>
			<?php else: ?>
		    <h2>请留言：</h2>
			<?php endif; ?>
		    <p>
		        <label for="username">用户名</label>
		        <input type="text" id="username" name="username" placeholder="请输入用户名" required="required" value="<?php echo @$msgs[$_GET['editId']-1]['username']; ?>">
		    </p>
		    <p>
		        <label for="title">标题</label>
		        <input type="text" id="title" name="title" placeholder="请输入标题" required="required" value="<?php echo @$msgs[$_GET['editId']-1]['title']; ?>">
		    </p>
		    <p>
		        <label for="content">内容</label>
		        <textarea id="content" name="content" id="" cols="30" rows="10" required="required"><?php echo @$msgs[$_GET['editId']-1]['content']; ?></textarea>
		    </p>
		    <p>
		    	<?php if(isset($_GET['editId'])): ?>
		    	<input type="submit" value="修改留言" name="pubMsg">
		    	<?php else: ?>
		        <input type="submit" value="发布留言" name="pubMsg">
		    	<?php endif; ?>
		        <input type="reset" value="重置">
		    </p>
		</form>
	</div>
</div>
<script>
// 优化编辑
getQueryStringArgs().editId?$('#username').focus():'';
// 添加留言
$('.header_btn').onclick = function(){
	$('.tips').className = 'tips tips_show';
	$('#username').focus();
}
// 关闭留言操作板
$('.tips_shut').onclick = function(){
	$('.tips').className = 'tips';
	setTimeout(function(){
		location.replace('./index.php')
	},600);
}
/**
 * [$ 封装获取选择器]
 * @param  {[type]} ele [选择器名]
 * @return {[type]}     [选择指定DOM]
 */
function $(ele){
	return document.querySelector(ele);
}
/**
 * [deleteFn 删除指定留言板]
 * @param  {[type]} id [留言编号]
 * @return {[type]}    [删除并跳转]
 */
function deleteFn(name,id){
	if(confirm('确定删除['+name+']的用户吗？')){
		location.href = "./index.php?deleteId="+id;
	}else{
		// location.href = "./index.php";
	}
}
/**
 * [getQueryStringArgs 查询字符串转化成对象的属性]
 * @return {[type]} [Object]
 */
function getQueryStringArgs(){
    // 取得查询字符串并去掉开头的问号
    var qs = (location.search.length>0?location.search.substring(1):""),
    // 保存数据的对象
    args = {},
    // 取得每一项
    items = qs.length?qs.split("&"):[],
    item = null,
    name = null,
    value = null,
    // 在for循环中使用
    i = 0,
    len = items.length;
    // 逐个将每一项添加到args对象中
    for(i=0;i<len;i++){
        item = items[i].split("=");
        name = decodeURIComponent(item[0]);
        value = decodeURIComponent(item[1]);
        if(name.length){
            args[name] = value;
        }
    }
    return args;
}
</script>
</body>
</html>