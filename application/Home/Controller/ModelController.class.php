<?php
namespace Home\Controller;
use Think\Controller;
class ModelController extends Controller{
	public function index(){
		//$model=M('Student');
		$model=D('Student');
		dump($model);

	}
	public function add_test(){
		//1.实例化Student模型
		$student=D('Student');
		//2.构造要添加的数据(数组)
		$arr=array(
			//下标必须和数据表字段一致,如果有自增长可不写或者写null
			//'sno'=>null,
			'sname'=>'张三',
			'sage'=>20,
			'ssex'=>'男',
			'sdept'=>5
			);
		//3.调用add方法向数据表中添加数据
		$student->add($arr);
	}
	public function save_test(){
        //1.实例化Student模型
		$student=D('Student');
		//2.构造要修改数据
		$arr=array(
			//单独使用save方法进行修改操作,必须使用主键
			//如果没有主键无法修改
			'sno'=>3,
			'sname'=>'赵六'
			);
		//3.调用save方法修改
		$student->save($arr);

	}
	public function del_test(){
		//1.实例化Student模型
		$student=D('Student');
		//2.调用delete方法进行删除,根据主键删除
		$student->delete(3);
	}
	public function select_test(){
		//1.实例化Student模型
		$student=D('Student');
		//2.调用select查询
		$data=$student->select();
		dump($data);

	}
	public function find_test(){
		//1.实例化Student模型
		$student=D('Student');
		//2.调用find查询
		//单纯使用find来进行查询时,只能使用主键作为参数
		$info=$student->find();
		echo $student->getLastSql()."<br>";
		$student->select();
		echo $student->getLastSql();
		dump($info);
		
	}

}
?>