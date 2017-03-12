<?php
namespace Admin\Controller;
use Think\Upload;
class EmailController extends CommonController{
	public function index(){
		//1.实例化Email模型
		$email=D('Email');
		$id=session('uid');
		//2.调用select方法进行查询
		$email_list=$email->alias('e')
		        ->field('email_id,email_title,email_file,user_nickname,email_read,email_ctime')
		        ->join('oa_user as u on e.email_from=u.user_id')
		        ->where("email_to='$id'")
		        ->select();
		$this->assign('email_list',$email_list);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function getNames(){
		//1.接收前台提交数据
		$name=I('post.name');
		//2.实例化User模型
		$user=D('User');
		//3.根据关键词进行模糊查询
		$user_list=$user->field('user_nickname')->where("user_nickname like '%$name%'")->select();
		//4.返回查询结果
		echo json_encode($user_list);
	}
	public function addOk(){
		//1.定义上传配置项
		$config=array(
			'maxSize'=>3000000,
			'exts'=>C('UPLOAD_EXTS'),
			'rootPath'=>'./Email/',
			);
		//2.实例化文件上传类
		$upload=new Upload($config);
		//3.调用upload方法进行文件上传
		$info=$upload->upload();
		if(!$info){
			echo $upload->getError();
		}
		//4.实例化Email模型,调用create方法,接受表单数据
		$email=D('Email');
		$data=$email->create('',1);
		$email_to=$data['email_to'];
		$user=D('User');
		$user_info=$user->field('user_id')->where("user_nickname = '$email_to'")->select();
		$email_to=$user_info[0]['user_id'];
		$data['email_to']=$email_to;
	
		//5.调用add方法将数据插入数据表
		//判断如果有上传的文件,将上传后的路径加入到$data中
		if($info){
			$data['email_file']=$config['rootPath'].$info['file']['savepath'].$info['file']['savename'];

		}
		//dump($data);die;
		if($email->add($data)){
			$this->success('发送邮件成功!',U('index'),3);
		}else{
			$this->error('发送邮件失败!',U('add'),3);
		}
		
	}
	public function download(){
		//1.接受id
		$id=I('get.id');
		//2.实例化Email模型,查询路径
		$email=D('Email');
		$data=$email->field('email_file')->find($id);
		//3.单独取出email_file
		$path=$data['email_file'];
		//4.使用PHP4句话进行文件下载
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header("Content-Length: ". filesize($path));
        readfile($path);
	}
	public function show(){
		//1.接受id
		$id=I('get.id');
		//2.实例化Email模型,调用find方法查询
		$email=D('Email');
		$email_info=$email->field('email_title,email_content')->find($id);
		echo json_encode($email_info);
	}
}
?>