<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class SqlController extends Controller{
	public function index(){
		echo "OK";
	}
	public function union(){
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$id = $_GET['id'];
		$Sql = "select * from article where id = ".$id;
		$Query = DB::query($Sql);
		$Farray = DB::farray($Query);
		$View_Title = "<h4>标题：".$Farray['title']."</h4>";
		$View_Text =  "<h4>内容：".$Farray['content']."</h4>";
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		
		$this->assign('title','GBug!');
		$this->assign('View_Title',$View_Title);
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->assign('nav1','checked=""');
		$this->assign('nav1_1','checked=""');
		$this->assign('union','md-nav__link--active');
		$this->render();
	}
	
	public function post(){
		$View_Login = '<hr>
		<form class="dark-theme" enctype="multipart/form-data" action="" method="POST">
		<h4>用户名:</h4>
		<input type="text" name="users" /><br>
		<h4>密码:</h4>
		<input type="password" name="pwd" /><br>
		<input type="submit" value="登录" name="sub"><br>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 1000px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="text"],
			.dark-theme input[type="password"] {
				width: 100%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 15px; /* 输入框下方留出空间 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				background-color: #333333; /* 输入框背景颜色 */
				color: #ffffff; /* 输入框文本颜色 */
			}
			.dark-theme input[type="submit"] {
				background-color: #007BFF; /* 提交按钮背景颜色 */
				color: #ffffff; /* 提交按钮文本颜色 */
				padding: 10px 20px; /* 提交按钮内边距 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				cursor: pointer; /* 鼠标悬停时显示手指图标 */
			}
		</style>
		';
		
		
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$username = $_POST['users'];
		$password = md5($_POST['pwd']);
		$Sql = "select * from users where username='$username' and password='$password'";
		$Query = DB::query($Sql);
		$Farray = DB::farray($Query);
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		if (!$Farray){
			$data = array(
				'users' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
				'pwd' => htmlspecialchars($password, ENT_QUOTES, 'UTF-8'),
				'return' => '登录失败'
			);
			$json = json_encode($data, JSON_UNESCAPED_UNICODE);
			$View_State = "<h4>".htmlspecialchars($json, ENT_QUOTES, 'UTF-8')."</h4>";
		}else{
			$data = array(
				'users' => htmlspecialchars($Farray['username'], ENT_QUOTES, 'UTF-8'),
				'pwd' => htmlspecialchars($Farray['password'], ENT_QUOTES, 'UTF-8'),
				'return' => '登录成功'
			);
			$json = json_encode($data, JSON_UNESCAPED_UNICODE);
			$View_State = "<h4>".htmlspecialchars($json, ENT_QUOTES, 'UTF-8')."</h4>";
		}
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_2','checked=""');
		$this->assign('post','md-nav__link--active');
		$this->assign('View_Login',$View_Login);
		$this->assign('View_Sql',$View_Sql);
		$this->assign('View_State',$View_State);
		$this->render();
	}
	
	public function blind(){
		$id = $_GET['id'];
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$Sql = "select * from article where id = ".$id;
		$Query = DB::query($Sql);
		$Farray = DB::farray($Query);
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		if(!$Farray){
		    $View_Text = "<h4>404 Not Found</h4>";
		}else{
			$View_Text = "<h4>Blind</h4>";
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_1','checked=""');
		$this->assign('blind','md-nav__link--active');
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->render();
	}
	
	public function blind_time(){
		$id = $_GET['id'];
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$Sql = "select * from article where id = ".$id;
		$Query = DB::query($Sql);
		$Farray = DB::farray($Query);
		$View_Text = "<h4>Time</h4>";
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_1','checked=""');
		$this->assign('time','md-nav__link--active');
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->render();
	}
	public function post_blind(){
		$View_Login = '<hr>
		<form class="dark-theme" enctype="multipart/form-data" action="" method="POST">
		<h4>用户名:</h4>
		<input type="text" name="users" /><br>
		<h4>密码:</h4>
		<input type="password" name="pwd" /><br>
		<input type="submit" value="登录" name="sub"><br>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 1000px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="text"],
			.dark-theme input[type="password"] {
				width: 100%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 15px; /* 输入框下方留出空间 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				background-color: #333333; /* 输入框背景颜色 */
				color: #ffffff; /* 输入框文本颜色 */
			}
			.dark-theme input[type="submit"] {
				background-color: #007BFF; /* 提交按钮背景颜色 */
				color: #ffffff; /* 提交按钮文本颜色 */
				padding: 10px 20px; /* 提交按钮内边距 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				cursor: pointer; /* 鼠标悬停时显示手指图标 */
			}
		</style>
		';
		
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$username = $_POST['users'];
		$password = md5($_POST['pwd']);
		$Sql = "select * from users where username='$username' and password='$password'";
		$Query = DB::query($Sql);
		$Farray = DB::farray($Query);
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		if (!$Farray){
			$data = array(
				'return' => '登录失败'
			);
			$json = json_encode($data, JSON_UNESCAPED_UNICODE);
			$View_State =  "<h4>".htmlspecialchars($json, ENT_QUOTES, 'UTF-8')."</h4>";
		}else{
			$data = array(
				'return' => '登录成功'
			);
			$json = json_encode($data, JSON_UNESCAPED_UNICODE);
			$View_State =  "<h4>".htmlspecialchars($json, ENT_QUOTES, 'UTF-8')."</h4>";
		}
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_2','checked=""');
		$this->assign('post_blind','md-nav__link--active');
		$this->assign('View_Login',$View_Login);
		$this->assign('View_State',$View_State);
		$this->assign('View_Sql',$View_Sql);
		$this->render();
	}
	public function error(){
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$id = $_GET['id'];
		$Sql = "select * from article where id = ".$id;
		$Query = DB::query($Sql);
		$Error = DB::error($Sql);
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		if($Result = $Query){
			$Farray = DB::farray($Query);
			$View_Title = "<h4>标题：".$Farray['title']."</h4>";
			$View_Text =  "<h4>内容：".$Farray['content']."</h4>";
		}else{
			$View_Text = "<h4 style=\"color:Grey\">Error：".htmlspecialchars($Error, ENT_QUOTES, 'UTF-8')."</h4>";
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_1','checked=""');
		$this->assign('error','md-nav__link--active');
		$this->assign('View_Title',$View_Title);
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->render();
		
	}
	public function error_null($id){
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$Sql = "select * from article where `id` = '".$id."'";
		$Query = DB::query($Sql);
		$Error = DB::error($Sql);
		$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		if($Result = $Query){
			$Farray = DB::farray($Query);
			$View_Title = "<h4>标题：".$Farray['title']."</h4>";
			$View_Text =  "<h4>内容：".$Farray['content']."</h4>";
		}else{
			$View_Text = "<h4 style=\"color:Grey\">Error：".htmlspecialchars($Error, ENT_QUOTES, 'UTF-8')."</h4>";
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav1','checked=""');
		$this->assign('nav1_1','checked=""');
		$this->assign('error_null','md-nav__link--active');
		$this->assign('View_Title',$View_Title);
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->render();
	}
	public function cookie(){
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$id = $_GET['id'];
		setcookie('id',$id);
		if(isset($_COOKIE['id'])){
		    $cookie = $_COOKIE['id'];
		    $Sql = "select * from article where id = ".$cookie;
			$Query = DB::query($Sql);
			$Farray = DB::farray($Query);
			$View_Title = "<h4>标题：".$Farray['title']."</h4>";
			$View_Text =  "<h4>内容：".$Farray['content']."</h4>";
			$View_Sql = "<h4>SQL：".htmlspecialchars($Sql, ENT_QUOTES, 'UTF-8')."</h4>";
		}
		$this->assign('title','GBug!');
		$this->assign('View_Title',$View_Title);
		$this->assign('View_Text',$View_Text);
		$this->assign('View_Sql',$View_Sql);
		$this->assign('nav1','checked=""');
		$this->assign('cookie','md-nav__link--active');
		$this->render();
	}
}

?>