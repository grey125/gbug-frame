<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;


class CookieController extends Controller{
	public function index()
	{
		$View_Login = '
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
		
		if(isset($_POST['sub'])){
		    if(isset($_POST['users'])){
		        if(isset($_POST['pwd'])){
		            $user = $_POST['users'];
		            $pwd = md5($_POST['pwd']);
		            $user = str_replace('\'', '', $user);
		            $pwd =  str_replace('\'', '', $pwd);
		            $DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
        			$Login = DB::select("users where username='".$user."' and password='".$pwd."'");
					$Login_State = DB::farray($Login);
					if (!$Login_State){
						echo "<script language='javascript'>alert('登录失败！');location='/cookie/index';</script>";
					}else{
						setcookie('users',$user);
						echo "<script language='javascript'>location='/cookie/users';</script>";
					}

		        }
		    }
		}
		
		$this->assign('title','GBug!');
		$this->assign('View_Login',$View_Login);
		$this->assign('nav6','checked=""');
		$this->assign('hui','md-nav__link--active');
		$this->render();
		
	}
	
	public function users()
	{
		
		$show = "";

		if (isset($_COOKIE['users'])){
			$show = "<h4>欢迎：".$_COOKIE['users']."&nbsp;&nbsp;<a href='/cookie/out'>注销</a></h4>";
		}else{
	        $show = "<script language='javascript'>alert(\"非法登录!\");location='/cookie/index';</script>";
		}
		
		
		$this->assign('title','GBug!');
		$this->assign('show',$show);
		$this->assign('nav6','checked=""');
		$this->assign('hui','md-nav__link--active');
		$this->render();
	}
	
	public function out()
	{
		setcookie("users", "", time() - 3600, "/");

		header("location:/cookie/index");
	}
	
}
?>