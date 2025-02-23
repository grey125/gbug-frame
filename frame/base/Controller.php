<?php
namespace frame\base;

/**
 * 控制器基类
 */
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;

    // 构造函数，初始化属性，并实例化对应模型
    public function __construct($controller, $action)
    {
        ini_set('display_errors','off');
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
		
    }

    // 分配变量
    public function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }
	
	public function load()
	{
		$this->_view->load();
	}

    // 渲染视图
    public function render()
    {
        $this->_view->render();
    }
}

?>