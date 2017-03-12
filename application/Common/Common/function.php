<?php
function abc(){
	echo "在Common目录下的function.php文件中的自定义函数";
}
function getDeptTree($arr,$pid=0){
	static $result=array();
	foreach($arr as $value){
		if($value['dept_pid']==$pid){
			$result[]=$value;
			getDeptTree($arr,$value['dept_id']);
		}
	}
	return $result;
}
// 获取当前时间 年-月-日
function getNowDate(){
	return date('Y-m-d');
}

function checkName($name){
	$user=D('User');
	//根据用户名从User表中查询数据
	$data=$user->field('user_name')->where("user_name='$name'")->find();
	//判断查询结果中的user_name的值是否和$name一致
	if($data['user_name']==$name){
		return false;//如果一致说明重复,返回false,不可用
	}
	return true;
}

function passwd2md5($passwd){
	return md5($passwd);
}

function getNowDateTime(){
	return date('Y-m-d H:i:s');
}

function getUid(){
	return session('uid');
}
function getUname(){
	return session('uname');
}


?>