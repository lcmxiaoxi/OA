<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
	public function editor(){
		$this->display();
	}
	public function index(){
        //echo get_client_ip();
        /*echo MODULE_NAME ."<br>" ;
        echo CONTROLLER_NAME.'<br>';
        echo ACTION_NAME;*/
        $this->display();
    }
}
?>