<?php
	require('./lib/init.php');
//	验证用户是否有权限登录
	if(!acc()){
		header('Location:login.php');
	}
	$sql = "select * from art";
	$arts = mGetAll($sql);
	
	
	//分页代码
	$sql = "select count(*) from art ";//获取总的文章数
	$num = mGetOne($sql);//总的文章数
	//getPage()
	$curr = isset($_GET['page']) ? $_GET['page'] : 1;//当前页码数
	$cnt = 12;//每页显示条数
	$page = getPage($num , $curr, $cnt);
	//print_r($page);

	//查询所有的文章
	$sql = "select * from art where 1" . ' order by art_id desc limit ' . ($curr-1)*$cnt . ',' . $cnt;
	//echo $sql;exit();
	$arts = mGetAll($sql);

	include(ROOT . '/view/admin/artlist.html');
	
?>