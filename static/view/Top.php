<!doctype html>
<html lang="zh" class="no-js">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="description" content="GFrame-Bug">
      <link rel="canonical" href="#">
      <meta name="author" content="Morker">
      <link rel="shortcut icon" href="./assets/images/favicon.png">
      <meta name="generator" content="mkdocs-1.1.2, mkdocs-material-6.1.7">
      <title><?php echo $title;?></title>
      <link rel="stylesheet" href="/static/assets/stylesheets/main.19753c6b.min.css">
      <link rel="stylesheet" href="/static/assets/stylesheets/palette.196e0c26.min.css">
      <meta name="theme-color" content="#000000">
  </head>
  <body dir="ltr" data-md-color-scheme="preference" data-md-color-primary="black" data-md-color-accent="red">
  <script>matchMedia("(prefers-color-scheme:white)").matches&&document.body.setAttribute("data-md-color-scheme","slate")</script>
<header class="md-header" data-md-component="header">
  <nav class="md-header-nav md-grid" aria-label="Header">
    <label class="md-header-nav__button md-icon" for="__drawer">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 6h18v2H3V6m0 5h18v2H3v-2m0 5h18v2H3v-2z"/></svg>
    </label>
    <div class="md-header-nav__title" data-md-component="header-title">
        <div class="md-header-nav__ellipsis">
          <a href="/index">首页</a>&nbsp;&nbsp;
          <a href="/index/help" target="_blank">帮助文档</a>&nbsp;&nbsp;
        </div>
    </div>
  </nav>
</header>
<div class="md-container" data-md-component="container">
<main class="md-main" data-md-component="main">
<div class="md-main__inner md-grid">
<div class="md-sidebar md-sidebar--primary" data-md-component="navigation">
<div class="md-sidebar__scrollwrap">
<div class="md-sidebar__inner">
                    
<nav class="md-nav md-nav--primary" aria-label="Navigation" data-md-level="0">
  <label class="md-nav__title" for="__drawer">
	 GBug-Frame
  </label>
<ul class="md-nav__list" data-md-scrollfix>
<li class="md-nav__item md-nav__item--nested">
  <input class="md-nav__toggle md-toggle" data-md-toggle="nav-1" type="checkbox" id="nav-1" <?php echo $nav1;?> >
  <label class="md-nav__link " for="nav-1">
    SQL注入
    <span class="md-nav__icon md-icon"></span>
  </label>
  <nav class="md-nav" aria-label="SQL注入" data-md-level="1">
    <label class="md-nav__title" for="nav-1-1">
      <span class="md-nav__icon md-icon"></span>
      SQL注入
    </label>
    <ul class="md-nav__list" data-md-scrollfix>
