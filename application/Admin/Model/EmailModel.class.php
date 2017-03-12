<?php
namespace Admin\Model;
use Think\Model;
class EmailModel extends Model{
	protected $pk='email_id';
	protected $fields=array(
		'email_id','email_title','email_content','email_file','email_from','email_to','email_ctime'
		);
	protected $_map=array(
		'nickname'=>'email_to',
		'title'=>'email_title',
		'content'=>'email_content',
		);
	protected $_validate=array(
		array('email_to','require','收件人不能为空',1,'regex',3),
		array('email_title','require','邮件主题不能为空',1,'regex',3),
		array('email_content','require','邮件内容不能为空',1,'regex',3)
		);
	protected $_auto=array(
		array('email_from','getUid',3,'function'),
		array('email_ctime','getNowDateTime',3,'function')
		);
}
?>