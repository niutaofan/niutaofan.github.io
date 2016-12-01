<?php
	require('./lib/init.php');
	
	$art_id = $_GET['art_id'];
	
	//判断地址栏传来的art_id是否合法
	if(!is_numeric($art_id)) {
		notFond();
	}
	
	//是否有这篇文章
	$sql = "select * from art where art_id=$art_id";
	if(!mGetRow($sql)) {
		notFond();
	}
	
	//删除文章
	$sql = "delete from art where art_id=$art_id";
	if(!mQuery($sql)) {
		notFond();
	} else {
		//succ('文章删除成功');
		header('Location: artlist.php');
	}

?>