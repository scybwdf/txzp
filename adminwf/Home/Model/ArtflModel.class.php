<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ArtflModel extends RelationModel {
		Protected $tableName = 'article';
		 protected $_link = array(
         'article' => array(
		 'mapping_type'  => self::BELONGS_TO,
		 'class_name'    => 'article_cate',
		'foreign_key'   => 'id',
		'as_fields'  => 'type_id',
	 ),
         
    );
}