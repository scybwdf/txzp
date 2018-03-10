<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
        $autosession=session('auth');
        $group=M('auth_group')->where('id='.$autosession['uid'])->field('title')->find();
        $avatar=M('admin')->where('id='.$autosession['id'])->field('face64')->find();
        $this->avatar=__ROOT__.$avatar['face64'];
        $this->assign('grouptitle',$group['title']);
		$this->display();
    }
}