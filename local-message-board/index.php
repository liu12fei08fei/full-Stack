<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
// file_get_contents(filename):得到文件中的内容，返回的是字符串
// file_put_contents(filename, data):向指定文件写内容，如果文件不存在会创建
// serialize(value):序列号字符串
// unserialize(str):反序列号
$filename = 'message.txt';
$msgs = [];
// 检测文件是否存在
if(file_exists($filename)){
	// 读取文件中的内容
	$str = file_get_contents($filename);
	// 判断文件中是否有内容
	if(strlen($str)>0){
		$msgs = unserialize($str);
	}
}

// 检测用户是否点击了提交按钮
// trip_tags — 从字符串中去除 HTML 和 PHP 标记
// time — 返回当前的 Unix 时间戳
if(isset($_POST['pubMsg'])){
	$username = $_POST['username'];
	$title = strip_tags($_POST['title']);
	$content = strip_tags($_POST['content']);
	$time = time();
	// 将其组成关联数组
	$data = compact('username','title','content','time');
	// 判断是否为编辑模式
	if(isset($_POST['editId'])){
		$msgs[$_POST['editId']-1] = $data;
		$msgs = serialize($msgs);
		if(file_put_contents($filename, $msgs)){
			echo "<script>alert('留言编辑成功!');location.href='./index.php';</script>";
		}else{
			echo "<script>alert('留言编辑失败!');location.href='./index.php';</script>";
		}
	}else{
		array_push($msgs, $data);
		$msgs = serialize($msgs);
		if(file_put_contents($filename, $msgs)){
			echo "<script>alert('留言添加成功!');location.href='./index.php';</script>";
		}else{
			echo "<script>alert('留言添加失败!');location.href='./index.php';</script>";
		}
	}
}

// 删除留言板
if(isset($_GET['deleteId'])){
	$idx = $_GET['deleteId']-1;
	unset($msgs[$idx]);
	$msgs = serialize(array_values($msgs));
	if(file_put_contents($filename, $msgs)){
		echo "<script>alert('留言删除成功!');location.href='./index.php';</script>";
	}else{
		echo "<script>alert('留言删除失败!');location.href='./index.php';</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <title>留言板-本地存储</title>
    <style>
        body{margin:0;padding:0;font-family:'helvetica neue', tahoma, 'hiragino sans gb', stheiti, 'wenquanyi micro hei', Microsoft YaHei, SimSun, sans-serif;line-height:1;padding:20px 20px 50px;}
        a{font-size:14px;padding:2px 6px;border:solid 1px red;margin:4px;display:inline-block;border-radius:3px;color:purple;text-decoration: none;-webkit-transition:all .6s;transition:all .6s;}
        a:hover{-webkit-transform:scale(1.2);transform:scale(1.2);}
        .tips{}
        .tips_show{}
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
        td{padding:12px;}
        td:last-child{text-align:center;}
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
	<?php foreach ($msgs as $key => $value):?>
		<tr>
			<td><?php echo $key+1; ?></td>
		    <td><?php echo $value['username']; ?></td>
		    <td><?php echo $value['title']; ?></td>
		    <td><?php echo date("Y-d-m H:i:s",$value['time']); ?></td>
		    <td><?php echo $value['content']; ?></td>
		    <td>
		    	<a href="./index.php?editId=<?php echo $key+1; ?>#edit">编辑</a>
		    	<a href="javascript:void(0);" onclick="deleteFn(<?php echo $key+1; ?>);">删除</a>
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
			<p>
			    <label for="editId">编号</label>
			    <input type="text" id="editId" name="editId" placeholder="请输入用户名" value="<?php echo @$_GET['editId']; ?>" disabled="disabled">
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
function deleteFn(id){
	if(confirm('确定删除[编号'+id+']的用户吗？')){
		location.href = "./index.php?deleteId="+id;
	}else{
		// location.href = "./index.php";
	}
}
var tips = document.querySelector('.tips');
var tipsShut = document.querySelector('.tips_shut');
var headerBtn = document.querySelector('.header_btn');
var username = document.querySelector('#username');
headerBtn.onclick = function(){
	tips.className = 'tips tips_show';
	username.focus();
}
tipsShut.onclick = function(){
	tips.className = 'tips';
	setTimeout(function(){
		location.replace('./index.php')
	},600);
}
</script>
</body>
</html>