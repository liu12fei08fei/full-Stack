<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$con = mysqli_connect("localhost","root","root",'db_board') or die('<br/>连接数据库错误!<br/>');
$type = $_REQUEST['type'];
// 查
if($type==='list'){
	// 查
	$sql = 'SELECT * FROM `t_message`';
	$que = mysqli_query($con,$sql) or die('<br/>选择数据库错误：'.mysqli_error($con).'<br/>');
	$msgs = mysqli_fetch_all($que,MYSQLI_ASSOC);
	echo json_encode(array_reverse($msgs));
}
// 增
if($type==='add'){
	$username = $_REQUEST['username'];
	$title = $_REQUEST['title'];
	$time = time();
	$content = $_REQUEST['content'];
	@$sql = "INSERT INTO `t_message`( `username`, `title`, `time`, `content`) VALUES ('".$username."','".$title."','".$time."','".$content."')";
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		echo 'true';
	}else{
		echo 'false';
	}
}
// 改
if($type==='edit'){
	$id = $_REQUEST['id'];
	$username = $_REQUEST['username'];
	$title = $_REQUEST['title'];
	$time = time();
	$content = $_REQUEST['content'];
	$sql = "UPDATE `t_message` SET `username`='".$username."',`title`='".$title."',`time`='".$time."',`content`='".$content."' WHERE `id`=".$id;
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		echo 'true';
	}else{
		echo 'false';
	}
}
// 删
if($type==='delete'){
	$sql = "DELETE FROM `t_message` WHERE `id`=".$_POST['id'];
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		echo 'true';
	}else{
		echo 'false';
	}
}
mysqli_close($con);
?>