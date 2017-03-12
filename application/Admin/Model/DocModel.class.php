<?php
namespace Admin\Model;
use Think\Model;
class DocModel extends Model{
    //1. 定义主键
    protected $pk = 'doc_id';
    //2. 定义字段
    protected $fields = array(
        'doc_id', 'doc_title', 'doc_content', 'doc_file', 'doc_author', 'doc_ctime'
    );
    //3. 字段映射
    protected $_map = array(
        'title' => 'doc_title',
        'content' => 'doc_content'
    );
    //4. 自动验证
    protected $_validate = array(
        array('doc_title', 'require', '标题不能为空', 1, 'regex', 3),
        array('doc_content', 'require', '内容不能为空', 1, 'regex', 3)
    );
    //5. 自动完成
    protected $_auto = array(
        array('doc_author', 'getUid', 3, 'function'),
        array('doc_ctime', 'getNowDateTime', 3, 'function'),
    );
}