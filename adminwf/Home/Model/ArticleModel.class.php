<?php
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model {
    protected $_validate=array(
    array('title','require','标题必须'),
    );
    protected $_auto=array(
    array('create_time','time',1,'function'),
	 array('update_time','time',3,'function'),	
    );
}