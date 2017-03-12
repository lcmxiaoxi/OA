<?php
namespace Admin\Controller;
use Think\Upload;
class DocController extends CommonController{
	public function index(){
		//1.实例化Doc模型
		$doc=D('Doc');
		//2.调用select方法查询
		$doc_list=$doc->alias('d')
		->field('doc_id,doc_title,doc_content,doc_file,user_name,doc_ctime')
		->join('oa_user as u on d.doc_author=u.user_id')
		->select();
		//3.分配
		$this->assign('doc_list',$doc_list);
		$this->display();
	}
	public function add(){
		$this->display();
	}
	/*public function addOk(){
		//1.定义上传配置项
		$config=array(
			'maxSize'=>3000000,
			//使用C方法从配置文件中读取
			'exts'=>C('UPLOAD_EXTS'),
			'rootPath'=>'./Upload/',
			);
		//2.实例化文件上传类
		$upload=new Upload($config);
		//3.调用upload方法进行文件上传
		$info=$upload->upload();
		//dump($info);
		if(!$info){
			echo $upload->getError();
		}
		//4.实例化Doc模型,调用create方法,接受表单数据
		$doc=D('Doc');
		$data=$doc->create('',1);
		//5.调用add方法将数据插入数据表
		//判断如果有上传的文件,将上传后的路径加入到$data中
		if($info){
			$data['doc_file']=
			$config['rootPath'].$info['file']['savepath'].$info['file']['savename'];
	     }
	
		if($doc->add($data)){
			$this->success('添加公文成功!',U('index'),3);
		}else{
			$this->error('添加公文失败!',U('add'),3);
		}

	}*/

	 function addOk(){
        //1. 定义上传配置项
        $config = array(
            'maxSize' => 3000000,
            //使用C方法从配置文件中读取
            'exts'    => C('UPLOAD_EXTS'),
            'rootPath'=> './Upload/',
        );
        //2. 实例化文件上传类
        $upload = new Upload($config);
        //3. 调用upload方法进行文件上传
        $info = $upload->upload();
        if(!$info){
            echo $upload->getError();
        }  
        //4. 实例化Doc模型，调用create方法，接收表单数据
        $doc = D('Doc');
        //dump($doc);die;
        $data = $doc->create('', 1);

        //5. 调用add方法将数据插入数据表
        // 判断如果有上传的文件，将上传后的路径加入到$data中
        if($info){
           $data['doc_file'] = $config['rootPath'].$info['file']['savepath'].$info['file']['savename'];
        }
        
        if($doc->add($data)){
            $this->success('添加公文成功', U('index'), 3);
        } else {
            $this->error('添加公文失败', U('add'), 3);
        }
    }
	public function download(){
		//1.接受id
		$id=I('get.id');
		//2.实例化Doc模型,查询路径
		$doc=D('Doc');
		$data=$doc->field('doc_file')->find($id);
		//3.单独取出doc_file
		$path=$data['doc_file'];
		//4.使用PHP4句话进行文件下载
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header("Content-Length: ". filesize($path));
        readfile($path);
	}
	public function show(){
		//1.接收id
		$id=I('get.id');
		//2.实例化Doc模型,调用find方法查询
		$doc=D('Doc');
		$doc_info=$doc->field('doc_title,doc_content')->find($id);
		//3.将doc_content中的实体转回特殊字符
		$doc_info['doc_content']=htmlspecialchars_decode($doc_info['doc_content']);
		echo json_encode($doc_info);
	}
}
?>