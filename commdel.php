<?php
	require('./lib/init.php');
	
	$comment_id = $_GET['comment_id'];
	
	//判断地址栏传来的comment_id是否合法
	if(!is_numeric($comment_id)) {
		notFond();
	}
	
	//是否有这条评论
	$sql = "select * from comment where comment_id=$comment_id";
	$comment = mGetRow($sql);

	if(!$comment) {
		notFond();
	}
	//	print_r($comment);exit();
	//删除评论
	$sql = "delete from comment where comment_id=$comment_id";
	if(!mQuery($sql)) {
		notFond();
	} else {
		//succ('文章删除成功');
		header('Location: commlist.php');
	}

?>