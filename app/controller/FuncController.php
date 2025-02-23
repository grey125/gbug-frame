<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;


class FuncController extends Controller{
	public function index() {
		
		$this->assign('title','GBug!');
		$this->assign('nav5','checked=""');
		$this->assign('f','md-nav__link--active');
		$this->render();
		
	}
	
	public function post() {
		//header('Content-Type: application/json');
		$data = $_POST['data'];
		$this->assign('data',$data);
		$this->load();
		
	}
	
}
?>