<?php
	require('/lib/init.php');
	$art_id = $_GET['art_id'];
	
	//判断地址栏传来的art_id 是否合法
	if(!is_numeric($art_id)) {
		header('Location: index.php');
	}
	
	//如果没有这篇文章 跳转到首页去
	$sql = "select * from art where art_id=$art_id";
	if(!mGetRow($sql)) {
		header('Location: index.php');
	}
	//print_r($art);exit();
	//查询文章
	$sql = "select * from art where art_id=$art_id";
	$art = mGetRow($sql);
//	print_r($art);exit();
	
	//查询所有的留言
	$sql = "select * from comment where art_id=$art_id";
	$comms = mGetAll($sql);
//	print_r($comms);exit();
	
	
	//post 非空 代表有留言
	if(!empty($_POST)) {
		$comm['nick'] = htmlspecialchars(trim($_POST['nick']));
		$comm['email'] = htmlspecialchars(trim($_POST['email']));
		$comm['content'] = htmlspecialchars(trim($_POST['content']));
		$comm['pubtime'] = time();
		$comm['art_id'] = $art_id;
		$rs = mExec('comment' , $comm);
		if($rs) {
			//评论发布成功 将art表的comm+1
			$sql = "update art set comm=comm+1 where art_id=$art_id";
			mQuery($sql);
	
			//跳转到上个页面
			$ref = $_SERVER['HTTP_REFERER'];
			header("Location: $ref");
		}
	}

	$sql = "select * from art";
	$allArt = mGetAll($sql);


	include(ROOT.'/view/front/art.html');
	
?>