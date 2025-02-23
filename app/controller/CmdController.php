<?php
namespace app\controller;
use frame\db\Db;
use frame\base\Controller;

class CmdController extends Controller{
	public function index()
	{	
		$View_Show =  '
		<form action="/cmd/save" method="post" class="dark-theme">
		<h4>选择音乐格式：
		<select name="class">
		  <option value="mp3">.mp3</option>
		  <option value="avi">.avi</option>
		</select>
		<input type="hidden" name="file" value="yinyue">&nbsp;&nbsp;
		<input type="submit"  value="转换">
		</h4>

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
				padding: 3px 10px; /* 提交按钮内边距 */
				border: none; /* 移除边框 */
				border-radius: 4px; /* 圆角边框 */
				cursor: pointer; /* 鼠标悬停时显示手指图标 */
			}
		</style>
		';
		
		
		$this->assign('title','GBug!');
		$this->assign('View_Show',$View_Show);
		$this->assign('nav6','checked=""');
		$this->assign('ml','md-nav__link--active');
		$this->render();
		
	}
	
	public function save()
	{
		date_default_timezone_set("PRC");
		if(isset($_POST['class']))
		{
			$show = "";
			$class = $_POST['class'];
			if($class == "mp3"){
				$name = $_POST['file'];

				$data = date('Ymd', time());
				$target_path  = "static/tmp/";
				$target_path .= basename($data.rand(0,123456789)).".".$class; 
				$cmd = shell_exec('ffmpeg.exe -i ' . $name .".amr " .$target_path);

				if($cmd == ""){
					$show = "<h4>Path : <a href='/{$target_path}'>{$target_path}</a> <br><br><a href='/cmd/index' style='color:#6495ED;text-decoration: none;'>返回</a></h4>";

				}else{
					$show = "<h4><pre> {$cmd} </pre><br><br><a href='/cmd/index' style='color:#6495ED;text-decoration: none;'>返回</a></h4>";
				}

			}
			
			if($class == "avi"){
				$name = $_POST['file'];

				$data = date('Ymd', time());
				$target_path  = "static/tmp/";
				$target_path .= basename($data.rand(0,123456789)).".".$class; 
				$cmd = shell_exec('ffmpeg.exe -i ' . $name .".amr " .$target_path);

				if($cmd == ""){
					$show = "<h4>Path : <a href='/{$target_path}'>{$target_path}</a> <br><br><a href='/cmd/index' style='color:#6495ED;text-decoration: none;'>返回</a></h4>";

				}else{
					$show = "<h4><pre> {$cmd} </pre><br><br><a href='/cmd/index' style='color:#6495ED;text-decoration: none;'>返回</a></h4>";
				}

			}
			
			$this->assign('title','GBug!');
			$this->assign('show',$show);
			$this->assign('nav6','checked=""');
			$this->assign('ml','md-nav__link--active');
			$this->render();
		}
		
	}
}