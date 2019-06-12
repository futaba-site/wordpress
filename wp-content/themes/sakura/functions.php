<?php

/**
 * 加载脚本
 */
function wp_add_scripts() {
    /**
     * lib脚本加载
     */
    /**
     * jQuery
     */
    wp_enqueue_script('jquery');

    /**
     * iconfont.js
     */
    wp_enqueue_script('iconfont_js', get_bloginfo('template_directory').'/lib/js/iconfont.js');

    /**
     * webMSG.js
     */
    wp_enqueue_script('webMSG_js', get_bloginfo('template_directory').'/lib/js/webMSG.js');

//    wp_enqueue_script('lazyload_js', get_bloginfo('template_directory').'/lib/js/jquery.lazyload.min.js');
    /**
     * animate.css
     */
    wp_enqueue_style('animate_css', get_bloginfo('template_directory').'/lib/css/animate.min.css');
    /**
     * 有字库字体
     */
    wp_enqueue_script('youziku_js', 'https://cdn.webfont.youziku.com/wwwroot/js/wf/youziku.api.min.js');

    /**
     * 自定义脚本
     */

    /**
     * 基础脚本
     */
    wp_enqueue_script('base_js', get_bloginfo('template_directory').'/js/base.js');

    if(is_home() || is_front_page()) {
        /**
         * 主页脚本
         */
        wp_enqueue_script('index_js', get_bloginfo('template_directory').'/js/index.js');
    }
    if(is_single()) {
        /**
         * 文章页脚本
         */
        wp_enqueue_style('highlight_css', get_bloginfo('template_directory').'/lib/css/default.min.css');
        wp_enqueue_style('androidstudio_css', get_bloginfo('template_directory').'/lib/css/androidstudio.css');
        wp_enqueue_script('highlight_js', get_bloginfo('template_directory').'/lib/js/highlight.min.js');
        wp_enqueue_script('single_js', get_bloginfo('template_directory').'/js/single.js');
    }
    if(is_page('登录')) {
        wp_enqueue_script('login_js', get_bloginfo('template_directory').'/js/login.js');
    }
    wp_enqueue_style('animate_diy_css', get_bloginfo('template_directory').'/css/animate.diy.css');
    wp_enqueue_style('style_less_css', get_bloginfo('template_directory').'/css/style.min.css');
}
add_action('wp_enqueue_scripts', 'wp_add_scripts');

/**
 * 开启特色图片
 */
add_theme_support('post-thumbnails');

/**
 * 过滤文章简介结尾的more
 */
function new_excerpt_more(){
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * 关闭非管理页的顶端管理条
 */
add_filter('show_admin_bar', '__return_false');

/**
 * 移除head版本号
 */
remove_action('wp_head', 'wp_generator');

/**
 * 移除离线编辑器开放接口
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/**
 * 移除embeds
 */
function disable_embeds_init() {
    global $wp;
    // Remove the embed query var.
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(
        'embed',
    ) );
    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    // Turn off
    add_filter( 'embed_oembed_discover', '__return_false' );
    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    // Remove all embeds rewrite rules.
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
}
add_action( 'init', 'disable_embeds_init', 9999 );
/**
 * Removes the 'wpembed' TinyMCE plugin.
 *
 * @since 1.0.0
 *
 * @param array $plugins List of TinyMCE plugins.
 * @return array The modified list.
 */
function disable_embeds_tiny_mce_plugin( $plugins ) {
    return array_diff( $plugins, array( 'wpembed' ) );
}
/**
 * Remove all rewrite rules related to embeds.
 *
 * @since 1.2.0
 *
 * @param array $rules WordPress rewrite rules.
 * @return array Rewrite rules without embeds rules.
 */
function disable_embeds_rewrites( $rules ) {
    foreach ( $rules as $rule => $rewrite ) {
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {
            unset( $rules[ $rule ] );
        }
    }
    return $rules;
}
/**
 * Remove embeds rewrite rules on plugin activation.
 *
 * @since 1.2.0
 */
function disable_embeds_remove_rewrite_rules() {
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );

/**
 * Flush rewrite rules on plugin deactivation.
 *
 * @since 1.2.0
 */
function disable_embeds_flush_rewrite_rules() {
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );

/**
 * 移除dns预加载
 */
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

/**
 * 移除emoji
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * 移除wp-json
 */
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

/**
 * 移除feed
 */
remove_action( 'wp_head', 'feed_links', 2 );//文章和评论feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //分类等feed

/**
 * 移除shortlink
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);

/**
 * 移除 WordPress 加载的 JS 和 CSS 链接中的版本号。
 */
function wpdaxue_remove_cssjs_ver($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'wpdaxue_remove_cssjs_ver', 999);
add_filter('script_loader_src', 'wpdaxue_remove_cssjs_ver', 999);


/**
 * 标题<title></title>优化
 */
function get_page_title() {
    if(is_home() || is_front_page()) {
        return '<title>'.get_bloginfo('name').' | '.get_bloginfo('description').'</title>';
    } else if(is_single() || is_page()) {
        return '<title>'.trim(wp_title('', false)).' | '.get_bloginfo('name').'</title>';
    } else if(is_category()) {
        return '<title>'.single_cat_title().' | '.get_bloginfo('name').'</title>';
    } else {
        return '<title>'.get_bloginfo('name').'</title>';
    }
}



/**
 * 评论列表拉取
 */
function aurelius_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    global $post;
    ?>
    <li class="comment" data-id="<?php echo $comment->comment_ID; ?>" data-depth="<?php echo $depth ?>">
        <div class="comment-author">
            <div class="comment-avatar">
                <?php if(function_exists('get_avatar') && get_option('show_avatars')) {
                    echo get_qq_or_gravatar($comment);
                } ?>
                <?php //comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
            <div class="comment-info">
                <div class="comment-author-name">
                    <cite><?php echo $comment->comment_author; ?></cite>
                    <?php if($comment->user_id == $post->post_author) { ?>
                        <span class="comment-owner">博主</span>
                    <?php } ?>
                </div>
                <div class="comment-time">发表于：<?php echo get_comment_time('Y-m-d H:i'); ?></div>
            </div>
            <?php if($depth <= $args['max_depth']){ ?>
                <a class="comment-reply-bottom tr" href="javascript:;" data-id="<?php echo $comment->comment_ID; ?>">回复</a>
            <?php } ?>
        </div>
        <div class="comment-text">
            <?php comment_text(); ?>
        </div>
    </li>

<?php
}


/**
 * 区分QQ头像或者gravatar头像
 */
function get_qq_or_gravatar($comment) {
    $email = get_comment_author_email($comment);
    if(preg_replace('/.*?@(..).*/', '\1', $email) == 'qq') {
        $json = file_get_contents('https://api.sometimesnaive.com.cn/qqInfo.php?id='.preg_replace('/(.*?)@.*/', '\1', $email));
        $arr = json_decode($json, true);
        if($arr['url']) {
            return '<img src="'.$arr['url'].'" />';
        }
    }
    return get_avatar($email);
}

/**
 * 在 feed 中输出文章特色图像
 */

function rss_post_thumbnail($content) {
    global $post;
    if(has_post_thumbnail($post->ID)) {
        $output = get_avatar($post->post_author).get_the_post_thumbnail($post->ID);
        $content = $output.$content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail')

?>