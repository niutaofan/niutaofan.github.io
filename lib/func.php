<?php 
/**
* 成功的提示信息
*/
function notFond() {
	require(ROOT . './view/admin/error404.html');
	exit();
}

/*
 *检测用户是否登录 
 * 
 */
   function acc(){
   	return isset($_COOKIE['name']);
   }
 
 
 
 /*
  *分页 
  */
 function getPage($num,$curr,$cnt) {
	//最大的页码数
	$max = ceil($num/$cnt);
	//最左侧页码
	$left = max(1 , $curr-2);

	//最右侧页码
	$right = min($left+4 , $max);

	$left = max(1 , $right-4);

/*	(1 [2] 3 4 5) 6 7 8 9 
	1 2 (3 4 [5] 6 7) 8 9
	1 2 3 4 (5 6 7 [8] 9)*/
	$page = array();
	for($i=$left;$i<=$right;$i++) {
		$_GET['page'] = $i;
 		$page[$i] = http_build_query($_GET);
	}

	return $page;
}

//print_r(getPage(100,5,10));
 
 
 
?>