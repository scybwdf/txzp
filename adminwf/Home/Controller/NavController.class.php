<?php 
namespace Home\Controller;
use Think\Controller;
class NavController extends BaseController{
	private $navs;
	public function __construct(){
		parent::__construct();
		$nav=array(
		'Index'=>array(
				'name'=>'首页'
			),
		'Deal'=>array(
			'name'=>'项目',
			'acts'=>array(
			'index'=>'项目列表',
			'inside'=>'项目内页'
		)),
		'Baike'=>array(
			'name'=>'三板百科',
			'acts'=>array(
			'index'=>'百科首页',
		)),	
		'Article'=>array(
			'name'	=>'文章',
			'acts'	=>array(
			'index'	=>'文章列表',
			'inside'	=>'文章内页'
		)),
		'Luyan'	=>array(
			'name'	=>'路演',
			'acts'	=>array(
			'index'	=>'路演列表',
			'inside'	=>'路演内页'
		))		
		);
		$this->navs=$nav;
	}
	public function index(){
		$this->display();
	}
	public function catelist(){
		if($_GET){
		$search=I('search');	
		$cate=M(CONTROLLER_NAME);
		if($search!=''){
			$where['id']=$search;
			$where['name']=array('like',"%$search%");
			$where['_logic'] = 'or';
			$count = $cate->where($where)->count();
			$list=$cate->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		else{
			$count = $cate->count();
			$list=$cate->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();	
		}
		
		$data['rows']=$list;
		$data['total']=$count;	
		$this->ajaxReturn($data);
		}
		
	}
	public function load_module()
	{
		$id = intval($_REQUEST['id']);
		$module = trim($_REQUEST['module']);
		$act = M('Nav')->where("id=".$id)->getField("u_action");
		$data['data']=$this->navs[$module]['acts'];
		$data['info']=$act;
		$data['status']=1;
		$this->ajaxReturn($data);
	}	
		public function add(){
		if(!IS_POST){
		$this->assign('navs',$this->navs);	
		$this->assign('vosort',M(CONTROLLER_NAME)->max('sort')+1);
		$this->display();
		}
		if(IS_POST){
			$cateadd=M(CONTROLLER_NAME);
			if(!$cateadd->create()){
				$this->error($cateadd->getError());
				exit();
			}
			else
			{
				if($cateadd->add()){
					$this->success('添加成功',U('Nav/index'));
				}
				else{
					$this->error('添加失败');
				}
			}
		}
	}
	
	public function edit(){
		if(!IS_POST){
		$id=I('id');
        $editdis=M(CONTROLLER_NAME);
		$this->assign('navs',$this->navs);		
        $this->assign('vo',$editdis->find($id));
        $this->display();
		}
		if(IS_POST){
			$editend=D(CONTROLLER_NAME);
			if($editend->create()){
				$result=$editend->save();
				if($result){
                
					$this->success('编辑成功',U('index'));
				}
				else{
					$this->error('编辑失败');
				}
			}
			else{
				$this->error($editend->getError());
			}
		}
	}
	
}