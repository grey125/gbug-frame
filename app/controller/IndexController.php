<?php 
namespace app\controller;
use frame\base\Controller;


class IndexController extends Controller{
	public function index(){
		$this->assign('title','GBug!');
		$this->render();
	}
	public function help()
	{
		$this->load();
	}

}
 
?>