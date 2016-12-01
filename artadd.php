<?php
	
	require('./lib/init.php');
	
	if(!acc()){
		header('Location:login.php');
	}
	
	$sql = 'select * from art';
	$arts = mGetAll($sql);
	//print_r($arts);
	
	
	if(empty($_POST)){
		include(ROOT.'/view/admin/artadd.html');
	}else{
		//插入内容到art表
		$art['pubtime'] = time();
		$art['content'] = trim($_POST['content']);
		$art['title'] = trim($_POST['title']);
		if(mExec('art',$art)){
			header('Location: artlist.php');
		}else{
			echo mysql_error();
		}
	}
?>