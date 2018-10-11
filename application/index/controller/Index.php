<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch("add");
    }
    public function add(){
        $request = Request::instance()->post();
        $user = new User;
        $user->data($request);
        $res = $user->save();
        if($res){
            $this->success("添加成功",'index/show');
        }else{
            $this->error("添加失败",'index/index');
        }
    }
    public function show(){
        $user = new User();
        $data = $user->select();
        return $this->fetch('show',['data'=>$data]);
    }
    public function del(){
        $id = Request::instance()->get('id');
        $user = new User();
        $res = $user->where("id","$id")->delete();
        if($res){
            $this->success("删除成功",'index/show');
        }else{
            $this->error("删除失败",'index/show');
        }
    }
    public function up(){
        $id = Request::instance()->get('id');
        $user = new User();
        $data = $user->where("id","$id")->find();
        return $this->fetch('up',['data'=>$data]);
    }
    public function doup(){
        $id = Request::instance()->post('id');
        $data = Request::instance()->post();
        $user = new User();
        $res = $user->where('id',"$id")->update($data);
        if($res){
            $this->success("修改成功",'index/show');
        }else{
            $this->error("修改失败",'index/show');
        }
    }
}
