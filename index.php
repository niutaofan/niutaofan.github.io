<?php
	require('./lib/init.php');

//	//查询所有的
//	$sql = "select * from art";
//	$arts = mGetAll($sql);

	//分页代码
	$sql = "select count(*) from art ";//获取总的文章数
	$num = mGetOne($sql);//总的文章数
	//getPage()
	$curr = isset($_GET['page']) ? $_GET['page'] : 1;//当前页码数
	$cnt = 3;//每页显示条数
	$page = getPage($num , $curr, $cnt);
	//print_r($page);

	//查询所有的文章
	$sql = "select * from art where 1" . ' order by art_id desc limit ' . ($curr-1)*$cnt . ',' . $cnt;
	//echo $sql;exit();
	$arts = mGetAll($sql);
	
	$sql = "select * from art";
	$allArt = mGetAll($sql);
	
//	print_r($arts);exit();

	//如果当前栏目下没有文章,跳转到首页去

	require(ROOT . '/view/front/index.html');
?>