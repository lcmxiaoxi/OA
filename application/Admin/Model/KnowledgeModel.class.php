<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/30
 * Time: 19:19
 */
namespace Admin\Model;
use Think\Model;
class KnowledgeModel extends Model{
    protected $pk='k_id';
    protected $fields=array(
    'k_id','k_title','k_desc','k_content','k_pic','k_smallpic','k_author','k_ctime'
    );
    protected $_map=array(
        'title'        =>'k_title',
        'description'  =>'k_desc',
        'content'      =>'k_content',
        'author'       =>'k_author'
    );
    protected $_validate=array(
        array('k_title','require','标题不能为空',1,'regex',3),
    );
    protected $_auto=array(
        array('k_ctime','getNowDateTime',3,'function')
    );

}
?>