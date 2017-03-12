<?php
//1.声明命名空间
namespace Home\Model;
//2.引入模型基类
use Think\Model;
//3.编写模型类,继承模型基类
class StudentModel extends Model{
	//1.定义主键
	protected $pk='sno';
	//2.定义字段信息
	protected $fields=array(
		'sno','sname','spasswd','sage','ssex','sdept','stime'
		);
	//3.设置字段映射
	protected $_map=array(
		'no'=>'sno',
		'name'=>'sname',
		'passwd'=>'spasswd',
		'age'=>'sage',
		'sex'=>'ssex',
		'dept'=>'sdept',
		);
	//4.自动验证
	protected $_validate=array(
		//sno:要验证的字段,数据表中的sno字段
		//require：验证使用的具体方法,使用名称为require的正则表达式
		//学号不能为空：当验证不能通过时的错误信息提示
		//1：该字段必须验证
		//regex:验证方式为正则表达式
		//3:在添加和修改时都验证该字段
		array('sno','require','学号不能为空',1,'regex',3),
		//验证姓名必须是6-12位字母,数字,下划线组合
		array('sname','username','用户名必须是6-12位字母数字下划线组合',1,'regex',3),
		//验证密码相同时,不需要有数据表的对应,使用密码字段进行验证即可
		//验证两个字段相同,使用confirm规则
		array('re-passwd','spasswd','两次密码不一致',1,'confirm',3),
		
		//验证年龄必须在6-15岁之间
		//callback 方法验证，定义的验证规则是当前模型类的一个方法 
		array('sage','checkAge','年龄信息不正确',2,'callback',3)
		);
		//参数:用户输入的年龄
		public function checkAge($age){
			if($age>=6 && $age<=15){
				return true;
			}
			return false;
		}
		//5.自动完成
		protected $_auto=array(
			//stime:要自动填充的字段
			//getNowDate:具体填充的方法
			//3.在添加和修改时都自动填充
			//callback：使用当前类中的方法来进行填充
			array('stime','getNowDate',3,'callback'),
			//将密码自动进行md5加密
			array('spasswd','passwd2md5',3,'callback'),
			);
		public function getNowDate(){
			return date('Y-m-d');
		}
		public function passwd2md5($passwd){
			return md5($passwd);
		}
}
?>