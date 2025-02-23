<?php
namespace frame\base;

/**
 * 视图基类
 */
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller, $action)
    {
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }
 
    // 分配变量
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }
	public function load()
	{
		extract($this->variables);
		
		$controllerLayout = APP_PATH . 'app/view/' . $this->_controller . '/' . $this->_action . '.php';
		
		if (is_file($controllerLayout)) {
			include ($controllerLayout);
		} else {
			echo "<h1>无法找到视图文件</h1>";
		}
	}
	
    // 渲染显示
    public function render()
    {
        extract($this->variables);
		
		$defaultHeader = APP_PATH . 'static/view/Top.php';
        $defaultFooter = APP_PATH . 'static/view/End.php';

        $controllerTop = APP_PATH . 'app/view/' . $this->_controller . '/Top.php';
		$controllerEnd = APP_PATH . 'app/view/' . $this->_controller . '/End.php';
		
        $controllerLayout = APP_PATH . 'app/view/' . $this->_controller . '/' . $this->_action . '.php';
		
		if (is_file($controllerHeader)) {
            include ($controllerHeader);
        } else {
            include ($defaultHeader);
        }
        
		// 页头文件
		
		if (is_file($controllerTop)) {
			include ($controllerTop);
		}

		//判断视图文件是否存在
		
	  
		// 导航文件
		//if (is_file($controllerNavi)) {
		//	include ($controllerNavi);
		//}
		// 页脚文件
		
		if (is_file($controllerLayout)) {
			include ($controllerLayout);
		} else {
			echo "<h1>无法找到视图文件</h1>";
		}
		
		if (is_file($controllerEnd)) {
			include ($controllerEnd);
		}
		

		
    }
}