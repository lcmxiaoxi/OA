<?php
//1.声明命名空间
namespace Admin\Model;
//2.引入模型基类
use Think\Model;
//3.编写模型,继承模型基类
class DeptModel extends Model{
	//4.定义主键
	protected $pk='dept_id';
	//5.定义字段
	protected $fields=array(
		'dept_id','dept_name','dept_pid','dept_level','dept_sort','dept_remark','dept_ctime'
		);
	//6.字段映射
	protected $_map=array(
		'id'=>'dept_id',
		'name'=>'dept_name',
		'pid'=>'dept_pid',
		'level'=>'dept_level',
		'sort'=>'dept_sort',
		'remark'=>'dept_remark'
		);
	//7.自动验证
	protected $_validate=array(
		//验证部门名称不能为空
		array('dept_name','require','部门名称不能为空',1,'regex',3),
		//验证部门的pid必须是存在部门id
		array('dept_pid','checkDept','上级部门不正确',1,'callback',3),
		);
	function checkDept($id){
		//查询所有的dept_id,返回一个二维数组
		$data=$this->field('dept_id')->select();
		//将二维数组转为一维数组
		$result=array();
		foreach($data as $value){
			$result[]=$value['dept_id'];
		}
		//将0压入数组的最后一个单元
		array_push($result, 0);
		//检查表单提交pid 是否存在已存在部门id中
		if(in_array($id, $result)){
			return true;
		}
		return false;
	}
	//8.自动填充
	protected $_auto=array(
		 // 自动填充dept_ctime字段， 使用function方式
		 // getNowDate函数写在 Common/function.php文件中，在程序的任何位置都以使用
		 array('dept_ctime','getNowDate',3,'function'),
		);
	
}
?>