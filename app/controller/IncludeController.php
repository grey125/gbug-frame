<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class IncludeController extends Controller{
	public function index()
	{	ini_set('allow_url_include','1');
		$file = $_GET['file'];
		$View_Show = "<h4>GET /?file=xxx</h4>";
		$this->assign('title','GBug!');
		$this->assign('View_Show',$View_Show);
		$this->assign('file',$file);
		$this->assign('nav6','checked=""');
		$this->assign('inc','md-nav__link--active');
		$this->render();
		
	}
}