<li class="md-nav__item md-nav__item--nested">
  
  <input class="md-nav__toggle md-toggle" data-md-toggle="nav-1-1-1" type="checkbox" id="nav-1-1-1" <?php echo $nav1_1;?> >
  <label class="md-nav__link" for="nav-1-1-1">
    GET请求
    <span class="md-nav__icon md-icon"></span>
  </label>
  <nav class="md-nav" aria-label="GET请求" data-md-level="2">
    <label class="md-nav__title" for="nav-1-1-1">
      <span class="md-nav__icon md-icon"></span>
      GET请求
    </label>
    <ul class="md-nav__list" data-md-scrollfix>

  <li class="md-nav__item <?php echo $union;?>">
    <a href="/sql/union/?id=1" class="md-nav__link">
      联合查询注入
    </a>
  </li>
  <li class="md-nav__item <?php echo $blind;?>" >
    <a href="/sql/blind/?id=1" class="md-nav__link">
      布尔盲注
    </a>
  </li>
  <li class="md-nav__item <?php echo $time;?>" >
    <a href="/sql/blind_time/?id=1" class="md-nav__link">
      时间盲注
    </a>
  </li>
  <li class="md-nav__item <?php echo $error;?>" >
    <a href="/sql/error/?id=1" class="md-nav__link">
      报错注入
    </a>
  </li>
  <li class="md-nav__item <?php echo $error_null;?>" >
    <a href="/sql/error_null/1" class="md-nav__link">
      报错注入(无空格)
    </a>
  </li>
  </ul>
  </nav>
  <li class="md-nav__item md-nav__item--nested">
  <input class="md-nav__toggle md-toggle" data-md-toggle="nav-1-1-2" type="checkbox" id="nav-1-1-2" <?php echo $nav1_2;?>>
  <label class="md-nav__link" for="nav-1-1-2">
    POST请求
    <span class="md-nav__icon md-icon"></span>
  </label>
  <nav class="md-nav" aria-label="POST请求" data-md-level="2">
    <label class="md-nav__title" for="nav-1-1-2">
      <span class="md-nav__icon md-icon"></span>
      POST请求
    </label>
    <ul class="md-nav__list" data-md-scrollfix>
      <li class="md-nav__item <?php echo $post;?>">
        <a href="/sql/post" class="md-nav__link">
          POST注入
        </a>
      </li>
      <li class="md-nav__item <?php echo $post_blind;?>">
        <a href="/sql/post_blind" class="md-nav__link">
          POST盲注
        </a>
      </li>
    </ul>
  </nav>

  <li class="md-nav__item">
      <a href="/sql/cookie/?id=1" class="md-nav__link <?php echo $cookie;?>">
        COOKIE注入
      </a>
  </li>
</ul>
</nav>

