<?php
/**
 * Author :FELIX.
 * Date: 2018/3/8
 * Time: 12:58
 */
namespace Home\Controller;
use Think\Controller;

class AuthRuleController extends BaseController{

    public function index(){
        if(IS_GET&&!IS_AJAX){
            $this->display();
        }
        if(IS_GET&&IS_AJAX){
            $search=I('search');
            $auth=M('auth_rule');
            if($search!=''){
                $where['id']=$search;
                $where['title']=array('like',"%$search%");
                $where['name']=array('like',"%$search%");
                $where['_logic'] = 'or';
                $count = $auth->where($where)->count();
                $list=$auth->where($where)->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            else{
                $count = $auth->count();
                $list=$auth->order(array(I('sort')=>I('order')))->limit(I('offset'),I('limit'))->select();
            }
            $data['rows']=$list;
            $data['total']=$count;
            $this->ajaxReturn($data);
        }

    }

    public function add(){
        if(IS_GET){
            $this->display();
        }
        if(IS_POST){
            $data['name']=trim($_POST['name']);
            $data['title']=trim($_POST['title']);
            $auth_rule=M('auth_rule');
            $res=$auth_rule->where(array('name'=>$data['name']))->count();
            if($res>0){
                $this->error('规则已存在');
            }
            else{

                if($auth_rule->create($data)){
                    if($auth_rule->add($data)){
                        $this->success('新增成功',U('index'));
                    }
                    else{
                        $this->error('新增失败');
                    }
                }
                else{
                    $this->error('新增失败');
                }
            }
        }

    }

    public function edit(){
        $auth_role=M('auth_rule');
        if(IS_GET){
            $id=intval($_GET['id']);
            $res=$auth_role->find($id);
            $this->assign('vo',$res);
            $this->display();

        }

        if(IS_POST){
            $data['id']=intval($_POST['id']);
            $data['name']=trim($_POST['name']);
            $data['title']=trim($_POST['title']);
            $auth_rule=M('auth_rule');
            $res=$auth_rule->where(array('name'=>$data['name'],'id'=>array('neq'=>$data['id'])))->count();
            if($res>0){
                $this->error('规则已存在');
            }
            else{

                if($auth_rule->create($data)){
                    if($auth_rule->save($data)){
                        $this->success('编辑成功',U('index'));
                    }
                    else{
                        $this->error('编辑失败');
                    }
                }
                else{
                    $this->error('编辑失败');
                }
            }
        }

    }

}