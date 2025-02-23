<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class EvalController extends Controller{
	public function index()
	{	
		$View_Show = "<h4>POST eval/index<br>data[user]=xxx</h4>";
		$data = $_POST['data'];
		$show = "";
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if(isset($data)){
			if(isset($data[user])){
				$user = $data[user];
				$Cha_Select = DB::select("users where username = '${user}'");
				$Cha_Farray = DB::farray($Cha_Select);
				$user_cha = array();
				$id = $Cha_Farray['id'];
				$pwd = $Cha_Farray['password'];
				$data = "array(
					\"id\"=>\"$id\",
					\"user\"=>$user,
					\"pwd\"=>\"$pwd\"
					)";
				eval("\$user_cha = $data;");
				$json = json_encode($user_cha);
				$show = "<h4>".$json."</h4>";

			}else{
				$show = "<h4>{NULL}</h4>";
			}

		}
		
		$this->assign('title','GBug!');
		$this->assign('View_Show',$View_Show);
		$this->assign('show',$show);
		$this->assign('nav6','checked=""');
		$this->assign('d','md-nav__link--active');
		$this->render();
		
	}
}