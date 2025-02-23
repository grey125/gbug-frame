<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;


class WriteController extends Controller{
	public function index() {
		$data = $_POST['data'];


		$t =  "<h4>POST /write/index<br>data={s:4:\"name\";s:19:\"static/log/xxxx.log\";s:4:\"text\";s:12:\"hello,world!\";}</h4>";
		
		$this->assign('title','GBug!');
		$this->assign('t',$t);
		$this->assign('data',$data);
		$this->assign('nav5','checked=""');
		$this->assign('w','md-nav__link--active');
		$this->render();
		
	}
	
}
?>