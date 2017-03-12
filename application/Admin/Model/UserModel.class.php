<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{
	//批处理字段验证
	protected $patchValidate=true;
	//1.定义主键
	protected $pk='user_id';
	//2.定义字段
	protected $fields=array(
		'user_id','user_name','user_nickname','user_password',
		'user_dept','user_sex','user_birthday','user_tel','user_email','user_ctime'
		);
	//3.字段映射
	protected $_map=array(
		'name'      =>  'user_name',
		'nickname'  =>  'user_nickname',
		'password'  =>  'user_password',
		'dept'      =>  'user_dept',
		'sex'       =>  'user_sex',
		'birthday'  =>  'user_birthday',
		'tel'       =>  'user_tel',
		'email'     =>  'user_email'

		);
	//4.字段验证
	protected $_validate=array(
		array('user_name','username','用户名必须为4-12位字母数字下划线组合',1,'regex',3),
		array('user_name','checkName','用户名已存在请重新填写',1,'function',3),
		array('user_password','username','密码必须为4-12位字母数字下划线组合',0,'regex',3),
		array('re-password','user_password','两次密码不一样',0,'confirm',3),
		array('user_tel','tel','手机格式不正确',1,'regex',3),
		);
	//5.自动完成
	protected $_auto=array(
		array('user_password','passwd2md5',3,'function'),
		array('user_ctime','getNowDateTime',3,'function'),
		);
	//定义登录验证方法
	public function checkLogin($name,$passwd){
		//1.根据用户名查询数据库
		$data = $this->where("user_name='$name'")->find();
		//2.判断$data是否为空
		if(empty($data)){
			return false;
		}
		if($data['user_name']==$name && $data['user_password']==md5($passwd)){
			//保存用户信息到session
			session('uid',$data['user_id']);
			session('uname',$data['user_name']);
			session('unickname',$data['user_nickname']);
			session('udept',$data['user_dept']);
			return true;
		}else{
			return false;
		}
	}
}
?>