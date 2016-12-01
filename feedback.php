<?php
	require('/lib/init.php');
	
	//post 非空 代表有留言
	if(!empty($_POST)) {
		$adv['contact'] = trim($_POST['contact']);
		$adv['content'] = htmlspecialchars(trim($_POST['content']));
		$adv['pubtime'] = time();
		$rs = mExec('advise' , $adv);
		if($rs) {
			//跳转到上个页面
			//$ref = $_SERVER['HTTP_REFERER'];
			//header("Location: $ref");
			header('Location:info.php');
		}
	}
	
	include(ROOT.'/view/front/feedback.html');
	
?>