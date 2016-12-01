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
		
	if(empty($_POST)) {
		$sql = "select * from art where art_id=$art_id";
		$art = mGetRow($sql);
		include(ROOT . '/view/admin/artedit.html');
	} else {
	//检测标题是否为空
	$art['title'] = trim($_POST['title']);
	if($art['title'] == '') {
		notFond();
	}

	//检测内容是否为空
	$art['content'] = trim($_POST['content']);
	if($art['content'] == '') {
		notFond();
	}

	if(!mExec('art' , $art ,'update' , "art_id=$art_id")) {
		notFond();
	} else {
		header('Location: artlist.php');
	}
}
?>