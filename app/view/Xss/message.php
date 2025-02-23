<h1>XSS跨站脚本攻击-存储型</h1>
<hr>
<?php
foreach($View_Return as $r):
	echo "<h4>&nbsp;&nbsp;&nbsp;# ".$r['id']."&nbsp;&nbsp;&nbsp;<br>";
	echo "&nbsp;&nbsp;&nbsp;".$r['name']." 说：&nbsp;&nbsp;&nbsp;<br>";
	echo "&nbsp;&nbsp;&nbsp;".$r['content']."&nbsp;&nbsp;&nbsp;</h4>";
	echo "<hr>";
endforeach;

echo $View_Send;

?>