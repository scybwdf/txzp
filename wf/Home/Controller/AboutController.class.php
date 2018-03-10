<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends CommonController {
    public function index(){
		$this->display();
    }
	public function connect(){
		$this->display("about_connect");
	}
	public function youshi(){
		$this->display("about_youshi");
	}
	public function licheng(){
		$this->display("about_licheng");
	}
	public function xieyi(){
		$this->display("disclaimer");
	}
}