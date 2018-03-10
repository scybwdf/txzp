<?php
namespace Home\Model;
use Think\Model;
class ArticleCateModel extends CommonModel {
    protected $_validate=array(
    array('title','require','分类标题不能为空'),
        array('title','','分类标题已经存在！',0,'unique',self::MODEL_BOTH), 
    );
}