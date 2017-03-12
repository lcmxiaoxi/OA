<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class ImageController extends Controller{
	public function index(){
		//1.实例化验证码类
		$v=new Verify();
		//2.调用entry方法绘制验证码
		$v->entry();
	}
	public function crop_test(){
		//1.实例化Image类
		$img=new \Think\Image();
		//2.载入要进行裁剪的图片
		$img->open('./Upload/2016-12-25/tiger.png');
		//3.进行裁剪
		 //参数1/2: 剪裁的宽高，如果不指定起始坐标点，默认从0,0开始
        //参数3/4: 指定剪裁的起始坐标点
        //参数5/6: 剪裁后的保存大小, 如果不指定该参数，就按照剪裁的大小来保存
        $img->crop(576,888,0,0,100,100);
        //4.保存裁剪好的图片
        $img->save('./Upload/tiger1.png');
	}
	public function thumb_test(){
		//1.实例化Image类
		$img=new \Think\Image();
		//2.载入要进行缩略处理的图片
		$img->open('./Upload/2016-12-25/tiger.png');
		/*//3.进行缩略操作
		$img->thumb(100,100);//指定大小等比例*/
		$width=$img->width();
		$height=$img->height();
		$img->thumb($width*1.5,$height*1.5,2);////参数1/2: 指定缩略图大小
        //参数3: 如果缩略图大小超过原始图片的大小，使用留白填充缩略图
		//4.保存图片
		$img->save('./Upload/tiger2.png');
	}
	public function water_test(){
		//1.实例化Image类
		$img=new \Think\Image();
		//2.打开要添加水印的图片
		$img->open('./Upload/2016-12-25/300.jpg');
		 //3. 增加水印
        //参数1: 水印图片路径
        //参数2: 指定水印的位置（1-9，默认是9--右下角）
        //参数3: 透明度, 值越小越透明
        $img->water('./Upload/tiger1.png',9,15);
        //4. 保存图片
        $img->save('./Upload/300.jpg');
	}
}
?>