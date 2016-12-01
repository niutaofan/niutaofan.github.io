<?php
	require('./lib/init.php');
	
	if(!acc()){
		header('Location:login.php');
	}
	$sql = "select * from advise";
	$advs = mGetAll($sql);
	
	//print_r($comms);
	
	//分页代码
	$sql = "select count(*) from art ";//获取总的文章数
	$num = mGetOne($sql);//总的文章数
	//getPage()
	$curr = isset($_GET['page']) ? $_GET['page'] : 1;//当前页码数
	$cnt = 12;//每页显示条数
	$page = getPage($num , $curr, $cnt);
	//print_r($page);
	
	require(ROOT . '/view/admin/advise.html');
?>