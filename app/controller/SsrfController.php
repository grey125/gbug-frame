<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class SsrfController extends Controller{
	public function index(){
		echo "OK";
	}
	
	public function getPhoto(){
		$View_Get = '
		<form class="dark-theme" enctype="multipart/form-data" action="" method="GET">
		<h4>Url:</h4>
		<input type="text" name="url" /><br>
		<input type="submit" value="获取图片" name="sub"><br>
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
		
		if(array_key_exists("url",$_GET) && $_GET['url'] != null){
			$url = $_GET['url'];
			$data = date('Ymd', time());
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch,CURLOPT_URL,$url);
			$View_Data = curl_exec($ch);
			$File_Path = 'static/images/'.$data.rand(0,123456789).'.jpg';
			file_put_contents($File_Path,$View_Data);
			$View_Img = "<img src=\"/".$File_Path."\"/>";
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav3','checked=""');
		$this->assign('ssrf','md-nav__link--active');
		$this->assign('View_Get',$View_Get);
		$this->assign('View_Img',$View_Img);
		$this->assign('View_Data',$View_Data);
		$this->render();
		
	}
}