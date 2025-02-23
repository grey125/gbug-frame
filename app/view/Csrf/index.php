<h1>CSRF跨站请求伪造</h1>
<hr>
<?php

echo $View_User;
echo $View_Add;
echo "<hr>";
foreach($View_Return as $r):
	echo "<h4>&nbsp;&nbsp;&nbsp;姓名：".htmlspecialchars($r['name'], ENT_QUOTES, 'UTF-8')."&nbsp;&nbsp;&nbsp;|";
	echo "&nbsp;&nbsp;&nbsp;联系电话：".htmlspecialchars($r['tel'], ENT_QUOTES, 'UTF-8')."&nbsp;&nbsp;&nbsp;|";
	echo "&nbsp;&nbsp;&nbsp;地址：".htmlspecialchars($r['position'], ENT_QUOTES, 'UTF-8')."&nbsp;&nbsp;&nbsp;|";
	echo "&nbsp;&nbsp;&nbsp;备注：".htmlspecialchars($r['remark'], ENT_QUOTES, 'UTF-8')."&nbsp;&nbsp;&nbsp;<a href='/csrf/del_id/".$r['id']."' style='color:Grey; text-decoration: none;'>删除</a></h4>";
	echo "<hr>";
endforeach;




?>