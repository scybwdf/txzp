<?php
	namespace Home\Model;
	use Think\Model\RelationModel;
	class UserModel extends RelationModel {
		Protected $tableName='user';
		Protected $_link=array(
			'userinfo'=>array(
			'mapping_type'=>self::HAS_ONE,
			'foreign_key'=>'uid',
			)
		);
		public function insert($data=null){
			$data=is_null($data)?$_POST:$data;
			return $this->relation(true)->data($data)->add();
		}
}