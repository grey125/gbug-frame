<?php 
namespace app\controller;
use frame\base\Controller;


class UploadController extends Controller{
	public function index(){
		echo "OK";
	}
	
	public function any(){
		$View_File =  '
		<form class="dark-theme" enctype="multipart/form-data" action="any_upload" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
		<h4><input type="file" name="uploaded" />&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Upload" name="Upload"></h4>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 800px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="file"] {
				width: 80%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 5px; /* 输入框下方留出空间 */
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
		$this->assign('nav4','checked=""');
		$this->assign('any','md-nav__link--active');
		$this->assign('View_File',$View_File);;
		$this->render();
		
	}
	
	public function any_upload(){
		if( isset( $_POST[ 'Upload' ] ) ) { 
			$data = date('Ymd', time());
		    $target_path  = "static/uploads/";
		    $file_name = substr(strrchr($_FILES['uploaded']['name'],"."),1);
		    $target_path .= basename($data.rand(0,123456789).".".$file_name); 
		    $uploaded_name = $_FILES[ 'uploaded' ][ 'name' ]; 
		    $uploaded_type = $_FILES[ 'uploaded' ][ 'type' ]; 
		    $uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];
			if($uploaded_size < 8388608){
				if(move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ],$target_path ) ) {
					$View_Data = "
					<h4>Path &nbsp;:&nbsp;  <a href='/{$target_path}' style='color:Grey;text-decoration: none;'>{$target_path}</a>
					&nbsp;<a href='/upload/any' style=\'color:#6495ED;text-decoration: none;\'>返回</a>
					</h4>";
					$View_Img = "<img src=\"/".$target_path."\"/>";
				}else{
					$View_Data = '<h4>Upload failed!&nbsp;<a href=\'/upload/any\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
				}
			}else{
				$View_Data = '<h4>Upload exceeded limit!&nbsp;<a href=\'/upload/any\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
			}
			
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav4','checked=""');
		$this->assign('any','md-nav__link--active');
		$this->assign('View_Data',$View_Data);
		$this->assign('View_Img',$View_Img);
		$this->render();
	}
	
	public function img(){
		$View_File =  '
		<form class="dark-theme" enctype="multipart/form-data" action="img_upload" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
		<h4><input type="file" name="uploaded" />&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Upload" name="Upload"></h4>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 800px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="file"] {
				width: 80%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 5px; /* 输入框下方留出空间 */
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
		$this->assign('nav4','checked=""');
		$this->assign('img','md-nav__link--active');
		$this->assign('View_File',$View_File);;
		$this->render();
	}
	
	public function img_upload(){
		if( isset( $_POST[ 'Upload' ] ) ) { 
			$data = date('Ymd', time());
		    $target_path  = "static/uploads/";
		    $file_name = substr(strrchr($_FILES['uploaded']['name'],"."),1);
		    $target_path .= basename($data.rand(0,123456789).".".$file_name); 
		    $uploaded_name = $_FILES[ 'uploaded' ][ 'name' ]; 
		    $uploaded_type = $_FILES[ 'uploaded' ][ 'type' ]; 
		    $uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];
			if($uploaded_size < 8388608){
				if(($uploaded_type == "image/jpeg" || $uploaded_type == "image/png" || $uploaded_type == "image/gif" )){
					if(move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ],$target_path ) ) {
						$View_Data = "
						<h4>Path &nbsp;:&nbsp;  <a href='/{$target_path}' style='color:Grey;text-decoration: none;'>{$target_path}</a>
						&nbsp;<a href='/upload/img' style=\'color:#6495ED;text-decoration: none;\'>返回</a>
						</h4>";
						$View_Img = "<img src=\"/".$target_path."\"/>";
					}else{
						$View_Data = '<h4>Upload failed!&nbsp;<a href=\'/upload/img\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
					}
				}else{
					$View_Data = '<h4>Only JPG, PNG, and GIF files can be uploaded!&nbsp;<a href=\'/upload/img\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
				}
			}else{
				$View_Data = '<h4>Upload exceeded limit!&nbsp;<a href=\'/upload/img\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
			}
			
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav4','checked=""');
		$this->assign('img','md-nav__link--active');
		$this->assign('View_Data',$View_Data);
		$this->assign('View_Img',$View_Img);
		$this->render();
	}
	
	public function js(){
		$View_File =  '
		<form class="dark-theme" onsubmit="return checkupload();" enctype="multipart/form-data" action="js_upload" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
		<h4><input type="file" name="uploaded" id="uploadfile" />&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Upload" name="Upload"></h4>
		</form>
		<style>
			.dark-theme {
				background-color: #121212; /* 设置背景颜色为深色 */
				color: #ffffff; /* 设置文本颜色为白色 */
				padding: 20px; /* 添加内边距 */
				border-radius: 8px; /* 圆角边框 */
				max-width: 800px; /* 限制表单最大宽度 */
				margin: 1 auto; /* 居中表单 */
			}
			.dark-theme h4 {
				margin-bottom: 10px; /* 标题下方留出空间 */
				color: #999999; /* 标题颜色稍微亮一点 */
			}
			.dark-theme input[type="file"] {
				width: 80%; /* 输入框宽度占满父元素 */
				padding: 10px; /* 输入框内边距 */
				margin-bottom: 5px; /* 输入框下方留出空间 */
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
		
		<script type="text/javascript">
		function checkupload(){
		    var filetag=document.getElementById("uploadfile")
		    var filename=filetag.value;
		    var lastpos=filename.lastIndexOf(".");
		    var ext = filename.substring(lastpos+1);
		    if (ext !="jpeg" && ext !="png" && ext !="gif" && ext !="jpg"){
		        alert("文件类型错误，上传失败");
		        return false;
		    }
		}
		</script>
		
		';
		
		$this->assign('title','GBug!');
		$this->assign('nav4','checked=""');
		$this->assign('js','md-nav__link--active');
		$this->assign('View_File',$View_File);
		$this->render();
	}
	
	public function js_upload(){
		if( isset( $_POST[ 'Upload' ] ) ) { 
			$data = date('Ymd', time());
		    $target_path  = "static/uploads/";
		    $file_name = substr(strrchr($_FILES['uploaded']['name'],"."),1);
		    $target_path .= basename($data.rand(0,123456789).".".$file_name); 
		    $uploaded_name = $_FILES[ 'uploaded' ][ 'name' ]; 
		    $uploaded_type = $_FILES[ 'uploaded' ][ 'type' ]; 
		    $uploaded_size = $_FILES[ 'uploaded' ][ 'size' ];
			if($uploaded_size < 8388608){
				if(move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ],$target_path ) ) {
					$View_Data = "
					<h4>Path &nbsp;:&nbsp;  <a href='/{$target_path}' style='color:Grey;text-decoration: none;'>{$target_path}</a>
					&nbsp;<a href='/upload/js' style=\'color:#6495ED;text-decoration: none;\'>返回</a>
					</h4>";
					$View_Img = "<img src=\"/".$target_path."\"/>";
				}else{
					$View_Data = '<h4>Upload failed!&nbsp;<a href=\'/upload/js\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
				}
			}else{
				$View_Data = '<h4>Upload exceeded limit!&nbsp;<a href=\'/upload/js\' style=\'color:#6495ED;text-decoration: none;\'>返回</a></h4>';
			}
			
		}
		
		$this->assign('title','GBug!');
		$this->assign('nav4','checked=""');
		$this->assign('js','md-nav__link--active');
		$this->assign('View_Data',$View_Data);
		$this->assign('View_Img',$View_Img);
		$this->render();
	}
}
 
?>