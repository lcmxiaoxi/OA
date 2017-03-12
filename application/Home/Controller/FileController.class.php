<?php
namespace Home\Controller;
use Think\Controller;
class FileController extends Controller{
	public function upload(){
        $this->display();
    }
    public function upfile(){
       //1.定义文件上传配置项
        $config=array(
            //以字节为单位,3M=3*1024*1024
            'maxSize'=>3145728,
            //定义可上传的文件后缀
            'exts'=>array('jpg','png','gif'),
            //定义上传文件的根路径
            'rootPath'=>'./Upload/'
        );
        //2.实例化文件上传类,将自定义配置项传入
        $upload=new \Think\Upload($config);
        //3.调用upload方法进行文件上传,返回值$info就是上传结果
        $info=$upload->upload();
        //判断$info,如果$info为false时,调用getError输出错误信息
        //反之,输出文件上传信息
        if(!$info){
        	echo $upload->getError();
        }else{
        	dump($info);
        }
    }
}
?>