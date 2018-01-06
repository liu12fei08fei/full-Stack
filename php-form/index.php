<?php
// php输入操作符 echo() var_dump()-打印变量的相关信息 print_r()-打印关于变量的易于理解的信息
// die()-等同于 exit()-输出一个消息并且退出当前脚本

// 报错：Unknown column 'xxx' in 'field list' => 是因为拼接字符串的时候，写成".$newstitle." => 正确写法为'".$newstitle."'
// 原因：不适用引号括起来，就把要传递的值当成了整型，而不是字符串；所以出现了，传递整型可以操作，传递字符串不行的现象

// 如果地址栏，要使用type="file"，需要设置form属性：enctype="multipart/form-data"

// 目的：防止页面出现乱码
header("Content-type:text/html;charset=utf-8");
// header("Content-type:application/json;charset=utf-8");

// 接收前端传递过来的数据
if(@$_REQUEST['newstitle']){
    $newstitle = $_REQUEST['newstitle'];
    $newsimg = $_REQUEST['newsimg'];
    $newscontent = $_REQUEST['newscontent'];
    $addtime = $_REQUEST['addtime'];
}

// 连接数据库，localhost、root、root参数改成自己的
$con = mysqli_connect("localhost","root","root");
// var_dump($con);
if($con){
    echo '<br/>'.'连接数据库成功!'.'<br/>';

    // 进行选择数据库，yiding数据库名改成自己的
    $sdb = mysqli_select_db($con,'yiding');

    if($sdb){
        echo '<br/>'.'选择数据库成功'.'<br/>';

        // MySQL语句-增
        // $newstitle = '侃大山3';
        // $newsimg = "我是img";
        // $newscontent = "我要说点事";
        // $addtime = "2018-08-08";
        // 拼接字符串，news表名改成自己的
        @$sql = "INSERT INTO `news`( `newstitle`, `newsimg`, `newscontent`, `addtime`) VALUES ('".$newstitle."','".$newsimg."','".$newscontent."','".$addtime."')";

        // 不拼接字符串
        // $sql = "INSERT INTO `news`( `newstitle`, `newsimg`, `newscontent`, `addtime`) VALUES ('上了飞机','我发了img','falds','2017-08-08')";

        // MySQL语句-删
        // $sql = "DELETE FROM `news` WHERE `newsid`=7";
        // $sql = "DELETE FROM `news` WHERE `newstitle`='你好title'";

        // MySQL语句-改
        // $sql = "UPDATE `news` SET `newstitle`='你好啦啦啦11' WHERE `newsid`=3";

        // 操作数据库
        $que = mysqli_query($con,$sql);
        if($que){
            echo '<br/>'.'操作表成功!'.'<br/>';
        }else{
            die('<br/>'.'操作表错误：'.mysqli_error($con).'<br/>');
        }
    }else{
        die('<br/>'.'选择数据库错误：'.mysqli_error($con).'<br/>');
    }
}else{
    die('<br/>'.'连接数据库错误：'.mysqli_error($con).'<br/>');
}
// 关闭数据库连接
mysqli_close($con);
?>