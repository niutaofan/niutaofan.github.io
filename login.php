<?php
	require('./lib/init.php');
	if(empty($_POST)) {
		require(ROOT . '/view/front/login.html');
	} else {
		$user['name'] = trim($_POST['name']);
		$user['password'] = trim($_POST['password']);	
		$sql = "select * from user where name='$user[name]' and password='$user[password]'";
		$row = mGetRow($sql);
		if(!$row) {
			//用户名或者密码错误
			$ref = $_SERVER['HTTP_REFERER'];
			header("Location: $ref");
		} else{
			setcookie('name',$user['name']);
			header('Location:artlist.php');
		}
	}
?>