<?php 
	//content-type:text/html;charset=utf8
	header('content-type:text/html;charset=utf8');
	//连接数据库
	include_once('public/connectDb.php');
	//获取用户信息
	$username = $_POST['username'];
	$password = $_POST['password'];
	$admins = array();
	$sql = "select * from admins where adminName = '$username' and adminPassword = '$password'";
	if (!mysql_query($sql,$con)){
		die('Error: ' . mysql_error());
	}
	$res = mysql_query($sql);
	while ( $row = mysql_fetch_row($res)) {
		$admin['username'] = $row[1];
		$admin['password'] = $row[2];
		$admins[] = $admin;
	}
	if(count($admins) > 0){
		//记录大于零，就是有记录
		$result['state'] = 'success';
		mysql_close($con);
		die(json_encode($result));
	}else{
		$result['state'] = 'fail';
		mysql_close($con);
		die(json_encode($result));
	}
?>