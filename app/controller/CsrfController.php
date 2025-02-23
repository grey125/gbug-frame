<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class CsrfController extends Controller{
	public function index(){
		session_start();
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if (@$_SESSION['login_user'] !="" || @$_SESSION['login_pwd'] !=""){
			$user = $_SESSION['login_user'];
			$pwd =  $_SESSION['login_pwd'];
			$Select = DB::select("users where username='".$user."' and password='".$pwd."'");
			$Farray = DB::farray($Select);
			$View_User = "";
			if(@$_SESSION['login_user'] == $Farray['username'] || @$_SESSION['login_pwd'] == $Farray['password']){
		        $View_User = "<h4>欢迎：".$_SESSION['login_user']."&nbsp;&nbsp;<a href='/csrf/out' style='color:Grey; text-decoration: none;'>注销</a>&nbsp;&nbsp;<a href='/csrf/del_user/$user' style='color:Grey; text-decoration: none;'>删除该用户所有地址</a></h4>";
		    }else{
		        echo "<script language='javascript'>location='/csrf/login';</script>";
		    }
				
		}else{
		    echo "<script language='javascript'>location='/csrf/login';</script>";
		}
		$username = $_SESSION['login_user'];
		$View_Add = '
		<form class="dark-theme" enctype="multipart/form-data" action="/csrf/found" method="POST">
		<h4>姓名:</h4>
		<input type="text" name="name" />
		<h4>联系电话:</h4>
		<input type="text" name="tel" />
		<h4>地址:</h4>
		<input type="text" name="position" />
		<h4>备注:</h4>
		<input type="text" name="remark" />
		<h4><input type="submit" value="添加地址" name="sub">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/csrf/clear" style="color:Grey;text-decoration: none;">清空数据</a></h4>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 500px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="text"] {
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
		

		$Select = DB::select("address");
		$View_Return = array();
		while($Farray = DB::farray($Select)){
			$View_Return[] = $Farray;

		}
		
		
		$this->assign('title','GBug!');
		$this->assign('nav3','checked=""');
		$this->assign('csrf','md-nav__link--active');
		$this->assign('View_Add',$View_Add);
		$this->assign('View_Return',$View_Return);
		$this->assign('View_User',$View_User);
		$this->render();
		
	}
	
	public function login(){
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
						echo "<script language='javascript'>alert('登录失败！');location='/csrf/login';</script>";
					}else{
						@session_start();
						$_SESSION['login_user'] = $user;
						$_SESSION['login_pwd'] = $pwd;
						echo "<script language='javascript'>location='/csrf/index';</script>";
					}

		        }
		    }
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav3','checked=""');
		$this->assign('csrf','md-nav__link--active');
		$this->assign('View_Login',$View_Login);
		$this->render();
	}
	
	public function found(){
		session_start();
		
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		
		if (@$_SESSION['login_user'] !="" || @$_SESSION['login_pwd'] !=""){
			$user = $_SESSION['login_user'];
			$pwd =  $_SESSION['login_pwd'];
			$Select = DB::select("users where username='".$user."' and password='".$pwd."'");
			$Farray = DB::farray($Select);
			$View_User = "";
			if(@$_SESSION['login_user'] == $Farray['username'] || @$_SESSION['login_pwd'] == $Farray['password']){
				if(!empty($_POST['sub'])){
					if(!empty($_POST['name'])){
						if(!empty($_POST['tel'])){
							if(!empty($_POST['position'])){
								if(!empty($_POST['remark'])){
									$name = $_POST['name'];
									$tel = $_POST['tel'];
									$position = $_POST['position'];
									$remark = $_POST['remark'];
									$username = $_SESSION['login_user'];
									$Add_Sql = "insert into address (id,name,tel,position,remark,username) value (null,'$name','$tel','$position','$remark','$username')";
									$Query = DB::query($Add_Sql);
									echo "<script language='javascript'>location='/csrf/index';</script>";
								}else{
									$name = $_POST['name'];
									$tel = $_POST['tel'];
									$position = $_POST['position'];
									$remark = "无";
									$username = $_SESSION['login_user'];
									$Add_Sql = "insert into address (id,name,tel,position,remark,username) value (null,'$name','$tel','$position','$remark','$username')";
									$Query = DB::query($Add_Sql);
									echo "<script language='javascript'>location='/csrf/index';</script>";
								}
							}else{
								echo "<script language='javascript'>alert('地址不能为空！');location='/csrf/index';</script>";
							}
						}else{
							echo "<script language='javascript'>alert('联系电话不能为空！');location='/csrf/index';</script>";
						}
					}else{
						echo "<script language='javascript'>alert('姓名不能为空！');location='/csrf/index';</script>";
					}
				}
				
		    }else{
		        echo "<script language='javascript'>location='/csrf/login';</script>";
		    }
		}else{
			echo "<script language='javascript'>location='/csrf/login';</script>";
		}
	}
	
	public function del_id($id){
		session_start();
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if (@$_SESSION['login_user'] !="" || @$_SESSION['login_pwd'] !=""){
			$user = $_SESSION['login_user'];
			$pwd =  $_SESSION['login_pwd'];
			$Select = DB::select("users where username='".$user."' and password='".$pwd."'");
			$Farray = DB::farray($Select);
			$View_User = "";
			if(@$_SESSION['login_user'] == $Farray['username'] || @$_SESSION['login_pwd'] == $Farray['password']){
		        $Sql = "DELETE FROM address WHERE id = '$id';";
				$Query = DB::query($Sql);
				echo "<script language='javascript'>location='/csrf/index';</script>";
		    }else{
		        echo "<script language='javascript'>location='/csrf/login';</script>";
		    }
				
		}else{
		    echo "<script language='javascript'>location='/csrf/login';</script>";
		}
	}
	
	public function del_user($user){
		session_start();
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if (@$_SESSION['login_user'] !="" || @$_SESSION['login_pwd'] !=""){
			$user = $_SESSION['login_user'];
			$pwd =  $_SESSION['login_pwd'];
			$Select = DB::select("users where username='".$user."' and password='".$pwd."'");
			$Farray = DB::farray($Select);
			$View_User = "";
			if(@$_SESSION['login_user'] == $Farray['username'] || @$_SESSION['login_pwd'] == $Farray['password']){
				$Sql = "DELETE FROM address WHERE username = '$user';";
				$Query = DB::query($Sql);
				echo "<script language='javascript'>location='/csrf/index';</script>";
		    }else{
		        echo "<script language='javascript'>location='/csrf/login';</script>";
		    }
				
		}else{
		    echo "<script language='javascript'>location='/csrf/login';</script>";
		}
		
	}
	public function clear(){
		session_start();
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if (@$_SESSION['login_user'] !="" || @$_SESSION['login_pwd'] !=""){
			$user = $_SESSION['login_user'];
			$pwd =  $_SESSION['login_pwd'];
			$Select = DB::select("users where username='".$user."' and password='".$pwd."'");
			$Farray = DB::farray($Select);
			$View_User = "";
			if(@$_SESSION['login_user'] == $Farray['username'] || @$_SESSION['login_pwd'] == $Farray['password']){
				$Sql = "TRUNCATE address";
				$Query = DB::query($Sql);
				echo "<script language='javascript'>location='/csrf/index';</script>";
		    }else{
		        echo "<script language='javascript'>location='/csrf/login';</script>";
		    }
				
		}else{
		    echo "<script language='javascript'>location='/csrf/login';</script>";
		}

	}
	
	public function out(){
		session_start();
		unset($_SESSION['login_user']);
		unset($_SESSION['login_pwd']);
		header("location:/csrf/login");
	}
}