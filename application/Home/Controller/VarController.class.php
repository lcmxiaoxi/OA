<?php
namespace Home\Controller;
use Think\Controller;
class VarController extends Controller{
	public function index(){
		$str='abcdefg';
		$this->assign('str',$str);
		$this->display();
	}
}

?>