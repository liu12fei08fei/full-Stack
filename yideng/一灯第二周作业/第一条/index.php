<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$con = mysqli_connect("localhost","root","root",'db_yideng') or die('<br/>连接数据库错误!<br/>');
$operation = $_REQUEST['operation'];
if($operation=='request'){
	// 获取
	$sql = 'SELECT * FROM `t_praise`';
	$que = mysqli_query($con,$sql) or die('<br/>选择数据库错误：'.mysqli_error($con).'<br/>');
	$msgs = mysqli_fetch_all($que,MYSQLI_ASSOC);
	echo json_encode(array_reverse($msgs));
}
if($operation=='add'){
	// 改
	$num = $_REQUEST['num'];
	$sql = "UPDATE `t_praise` SET `num`='".($num+1)."' WHERE `id`=1";
	$que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
	if($que){
		// 查
		$sql = 'SELECT * FROM `t_praise`';
		$que = mysqli_query($con,$sql) or die('<br/>选择数据库错误：'.mysqli_error($con).'<br/>');
		$msgs = mysqli_fetch_all($que,MYSQLI_ASSOC);
		echo json_encode(array_reverse($msgs));
	}else{
		echo '失败';
	}
}
// 增
// @$sql = "INSERT INTO `t_praise`( `num`) VALUES ('".$num."')";
// $que = mysqli_query($con,$sql) or die('<br/>数据库错误：'.mysqli_error($con).'<br/>');
// if($que){
// 	echo 'true';
// }else{
// 	echo 'false';
// }
// 改
mysqli_close($con);
?>