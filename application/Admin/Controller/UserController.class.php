<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController{
	public function index(){
		//定义每页显示数量
		$pagesize=1;
		$this->assign('pagesize', $pagesize);
		//从URL中获取当前页号
		$pageno = I('get.p', 1);

		$user=D('User');
		$user_list=$user->page($pageno,$pagesize)->select();
		$this->assign('user_list',$user_list);

		//制作分页导航条
		$count=$user->count();
		$this->assign('count', $count);
		$page=new \Think\Page($count,$pagesize);
		//获取分页导航条的字符串
		$str=$page->show();
		$this->assign('str',$str);
		$this->display();
	}
	public function add(){
		//查询oa_dept,获取所有部门信息
		$dept=D('Dept');
		$dept_list=$dept->field('dept_id,dept_name')->select();
		$this->assign('dept_list',$dept_list);
		$this->display();
	}
	public function addOk(){
		$user=D('User');
		$data=$user->create('',1);
		if(!$data){
			// 开启批处理字段验证之后，会获取到错误信息的数组
			$err = $user->getError();
            dump($err);
		}else{
			if($user->add($data)){
				$this->success('添加用户成功!',U('index'),3);
			}else{
				$this->error('添加用户失败!',U('add'),3);
			}
		}
	}
	public function charts(){
		//1.实例化User模型
		$user=D('User');
		//2.按照user_dept进行分组
		$data=$user->alias('u')
		->field('dept_name,count(*) as num')
		->group('user_dept')
		->join('left join oa_dept as d on u.user_dept=d.dept_id')
		->select();
		//dump($data);
		//循环$data,产生视图文件需要的字符串
		$str="";
		foreach ($data as  $value) {
			$str.="['{$value['dept_name']}',{$value['num']}],";
		}
		$this->assign('str',$str);
		$this->display();
	}

	function getContent(){
        //1.接收页号
        $pageno = I('post.p');
        $pagesize = C('PAGESIZE');
        //echo "当前页号：".$pageno;
        //2. 根据页号查询应该显示的数据
        $user = D('User');
        $user_list = $user->page($pageno, $pagesize)->select();
        $this->assign('user_list', $user_list);
        $this->display();
        
         //将取得到的数组，转成字符串
        /*$str = "";
        foreach($user_list as $value){
            $str .= "<tr>
            	<td class='num'>".$value['user_id']."</th>
                <td class='name'>".$value['user_name']."</th>
                <td class='nickname'>".$value['user_nickname']."</th>
                <td class='dept'>".$value['user_dept']."</th>
                <td class='sex'>".$value['user_sex']."</th>
                <td class='birthday'>".$value['user_birthday']."</th>
                <th class='tel'>".$value['user_tel']."</th>
                <th class='email'>".$value['user_email']."</th>
                <th class='ctime'>".$value['user_ctime']."</th>
                <th class='operate'>操作</th>
            </tr>";
        }
        echo $str; */
    }
}
?>