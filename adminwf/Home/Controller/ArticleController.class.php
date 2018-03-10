<?php 
namespace Home\Controller;
use Think\Controller;
class ArticleController extends BaseController{
	public function index(){
		if(IS_GET&&!IS_AJAX){
		    $this->display();
        }

        if(IS_GET&&IS_AJAX){
            $search=I('search');
            $cate=M('Article');
            if($search!=''){
                $where['id']=$search;
                $where['title']=array('like',"%$search%");
                $where['_logic'] = 'or';
                $map['_complex']=$where;
                $map['is_delete']=array('eq',0);
                $count = $cate->where($map)->count();
                $list=$cate->where($map)->field('id,title,cate_id,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            else{
                $count = $cate->where(array('is_delete'=>0))->count();
                $list=$cate->where(array('is_delete'=>0))->field('id,title,cate_id,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            $artcate=M('article_cate')->select();
            foreach($list as $k=>$v){
                unset($list[$k]['cate_id']);
                foreach($artcate as $m=>$n){
                    if($v['cate_id']==$n['id']){
                        $list[$k]['cate_id']=$n['title'];
                    }
                }
                if(!isset($list[$k]['cate_id'])){
                    $list[$k]['cate_id']="顶级分类";
                }
            }
            $data['rows']=$list;
            $data['total']=$count;
            $this->ajaxReturn($data);
        }
	}

	public function trash(){
	    if(IS_GET&&!IS_AJAX){
	        $this->display();
        }
        if(IS_GET&&IS_AJAX){
            $search=I('search');
            $cate=M('Article');
            if($search!=''){
                $where['id']=$search;
                $where['title']=array('like',"%$search%");
                $where['_logic'] = 'or';
                $map['_complex']=$where;
                $map['is_delete']=array('eq',1);
                $count = $cate->where($map)->count();
                $list=$cate->where($map)->field('id,title,cate_id,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            else{
                $count = $cate->where(array('is_delete'=>1))->count();
                $list=$cate->where(array('is_delete'=>1))->field('id,title,cate_id,is_effect,sort')->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            $artcate=M('article_cate')->select();
            foreach($list as $k=>$v){
                unset($list[$k]['cate_id']);
                foreach($artcate as $m=>$n){
                    if($v['cate_id']==$n['id']){
                        $list[$k]['cate_id']=$n['title'];
                    }
                }
                if(!isset($list[$k]['cate_id'])){
                    $list[$k]['cate_id']="顶级分类";
                }
            }
            $data['rows']=$list;
            $data['total']=$count;
            $this->ajaxReturn($data);
        }
    }
	 public function add(){
		if(!IS_POST){
			$article=M('article');
			$cate_tree=M('article_cate')->where('is_effect=1')->select();
			$cate_tree = D('article_cate')->toFormatTree($cate_tree);
			foreach($cate_tree as $k=>$v){
				$cate_tree[$k]['title']=$v['title_show'];
			}
			$this->assign('cate',$cate_tree);
			$this->assign('vosort',M('article')->max('sort')+1);
			$this->display();
		}
		if(IS_POST){
      	$Article=D('Article');
        if($Article->create()){
            $result=$Article->add();
            if($result){
			$cateid=$_POST['cate_id'];
			if($cateid!=$_SESSION['cateid']&&!isset($_SESSION['cateid'])){
				if(isset($_SESSION['cateid'])){
					session_unset('cateid');
				}
				session('cateid',$cateid);
			}
                $this->success('新增成功',U('Article/index'));
            }
            else{
                $this->error('新增失败');
            }}
            else{
                $this->error($Article->getError());
		}}
        
        }
    public function edit(){
		 $id=I('id');
		if(!IS_POST){
		$Article=M('Article');
		$cate_tree=M('article_cate')->select();
		$cate_tree = D('article_cate')->toFormatTree($cate_tree);
			foreach($cate_tree as $k=>$v){
				$cate_tree[$k]['title']=$v['title_show'];
			}
		$this->assign('cate',$cate_tree);	
        $this->assign('vo',$Article->find($id));
        $this->display();}
		if(IS_POST){
			$artedit=D('article');
			if($data=$artedit->create()){
				$result=$artedit->save($data);
				if($result){
					$this->success('编辑成功',U('index'));
				}
				else{
					$this->error('编辑失败');
				}
			}
			else{
				$this->error($artedit->getError());
			}
		}
    }
   
}