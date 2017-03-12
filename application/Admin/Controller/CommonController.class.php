<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller{
	  
      
        
	public function _initialize(){
		 // 获取当前的session_name
        $name = session_name();
        // 根据session_name从post表单提交数据中获取对应的session_id
        $id = I('post.'.$name);
        if(!empty($id)){
            session_id($id);
            // 停止已运行的session
            session('[pause]');
            // 开启session
            session_start();
        }
        //fwrite($fp, 111);
		if(!session('?uid')){
			// fwrite($fp, 222);
			$this->error('您尚未登录,请先登录',U('Index/login'),3);
		}
	}
}
?>