<?php
	/*
	 *mysql.php mysql系列操作函数
	 *  
	 */	
	 
	 /*
	  *连接数据库 
	  */
	  
	 error_reporting(E_ALL ^ E_DEPRECATED);//提高报错级别
	 
	function mConn() {
		static $conn = null;
		if($conn === null) {
			$cfg = require(ROOT.'/lib/config.php');
			$conn = mysql_connect($cfg['host'] , $cfg['user'] , $cfg['pwd']);
			mysql_query('use '.$cfg['db'] , $conn);
			mysql_query('set names '.$cfg['charset'] , $conn);
		}
	
		return $conn;
	}
	 
	 /*
	  * 查询的函数
	  * return mixed resoure/bool
	  * 
	  */
	 function mQuery($sql){
	 	
	 	$rs =  mysql_query($sql,mConn());
		if($rs){
			mLog($sql);
		}else{
			mLog($sql."\n".mysql_error());
		}
		return $rs;
	 }
	 
	 
	 /*
	  * log日志记录功能 
	  * @param str $str 待记录的字符串
	  */
	 function mLog($str){
	 	$filename = ROOT.'/log/'.date('Ymd').'txt';
		$log = "------------------------------------\n".date('Y/m/d H:i:s')."\n".$str."\n"."------------------------------------\n\n";
	 	return file_put_contents($filename, $log,FILE_APPEND);
	 }
	 
	 
	 /*
	  *select 查询多行数据
	  *@param str $sql select 待查询的sql语句
	  *@return mixed select 查询成功,返回二维数组,失败返回false
	  */
	 
	 function mGetAll($sql){
	 	$rs = mQuery($sql);
		if(!$rs){
			return FALSE;
		}
		$data = array();
		while($row = mysql_fetch_assoc($rs)){
			$data[] = $row;
		}
		return $data;
	 }
	 
	/*
	 * select 取出一行数据
	 * @param str $sql 待查询的sql语句
	 * @return arr/false 查询成功返回一维数组
	 */
	 
	function mGetRow($sql) {
		$rs = mQuery($sql);
		if(!$rs) {
			return false;
		}
	
		return mysql_fetch_assoc($rs);
	}
	
	/*
	 * select 查询返回一个结果
	 * @param str $sql 待查询的select 语句
	 * @return mixe 成功,返回结果,失败返回false
	*/
	
	function mGetOne($sql){
		$rs = mQuery($sql);
		if(!$rs){
			return FALSE;
		}
		return mysql_fetch_row($rs)[0];
	}
	 
//	 $sql = "select count(*) from art where art_id=1";
//	 print_r(mGetOne($sql)) ;

	//insert into art (art_id,title) values (5,'test')
	/*
	 *自动拼接 insert 和update sql语句,并且 调用mQuery() 去执行sql 
	 * @param str $table 表名
	 * @param arr $data 接收的数据是一维数组
	 * @param str $act 动作 默认为"insert"
	 * @param str $where 防止update更改时少加条件
	 * @return bool insert 或者 update 插入成功或失败
	 */
	 
	 function mExec($table,$data ,$act = 'insert',$where = 0){
	 	if($act == 'insert'){
	 		$sql = "insert into $table(";
			$sql .=implode(',',array_keys($data)).") values ('";
			$sql.= implode("','", array_values($data))."')";
			return mQuery($sql);
	 	}else if($act=='update'){
	 		$sql = "update $table set ";
			foreach($data as $k=>$v){
				$sql.=$k."='".$v."',";
			}
			
			$sql = rtrim($sql,',')."where ".$where;
			return mQuery($sql);
	 	}
	 }
//	 $data = array('title'=>'今天的天气','content'=>'空气质量优');
//	 echo mExec('art', $data ,'update');

	/*
	 * 取得上一步insert 操作产生的主键的id
	 */
	 function getLastId(){
	 	return mysql_insert_id(mConn());
	 }
	 
	/*
	 * 使用反斜线 转义字符串 
	 *@param arr 待转义的数组
	 *@return arr 被转义后的数组 
	 */
	 
	 function _addslashes($arr) {
		foreach($arr as $k=>$v) {
			if(is_string($v)) {
				$arr[$k] = addslashes($v);
			}else if(is_array($v)) {
				$arr[$k] = _addslashes($v);
			}
		}
	
		return $arr;
	}
	 
?>