<?php
//导航
class cache_nav_list_auto_cache extends auto_cache{
	public function load($param)
	{
		$param=array();
		$key = $this->build_key(__CLASS__,$param);
		$this->set_dir(WEB_ROOT."/public/runtime/index/pc/autocache/".__CLASS__."/");
		$nav_list = $GLOBALS['cache']->get($key);
		 
		if($nav_list === false)
		{
			$nav_list=M('Nav')->where(array('is_effect'=>1))->order('sort asc')->select();
			$nav_list = format_nav_list($nav_list_item);
			unset($nav_list_item);
			$GLOBALS['cache']->set_dir(WEB_ROOT."/public/runtime/index/pc/autocache/".__CLASS__."/");
			$GLOBALS['cache']->set($key,$nav_list);
		}
		return $nav_list;
	}
	public function rm($param)
	{
		$key = $this->build_key(__CLASS__,$param);
		$GLOBALS['cache']->set_dir(WEB_ROOT."/public/runtime/index/pc/autocache/".__CLASS__."/");
		$GLOBALS['cache']->rm($key);
	}
	public function clear_all()
	{
		$GLOBALS['cache']->set_dir(WEB_ROOT."public/runtime/index/pc/autocache/".__CLASS__."/");
		$GLOBALS['cache']->clear();
	}
}
?>