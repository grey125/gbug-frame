<h1>反序列化漏洞 - 方法构造</h1>
<hr>

<form id="myForm" class="dark-theme">
<h4>用户名:</h4>
<input type="text" name="user" id="user" />
<!-- 使用下拉列表框（<select>）来替代输入框 -->
<select name="func" id="func">
	<option value="cha">cha</option>
	<!-- 你可以根据需要添加更多的选项 -->
</select><br><br>
<input type="submit" value="查询" name="sub">
</form>

<h4 id="response"></h4>
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

<script>
// 当表单提交时，拦截提交并发送 AJAX 请求
document.getElementById('myForm').addEventListener('submit', function(event) {
	event.preventDefault();  // 阻止表单的默认提交行为

	// 获取表单数据
	var user = document.getElementById('user').value;
	var func = document.getElementById('func').value;

	// 构造要发送的数据对象
	var data = {
		func: func,  // 从下拉框获取函数名称
		user: user   // 从输入框获取用户名
	};

	// 将 JavaScript 对象转换为序列化的字符串（模拟类似 PHP 序列化的格式）
	var serializedData = `{s:4:"func";s:${func.length}:"${func}";s:4:"user";s:${user.length}:"${user}";}`;

	// 使用 fetch API 发送 POST 请求
	fetch('/func/post', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded' // 或 'application/json'
		},
		body: 'data=' + encodeURIComponent(serializedData) // URL 编码的形式发送
	})
	.then(response => response.text())  // 获取响应的文本
	.then(data => {
		console.log('Response:', data);  // 打印响应
		document.getElementById('response').innerHTML = data;
	})
	.catch((error) => {
		console.error('Error:', error);
	});
});
</script>

