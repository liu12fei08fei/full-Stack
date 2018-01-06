<?php
// 设置头信息
header("Content-type:text/html;charset=utf-8");
// 1.连接数据库 + 2.选择数据库
$con = mysqli_connect("localhost","root","root",'yiding') or die('<br/>连接数据库错误!<br/>');

// 添加信息的MySQL语句-增
$newstitle = '新闻头部信息-4';
$newsimg = "http://p1g0rvvn6.bkt.clouddn.com/width.jpg";
$newscontent = "新闻具体内容，扒一扒后台，八卦新闻";
$addtime = "2018-08-08";
// @$sql = "INSERT INTO `news`( `newstitle`, `newsimg`, `newscontent`, `addtime`) VALUES ('".$newstitle."','".$newsimg."','".$newscontent."','".$addtime."')";

// MySQL语句-删
// $sql = "DELETE FROM `news` WHERE `newsid`=63";

// MySQL语句-改
// $sql = "UPDATE `news` SET `newstitle`='神器的世界' WHERE `newsid`=3";

// 查找news中所有数据的MySQL语句-查
// $sql = 'SELECT * FROM `news`';

// 设置编码信息
mysqli_query($con,'set names utf8');

// 3.操作数据库
$que = mysqli_query($con,$sql) or die('<br/>选择数据库错误：'.mysqli_error($con).'<br/>');
// 4.返回的结果资源应该传递给mysql_fetch_array，参数MYSQLI_ASSOC把返回的数据从数组的形式转换成对象的形式
$rtn = mysqli_fetch_all($que,MYSQLI_ASSOC);
print_r($rtn);
echo '成功';
// 关闭数据库连接
mysqli_close($con);
?>