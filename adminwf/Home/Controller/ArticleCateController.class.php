<?php 
namespace Home\Controller;
use Think\Controller;
class ArticleCateController extends BaseController{
	public function index(){
		if(IS_GET&&!IS_AJAX){
		    $this->display();
		}
        if(IS_GET&&IS_AJAX){
            $search=I('search');
            $cate=M('article_cate');
            if($search!=''){
                $where['_logic'] = 'or';
                $where['id']=$search;
                $where['title']=array('like',"%$search%");
                $map['_complex']=$where;
                $map['is_delete']=array('eq',0);

                $count = $cate->where($map)->count();
                $list=$cate->where($map)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            else{
                $count = $cate->where(array('is_delete'=>array('eq',0)))->count();
                $list=$cate->where(array('is_delete'=>array('eq',0)))->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            $catelist = D(ArticleCate)->toFormatTree($list);
            foreach($catelist as $k=>$v){
                unset($catelist['title']);
                $pidlist=$v['pid'];
                unset($catelist[$k]['pid']);
                $idlist[]=$v['id'];
                $titlelist[]=$v['title'];
                foreach($idlist as $m=>$n){
                    if($pidlist==$n){
                        $catelist[$k]['pid']=$titlelist[$m];
                    }
                }
                if(!isset($catelist[$k]['pid'])){
                    $catelist[$k]['pid']="顶级分类";
                }
                $catelist[$k]['title']=$v['title_show'];
            }
            $data['rows']=$catelist;
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
            $cate=M('article_cate');
            if($search!=''){
                $where['id']=$search;
                $where['title']=array('like',"%$search%");
                $where['_logic'] = 'or';
                $map['_complex']=$where;
                $map['is_delete']=array('eq',1);
                $count = $cate->where($map)->count();
                $list=$cate->where($map)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            else{
                $count = $cate->where(array('is_delete'=>array('eq',1)))->count();
                $list=$cate->where(array('is_delete'=>array('eq',1)))->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            $catelist = D(ArticleCate)->toFormatTree($list);
            foreach($catelist as $k=>$v){
                unset($catelist['title']);
                $pidlist=$v['pid'];
                unset($catelist[$k]['pid']);
                $idlist[]=$v['id'];
                $titlelist[]=$v['title'];
                foreach($idlist as $m=>$n){
                    if($pidlist==$n){
                        $catelist[$k]['pid']=$titlelist[$m];
                    }
                }
                if(!isset($catelist[$k]['pid'])){
                    $catelist[$k]['pid']="顶级分类";
                }
                $catelist[$k]['title']=$v['title_show'];
            }
            $data['rows']=$catelist;
            $data['total']=$count;
            $this->ajaxReturn($data);
        }

    }

    public function add(){
		if(!IS_POST){
		$cate_tree=M(CONTROLLER_NAME)->where('is_effect=1')->select();
		$cate_tree = D(CONTROLLER_NAME)->toFormatTree($cate_tree);
		foreach($cate_tree as $k=>$v){
			$cate_tree[$k]['title']=$v['title_show'];
		}
		$this->assign('vosort',M(CONTROLLER_NAME)->max('sort')+1);
		$this->assign('cate',$cate_tree);
		$this->display();
		}
		if(IS_POST){
			$cateadd=D(CONTROLLER_NAME);
			if(!$cateadd->create()){
				$this->error($cateadd->getError());
				exit();
			}
			else
			{
				if($cateadd->add()){
					$this->success('添加成功',U('ArticleCate/index'));
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
        $editdis=M('article_cate');
		$cate_tree=M(CONTROLLER_NAME)->select();	
		$cate_tree = D(CONTROLLER_NAME)->toFormatTree($cate_tree);
		foreach($cate_tree as $k=>$v){
			$cate_tree[$k]['title']=$v['title_show'];
		}	
		$this->assign('catelist',$cate_tree);
        $this->assign('vo',$editdis->find($id));
        $this->display();
		}
		if(IS_POST){
			$editend=D('article_cate');
			if(I('id')==I('pid')){
					$this->error('你已经是'.I('title').'分类啦');
					
				}
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