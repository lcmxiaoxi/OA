<?php
namespace Home\Controller;
use Think\Controller;
class SCController extends Controller{
	public function set_s(){
		session('id',10001);
		session('name','zs');
	}
	public function get_s(){
		echo session('id');
		$info=session();
		dump($info);
	}
	public function del_s(){
		session('id',null);
		session(null);
	}
	public function isset_s(){
		echo (int)session('?name');
	}
	public function set_c(){
		cookie('color','red');
		cookie('size','20',3600);
		cookie('width',800,array('expire'=>3600,'prefix'=>'think_'));
	}
	public function get_c(){
		echo cookie('color');
		//echo cookie('size');
		//echo cookie('think_width');
		//$c=cookie();
		//dump($c);
	}
	public function del_c(){
		cookie('color',null);
		//cookie(null);//删除全部cookie,但是不能正常执行
		//cookie(null,'think_');
	}

}
?>