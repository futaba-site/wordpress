<!DOCTYPE html>
<html>
<head>
    <?php echo get_page_title(); ?>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset');?>" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <?php wp_head(); ?>
</head>
<body>
<header>
    <h1 id="header-title">
        <a href="<?php bloginfo('url'); ?>">
            <div id="blog-title-1">双葉の</div><div id="blog-title-2">魔法笔记</div>
        </a>
    </h1>
    <div id="header-nav">
        <ul>
            <li>
                <a href="<?php bloginfo('url'); ?>">
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-home"></use>
                    </svg><span>首页</span>
                </a>
            </li>
            <li>
                <a href="<?php echo bloginfo('url').'/archive/' ?>">
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-folder-open"></use>
                    </svg><span>归档</span>
                </a>
            </li>
            <li>
                <a href="<?php echo bloginfo('url').'/comment/' ?>">
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-edit-square"></use>
                    </svg><span>留言板</span>
                </a>
            </li>
            <li>
                <a href="<?php echo bloginfo('url').'/about/'; ?>">
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-setting"></use>
                    </svg><span>关于</span>
                </a>
            </li>
        </ul>
    </div>
    <div id="header-options">
        <a>
            <svg class="icon svg-icon" aria-hidden="true">
                <use xlink:href="#icon-search"></use>
            </svg>
        </a>
        <a href="<?php echo bloginfo('url').'/login/'; ?>">
            <svg class="icon svg-icon" aria-hidden="true">
                <use xlink:href="#icon-user"></use>
            </svg>
        </a>
    </div>
    <div id="header-scrollbar"></div>
</header>
<div id="right-scrollbar" class="tr-s" style="background-image:url(<?php echo get_template_directory_uri().'/image/scroll.png';?>)"></div>