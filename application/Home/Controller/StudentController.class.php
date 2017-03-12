<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller{
	public function add(){
		$this->display();
	}
	public function addOk(){
		//1.实例化Student模型
		$student=D('Student');
		//2.调用create方法创建数据对象(接受表单数据)
		$data=$student->create();
		//dump($data);
		//3.判断$data的值,如果为false,则调用getError方法获取错误信息
		if(!$data){
			echo $student->getError();
		}else{
			dump($data);
		}
	}
	public function where_test(){
		//1.实例化Student模型
		$student=D('Student');
		//2.查询student表中男生的信息
		//$data=$student->where("ssex='男'")->select();
		//查询student表中年龄大于18的男生的信息
		$data=$student->where("ssex='男' and sage>18")->select();
		dump($data);
	}
	public function order_test(){
		//1.实例化Student模型
		$student=D('Student');
		//查询student表中年龄大于18的男生的信息，并按照年龄从高到低排序
		$data=$student->where("sage>18 and ssex='男'")
		->order("sage desc")
		->limit(2)
		->select();
		dump($data);
	}
	public function group_test(){
		$student=D('Student');
		//分别统计年龄大于18的男生和女生的总数
		$data=$student
		->field('ssex,count(*) as num')
		->where('sage>18')
		->group('ssex')
		->select();
		dump($data);
	}
	public function table_test(){
		//实例化空模型
		$model=D();
		//调用table方法连表,使用实际表名
		$data=$model
		->field('s.sno,s.sname,s.sage,s.ssex,d.name')
		->table('tp_student as s,tp_department as d')
		->where('s.sdept=d.id and sage>18')
		->select();
		dump($data);
	}
	public function join_test(){
		//1.实例化Student模型,用做主表
		$student=D('Student');
		//2.调用join方法进行查询
		//使用inner join
		/*$data=$student->alias('s')
		->join('tp_department as d on s.sdept=d.id')
		->select();
		dump($data);*/
		//使用left join
		$data=$student->alias(s)
		->join('left join tp_department as d on s.sdept=d.id')
		->select();
		dump($data);
	}
	public function collect_test(){
		$student=D('Student');
		//1.统计学生总数量
		//$data=$student->count();
		//2.查询年龄最大/最小的学生的年龄
		//$data=$student->max('Sage');
		//$data=$student->min('Sage');
		//3.查询平均年龄
		//$data=$student->avg('sage');
		//4.查询年龄总和
		$data=$student->sum('sage');
		dump($data);
	}
	public function sql_test(){
		//1.实例化空模型
		$model=D();
		//2.编写SQL
		$sql="SELECT s.sno,s.sname,s.sage,s.ssex,d.name FROM tp_student as s LEFT JOIN tp_department as d ON s.sdept=d.id ";
		//3.调用query方法执行sql,返回值一定是一个二维数组
		$data=$model->query($sql);
		dump($data);
	}
	public function trans(){
		//1.实例化User模型
		$user=D('User');
		//设置两个变量来作为SQL是否执行成功的标志
		$flag1=false;
		$flag2=false;
		//开启事物处理
		$user->startTrans();
		//3.zs减2000
		$arr=array(
			'uid'=>1,
			'umoney'=>3000
			);
		if($user->save($arr)){
			$flag1=true;
		}
	//4.ls加2000
	$arr1=array(
		'uid'=>2,
		'umoney'=>3000
		);
	if($user->save($arr1)){
		$flag2=true;
	}
	//5.如果全部执行成功,则执行commit()提交处理,反之,执行rollback回滚
	if($flag1 && $flag2){
		$user->commit();
	}else{
		$user->rollback();
	}
	}
}
?>