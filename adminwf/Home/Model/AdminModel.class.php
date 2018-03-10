<?php
namespace Home\Model;
use Think\Model\RelationModel;
class AdminModel extends RelationModel {
	 protected $_link = array(
         'admin' => array(
		 'mapping_type'  => self::BELONGS_TO,
		 'class_name'    => 'auth_group',
		 'foreign_key'   => 'uid',
		 'as_fields'  => 'title',
	 ),
         
    );
}