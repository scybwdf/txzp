<?php
namespace Home\Model;
use Think\Model\RelationModel;
class GroupModel extends RelationModel {
		Protected $tableName = 'auth_group';
	 protected $_link = array(
		 'auth_group_access' => array(
			'mapping_type' => self::HAS_ONE,
		 	// 'class_name'    => 'auth_group',
		//	'foreign_key' => 'uid'
			)  
    );
	Public function insert ($data=NULL) {
		$data = is_null($data) ? $_POST : $data;
		return $this->relation(true)->data($data)->add();
	}
}