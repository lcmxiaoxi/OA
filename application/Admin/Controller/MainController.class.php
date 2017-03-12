<?php
namespace Admin\Controller;
use Think\Controller;//use Think\Controlller其实就是引用了thinkphp引擎文件夹里think目录下的Controller.class.php
class MainController extends CommonController{
	public function index(){
		//1.实例化Email模型
		$email=D('Email');
		//2.根据当前用户id统计未读邮件数量
		$id=session('uid');
		$count=$email->where("email_to='$id' and email_read=1")->count();
		$this->assign('count',$count);
		$this->display();
	}
	public function home(){
		$this->display();
	}
	public function getEmail(){
		//1.实例化Email模型
		$email=D('Email');
		//2.根据当前用户id统计未读邮件数量
		$id=session('uid');
		$count=$email->where("email_to=$id and email_read=1")->count();
		echo $count;
	}
}
?>