<li class="md-nav__item md-nav__item--nested">
  <input class="md-nav__toggle md-toggle" data-md-toggle="nav-2" type="checkbox" id="nav-2" <?php echo $nav2;?> >
  <label class="md-nav__link" for="nav-2">
    XSS跨站脚本攻击
    <span class="md-nav__icon md-icon"></span>
  </label>
  <nav class="md-nav" aria-label="XSS跨站脚本攻击" data-md-level="2">
    <label class="md-nav__title" for="nav-2-1">
      <span class="md-nav__icon md-icon"></span>
      XSS跨站脚本攻击
    </label>
    <ul class="md-nav__list" data-md-scrollfix>
      <li class="md-nav__item md-nav__item--nested <?php echo $search;?>">
        <a href="/xss/search" class="md-nav__link">
          XSS跨站脚本攻击-反射型
        </a>
      </li>
      <li class="md-nav__item md-nav__item--nested <?php echo $message;?>">
        <a href="/xss/message" class="md-nav__link">
          XSS跨站脚本攻击-存储型
        </a>
      </li>
	  <li class="md-nav__item md-nav__item--nested <?php echo $dom;?>">
		<a href="/xss/dom" class="md-nav__link">
		  XSS跨站脚本攻击-Dom型
		</a>
	  </li>
    </ul>
    </nav>
    <li class="md-nav__item md-nav__item--nested">
      <input class="md-nav__toggle md-toggle" data-md-toggle="nav-3" type="checkbox" id="nav-3" <?php echo $nav3;?>>
      <label class="md-nav__link" for="nav-3">
        CSRF & SSRF
        <span class="md-nav__icon md-icon"></span>
      </label>
      <nav class="md-nav" aria-label="CSRF & SSRF" data-md-level="3">
        <label class="md-nav__title" for="nav-3-1">
          <span class="md-nav__icon md-icon"></span>
          CSRF & SSRF
        </label>
        <ul class="md-nav__list" data-md-scrollfix>
          <li class="md-nav__item md-nav__item--nested <?php echo $csrf;?>">
            <a href="/csrf/index" class="md-nav__link ">
              CSRF跨站请求伪造
            </a>
          </li>
          <li class="md-nav__item md-nav__item--nested <?php echo $ssrf;?>">
            <a href="/ssrf/getphoto" class="md-nav__link">
              SSRF服务端请求伪造
            </a>
          </li>
          </ul>
          </nav>
          <li class="md-nav__item md-nav__item--nested">
            <input class="md-nav__toggle md-toggle" data-md-toggle="nav-4" type="checkbox" id="nav-4" <?php echo $nav4;?>>
            <label class="md-nav__link" for="nav-4">
              文件上传漏洞
              <span class="md-nav__icon md-icon"></span>
            </label>
            <nav class="md-nav" aria-label="文件上传漏洞" data-md-level="4">
              <label class="md-nav__title" for="nav-4-1">
                <span class="md-nav__icon md-icon"></span>
                文件上传漏洞
              </label>
              <ul class="md-nav__list" data-md-scrollfix>
                <li class="md-nav__item md-nav__item--nested <?php echo $any;?>">
                  <a href="/upload/any" class="md-nav__link ">
                    任意文件上传
                  </a>
                </li>
                <li class="md-nav__item md-nav__item--nested <?php echo $img;?>">
                  <a href="/upload/img" class="md-nav__link ">
                    Content-Type 检测上传
                  </a>
                </li>
                <li class="md-nav__item md-nav__item--nested <?php echo $js;?>">
                  <a href="/upload/js" class="md-nav__link ">
                    JavaScript 检测上传
                  </a>
                </li>
				</ul>
				</nav>
			<li class="md-nav__item md-nav__item--nested">
            <input class="md-nav__toggle md-toggle" data-md-toggle="nav-5" type="checkbox" id="nav-5" <?php echo $nav5;?>>
            <label class="md-nav__link" for="nav-5">
              反序列化漏洞
              <span class="md-nav__icon md-icon"></span>
            </label>
            <nav class="md-nav" aria-label="反序列化漏洞" data-md-level="5">
              <label class="md-nav__title" for="nav-5-1">
                <span class="md-nav__icon md-icon"></span>
                反序列化漏洞
              </label>
              <ul class="md-nav__list" data-md-scrollfix>
                <li class="md-nav__item md-nav__item--nested <?php echo $f;?>">
                  <a href="/func/index" class="md-nav__link ">
                    方法构造
                  </a>
                </li>
                <li class="md-nav__item md-nav__item--nested <?php echo $w;?>">
                  <a href="/write/index" class="md-nav__link ">
                    写入文件
                  </a>
                </li>
				</ul>
				</nav>
			<li class="md-nav__item md-nav__item--nested">
            <input class="md-nav__toggle md-toggle" data-md-toggle="nav-6" type="checkbox" id="nav-6" <?php echo $nav6;?> >
            <label class="md-nav__link" for="nav-6">
              其他漏洞
              <span class="md-nav__icon md-icon"></span>
            </label>
            <nav class="md-nav" aria-label="其他漏洞" data-md-level="6">
              <label class="md-nav__title" for="nav-6-1">
                <span class="md-nav__icon md-icon"></span>
                其他漏洞
              </label>
              <ul class="md-nav__list" data-md-scrollfix>
                <li class="md-nav__item md-nav__item--nested <?php echo $inc;?>">
					<a href="/include/index" class="md-nav__link ">
					文件包含漏洞
					</a>
                </li>
                <li class="md-nav__item md-nav__item--nested <?php echo $d;?>">
					<a href="/eval/index" class="md-nav__link ">
					代码执行漏洞
					</a>
                </li>
				<li class="md-nav__item md-nav__item--nested <?php echo $ml;?>">
					<a href="/cmd/index" class="md-nav__link ">
					命令执行漏洞
					</a>
				</li>
				<li class="md-nav__item md-nav__item--nested <?php echo $hui;?>">
					<a href="/cookie/index" class="md-nav__link ">
					会话认证漏洞
					</a>
				</li>
				<li class="md-nav__item md-nav__item--nested <?php echo $lj;?>">
					<a href="/logic/index" class="md-nav__link ">
					逻辑漏洞
					</a>
				</li>
				</ul>
				</nav>
</ul>
</nav>
</div>
</div>
</div>


<div class="md-sidebar md-sidebar--secondary" data-md-component="toc">
<div class="md-sidebar__scrollwrap">
<div class="md-sidebar__inner">
                    

</div>
</div>
</div>
<div class="md-content" >
<article class="md-content__inner md-typeset">