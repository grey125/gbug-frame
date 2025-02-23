<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;


class LogicController extends Controller{
	public function index()
	{
		$View_Up = '
		<form class="dark-theme" enctype="multipart/form-data" action="/logic/getpwd" method="POST">
		<h4>用户名:</h4>
		<input type="text" name="users" /><br>
		<input type="submit" value="找回密码" name="sub"><br>
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
		
		$this->assign('title','GBug!');
		$this->assign('View_Up',$View_Up);
		$this->assign('nav6','checked=""');
		$this->assign('lj','md-nav__link--active');
		$this->render();
	}
	
	public function getpwd()
	{
		$username = $_POST['users'];
		$token=md5(time().$username);
		
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		$Add_Sql = "insert into getpwd (id,users,pwd_key) value (null,'$username','$token')";
		$Query = DB::query($Add_Sql);
		
		$this->assign('title','GBug!');
		$this->assign('users',$username);
		$this->assign('nav6','checked=""');
		$this->assign('lj','md-nav__link--active');
		$this->render();
		
	}
	
	public function datepwd($users)
	{
		$View_Up = '
		<form class="dark-theme" action="" method="POST">
		<h4>用户名:</h4>
		<input type="text" name="users" value="'.$users.'" readonly/><br>
		<h4>Token:</h4>
		<input type="text" name="token" /><br>
		<h4>新密码:</h4>
		<input type="text" name="newpwd" /><br>
		<input type="submit" value="修改密码" name="sub"><br>
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
		
		if(!empty($_POST['sub'])){
			if(!empty($_POST['users'])){
				if(!empty($_POST['token'])){
					$token = $_POST['token'];
					$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
					$Select = DB::select("getpwd where users='".$users."' and pwd_key='".$token."'");
					$Farray = DB::farray($Select);
					if(!$Farray){
						$show = "<script language='javascript'>alert('token 错误！');</script>";
					}else{
						$Del_Sql = "delete from getpwd where users = '$users'";
						$Query = DB::query($Del_Sql);
						$show = "<script language='javascript'>alert('密码修改成功！');location='/logic/index';</script>";
					}
				}
			}
		}
		
		$this->assign('title','GBug!');
		$this->assign('View_Up',$View_Up);
		$this->assign('show',$show);
		$this->assign('nav6','checked=""');
		$this->assign('lj','md-nav__link--active');
		$this->render();
	}
}