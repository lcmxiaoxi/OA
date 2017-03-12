<?php 
namespace Admin\Controller;
use Think\Controller;
class DeptController extends CommonController{
	public function index(){
		//1.实例化Dept模型
		$dept=D('Dept');
		//2.调用select方法查询部门信息
		$dept_list=$dept->alias('d1')
		->field('d1.dept_id,d1.dept_name,d1.dept_pid,d2.dept_name as name,d1.dept_sort,d1.dept_remark,d1.dept_level')
		->join("left join oa_dept as d2 on d1.dept_pid=d2.dept_id")
		->select();
		//dump($dept_list);die;
		$dept_list=getDeptTree($dept_list);
		//3.将数据分配到模板
		$this->assign('dept_list',$dept_list);
		$this->display();
	}
	public function add(){
		$dept=D('Dept');
		$dept_list=$dept->select();
		$this->assign('dept_list',$dept_list);
		$this->display();
	}
	public function addOk(){
		//1.接收表单提交数据
		//使用I函数来接收表单提交数据
		$name=I('post.name');
		$pid=I('post.pid');
		$level=I('post.level');
		$sort=I('post.sort');
		$remark=I('post.remark');
		//构造要进行插入的数据
		$info=array(
			'dept_name'=>$name,
			'dept_pid'=>$pid,
			'dept_sort'=>$sort,
			'dept_remark'=>$remark,
			'dept_level'=>$level,
			'dept_ctime'=>date('Y-m-d')
			);
		//实例化Dept模型
		$dept=D('Dept');
		//调用add方法进行数据表插入操作
		//添加成功/失败，提示和跳转
		if($dept->add($info)){
			//参数1:提示信息
			//参数2:跳转的地址
			//参数3:延迟多少秒后跳转
			$this->success("添加部门成功",u('index'),3);
		}else{
			$this->error("添加部门失败",u('add'),3);
		}
	}
	public function del(){
		$id=I('get.id');
		$dept=D('Dept');
		if($dept->delete($id)){
			$this->success('删除部门成功!',U('index'),3);
		}else{
			$this->error('删除部门失败!',U('index'),3);
		}
	}
	public function dels(){
		$ids=I('get.ids');
		//echo $ids;
		$dept=D('Dept');
		if($dept->delete($ids)){
			$this->success("删除部门成功!",U('index'),3);
		}else{
			$this->error('删除部门失败!',U('index'),3);
		}
	}
	public function edit(){
	 //① 接收get传递的部门id，根据部门id查询部门信息，并分配到模板
		$id=I('get.id');
		$dept=D('Dept');
		$dept_info=$dept->find($id);
		$this->assign('dept_info',$dept_info);

	//② 查询全部部门信息，分配到模板
		$dept_list=$dept->field('dept_id,dept_name')->select();
		$this->assign('dept_list',$dept_list);
		$this->display();
	}
	public function modify(){
		$dept=D('Dept');
		// create方法的第二个参数，声明当前是添加还是修改
        // 1--添加    2--修改
        $data = $dept->create('', 2);
        if(!$data){
        	echo $dept->getError();
        }else{
        	dump($data);die;
        	//调用save方法修改数据表
        	if($dept->save($data)){
        		$this->success('修改部门成功',U('index'),3);
        	}else{
        		$this->error('修该部门失败',U('edit','id='.$data['dept_id']),3);
        	}
        }
	}
}

?>