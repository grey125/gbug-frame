<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;
use PDO;

class XssController extends Controller{
	public function index(){
		echo "OK";
	}
	public function search(){
		$View_So = '
		<form class="dark-theme" enctype="multipart/form-data" action="" method="GET">
		<h4>用户名:</h4>
		<input type="text" name="user" /><br>
		<input type="submit" value="查询" name="sub"><br>
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
		

		
		if(array_key_exists("user",$_GET) && $_GET['user'] != null){
			$View_Search = $_GET['user'];
			$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
			$Sql = "SELECT * FROM users WHERE username = :user";
			$Pdo = DB::pdo()->prepare($Sql);
			
			$Pdo->bindParam(':user',$View_Search, PDO::PARAM_STR);
			$Pdo->execute();
			$Farray = $Pdo->fetch(PDO::FETCH_ASSOC);
			
			if (!$Farray){
				$data = array(
					'id' => $Farray['id'],
					'users' => htmlspecialchars($View_Search, ENT_QUOTES, 'UTF-8'),
					'return' => '0'
				);
				$json = json_encode($data, JSON_UNESCAPED_UNICODE);
				$View_State = "<h4>".$json."</h4>";
			}else{
				$data = array(
					'id' => $Farray['id'],
					'users' => $Farray['username'],
					'return' => '1'
				);
				$json = json_encode($data, JSON_UNESCAPED_UNICODE);
				$View_State = "<h4>".$json."</h4>";
			}
			
		    $View_Text = "<h4>查询用户 : ${View_Search}</h4>";
		    
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav2','checked=""');
		$this->assign('search','md-nav__link--active');
		$this->assign('View_So',$View_So);
		$this->assign('View_Text',$View_Text);
		$this->assign('View_State',$View_State);
		$this->render();
	}
	public function message(){
		$View_Send = '
		<form class="dark-theme" enctype="multipart/form-data" action="" method="POST">
		<h4>姓名:</h4>
		<input type="text" name="name" />
		<h4>留言内容:</h4>
		<textarea style="width:550px;height:200px;" name="content"></textarea>
		<h4><input type="submit" value="发布留言" name="sub">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/xss/message/?del=on" style="color:Grey;text-decoration: none;">清空数据</a></h4>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 600px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="text"] {
				width: 70%; /* 输入框宽度占满父元素 */
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
		
		setcookie('login_user','gbug');
		setcookie('login_pwd','8e05ac2d58b93a777d7bdcf6d42e2331');
		$DB = DB::config(DB_Host,DB_User,DB_Pwd,DB_Name);
		if($_GET['del'] == "on"){
		    $Sql = "TRUNCATE message";
		    $Query = DB::query($Sql);
		}
		
		if(!empty($_POST['name'])){
		    if(!empty($_POST['content'])){
		            $name = $_POST['name'];
		            $content = $_POST['content'];
		            $Add_Sql = "insert into message (id,name,content) value (null,'$name','$content')";
					$Query = DB::query($Add_Sql);
			}
		}

		$Select = DB::select("message");
		$View_Return = array();
		while($Farray = DB::farray($Select)){
			$View_Return[] = $Farray;

		}
		
		
		$this->assign('title','GBug!');
		$this->assign('nav2','checked=""');
		$this->assign('message','md-nav__link--active');
		$this->assign('View_Send',$View_Send);
		$this->assign('View_Return',$View_Return);
		$this->render();
		
		
	}
	public function dom(){
		$View_Code = '
		<script>
		function test(){
			var str = document.getElementById("text").value;
			document.getElementById("t").innerHTML = "<h4><a href=\'"+str+"\' style=\"color:black;text-decoration:none;\">Click on this and this is the generated link</a></h4>";
		}
		</script>
		<form class="dark-theme">
		<h4>链接:</h4>
		<input type="text" id="text" /><br>
		<input type="button" id="s" onclick="test()" value="生成链接" name="sub"><br>
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
			.dark-theme input[type="text"] {
				width: 100%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 15px; /* 输入框下方留出空间 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				background-color: #333333; /* 输入框背景颜色 */
				color: #ffffff; /* 输入框文本颜色 */
			}
			.dark-theme input[type="button"] {
				background-color: #007BFF; /* 提交按钮背景颜色 */
				color: #ffffff; /* 提交按钮文本颜色 */
				padding: 10px 20px; /* 提交按钮内边距 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				cursor: pointer; /* 鼠标悬停时显示手指图标 */
			}
		</style>
		<h4><div id="t"></div></h4>
		';
		
		$this->assign('title','GBug!');
		$this->assign('nav2','checked=""');
		$this->assign('dom','md-nav__link--active');
		$this->assign('View_Code',$View_Code);
		$this->render();
	}
}

?>