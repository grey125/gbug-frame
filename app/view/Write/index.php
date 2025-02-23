<h1>反序列化漏洞 - 写入文件</h1>
<hr>

<?php

echo $t;

class write{
	public $name;
	public $text;
    
	function __wakeup(){
		$fp = fopen($this->name,"w");
		fwrite($fp,$this->text);
		fclose($fp);
	}
    

}

echo "<h4>";



print_r(unserialize("O:5:\"write\":2:".$data));

echo "</h4>";

?>