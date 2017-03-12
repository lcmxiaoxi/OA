<?php
//1.声明命名空间
namespace Admin\Controller;
//2.引入控制器基类
use Think\Controller;
use Think\Verify;
//3.编写控制器类,继承控制器基类
class IndexController extends Controller {
    public function login(){
    	//phpinfo();die;
       $this->display();
    }
    
    public function verify(){
    	//定义验证码配置项
    	$config=array(
    		'bg'=>array(93,202,27),//背景颜色
    		'useCurve'  =>  false,  // 是否画混淆曲线
        	'useNoise'  =>  false,  // 是否添加杂点
        	'imageH'    =>  40,     // 验证码图片高度
            'imageW'    =>  75,     // 验证码图片宽度
            'fontSize'  =>  15,     // 验证码字体大小(px)
            'fontttf'   =>  '4.ttf',     // 验证码字体，不设置随机获取
             'length'    =>  4,          // 验证码位数
    		);
    	//1.实例化验证码类
    	$v=new Verify($config);
    	//2.调用entry方法
    	$v->login();//login是自定义绘制图片方法。就是复制entry方法,进行修改。
    }
    public function checkLogin(){
    	//1.接受表单提交的验证码
    	$code=I('post.code');
    	//2.实例化验证码类
    	$v=new Verify();
    	//参数:用户输入的验证码
    	if(!$v->check($code)){
    		$this->error('验证码错误',U('login'),3);
    	}
    	//echo '成功';
    	//3.接受用户名和密码
    	$name=I('post.name');
    	$passwd=I('post.passwd');

    	$user=D('User');
    	// 调用UserModel中自定义的checkLogin方法来检测用户名和密码的正确性
    	if($user->checkLogin($name, $passwd)){
            $this->success('登录成功', U('Main/index'), 3);
        } else {
            $this->error('用户名或密码错误', U('login'),3);
        }
    }
    
}