<?php
namespace Admin\Controller;
//use Think\upload;
class KnowledgeController extends CommonController{
    public function index(){
        $knowledge=D('Knowledge');
        $knowledge_list=$knowledge->alias('k')
        ->field('k_id,k_title,k_content,k_smallpic,user_nickname,k_ctime')
        ->join('oa_user as u on u.user_id=k.k_author')
            ->select();
        $this->assign('knowledge_list',$knowledge_list);
        $this->display();

    }
	public function add(){
		$this->display();
	}
	public function upfile(){
		//1.图片上传
		$config=array(
			'maxSize'=>5000000,
			'exts'=>array('jpg','png','gif'),
			'rootPath'=>'./Upload/'
			);
		//实例化upload类
		$upload=new \Think\Upload($config);

		//调用upload方法进行图片上传
		$info=$upload->upload();

		if(!$info){
			echo $upload->getError();
		}else{
			//制作缩略图
			//实例化Image类
			$img=new \Think\Image();
			//打开上传文件
			$img->open($config['rootPath'].$info['Filedata']['savepath'].$info['Filedata']['savename']);
			//调用thumb方法制作缩略图
			$img->thumb(145,120);
			//调用save方法保存缩略图
			$smallpath=$config['rootPath'].$info['Filedata']['savepath'].'thumb_'.$info['Filedata']['savename'];
			$img->save($smallpath);
			//输出缩略图路径,返回给前台程序
			echo $smallpath;
		}
	}
	public function addOk(){
        $knowledge=D('Knowledge');
        $data=$knowledge->create('',1);
        //dump($data);die;
        if(!$data){
            echo $knowledge->getError();
        }
        if($knowledge->add($data)){
            $this->success('添加数据成功!',U('index'),3);
        }else{
            $this->error('添加数据失败!',U('add'),3);
        }

    }
    public function show(){
        $id=I('get.id');
        $knowledge=D('Knowledge');
        $k_info=$knowledge->field('k_title,k_content')->find($id);
        $k_info['k_content']=htmlspecialchars_decode($k_info['k_content']);
        echo json_encode($k_info);
    }

}
?>