<?php
namespace frame;

// 框架根目录
defined('CORE_PATH') or define('CORE_PATH', __DIR__);

header("Content-Type: text/html; charset=UTF-8");
class Frame
{
    // 配置内容
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
        
    }

    // 运行程序
    public function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
		$this->setDbConfig();
        $this->route();
    }

    // 路由处理
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
        // 清除?之后的内容
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);

        // 使得可以这样访问 index.php/{controller}/{action}
        $position = strpos($url, 'index.php');
        if ($position !== false) {
            $url = substr($url, $position + strlen('index.php'));
        }

        // 删除前后的“/”
        $url = trim($url, '/');

        if ($url) {
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);
            
            // 获取控制器名
            $controllerName = ucfirst($urlArray[0]);
            
            // 获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            
            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }

        // 判断控制器和操作是否存在
        $controller = 'app\\controller\\'. $controllerName . 'Controller';
        if (!class_exists($controller)) {
            exit($controllerName . ' 控制器不存在');
        }
        if (!method_exists($controller, $actionName)) {
            exit($actionName . ' 方法不存在');
        }

        // 如果控制器和操作名存在，则实例化控制器，因为控制器对象里面
        // 还会用到控制器名和操作名，所以实例化的时候把他们俩的名称也
        // 传进去。结合Controller基类一起看
        $dispatch = new $controller($controllerName, $actionName);

        // $dispatch保存控制器实例化后的对象，我们就可以调用它的方法，
        // 也可以像方法中传入参数，以下等同于：$dispatch->$actionName($param)
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    // 检测开发环境
    public function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }

    // 删除敏感字符
    public function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // 检测敏感字符并删除
    public function removeMagicQuotes()
    {
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    public function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
	
	// 配置数据库信息
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_Host', $this->config['db']['Host']);
            define('DB_Name', $this->config['db']['Database']);
            define('DB_User', $this->config['db']['User']);
            define('DB_Pwd', $this->config['db']['Pwd']);
        }
    }


    // 自动加载类
    public function loadClass($className)
    {
        $classMap = $this->classMap();

        if (isset($classMap[$className])) {
            // 包含内核文件
            $file = $classMap[$className];
        } elseif (strpos($className, '\\') !== false) {
            // 包含应用（application目录）文件
            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';
            if (!is_file($file)) {
                return;
            }
        } else {
            return;
        }

        include $file;

        // 这里可以加入判断，如果名为$className的类、接口或者性状不存在，则在调试模式下抛出错误
    }

    // 内核文件命名空间映射关系
    protected function classMap()
    {
        return [
            'icephp\base\Controller' => CORE_PATH . '/base/Controller.php',
			'icephp\base\Admin' => CORE_PATH . '/base/Admin.php',
			'icephp\base\AdminView' => CORE_PATH . '/base/AdminView.php',
			'icephp\base\View' => CORE_PATH . '/base/View.php',
			'icephp\base\Database' => CORE_PATH . '/base/Database.php',
			'icephp\db\Db' => CORE_PATH . '/db/Db.php',
			
        ];
    }
}