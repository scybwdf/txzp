<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
    public function index(){
	header('location:'.U('Index/index'));
    }
}