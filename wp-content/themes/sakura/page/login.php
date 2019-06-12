<?php
/**
 * Template Name: login
 */

if(is_user_logged_in()) {
    echo '<script type=\'text/javascript\'>window.location="'.admin_url().'"</script>';
    exit;
} else {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = htmlentities($_POST['user']);
        $password = htmlentities($_POST['password']);
        $remember = htmlentities($_POST['remember']);
        if($remember == '1')
            $remember = true;
        else
            $remember = false;

        $creds = array(
                'user_login'    => $user,
                'user_password' => $password,
                'remember'      => $remember
        );

        $user = wp_signon($creds);
        if(is_wp_error($user)) {
            echo json_encode(array(
                    'error'      => '登录失败',
                    'error_info' => $user->get_error_message
            ),JSON_UNESCAPED_UNICODE);
            exit;
        } else {
            echo json_encode(array(
                    'success' => '登录成功'
            ),JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else { ?>

        <!DOCTYPE html>
        <html>
        <head>
            <?php echo get_page_title(); ?>
            <?php wp_head(); ?>
        </head>
        <body>
        <div id="webMSG"></div>
        <div id="login">
            <div id="login-form">
                <a id="login-logo" href="<?php echo get_bloginfo('url'); ?>">
                    <img src="<?php echo get_bloginfo('template_directory').'/image/login-logo.png';?>" />
                </a>
                <form>
                    <div class="login-input-element">
                        <input type="text" name="user" id="user" />
                        <div class="login-input-placeholder"><span>用户名/邮箱</span></div>
                    </div>
                    <div class="login-input-element">
                        <input type="password" name="password" id="password" />
                        <div class="login-input-placeholder"><span>密码</span></div>
                    </div>
                    <div class="login-input-element" style="margin-bottom: 15px;">
                        <div class="login-radio" data-value="0">
                            <span class="login-radio-circle"></span>
                            <span class="login-radio-label">I'm not a robot</span>
                            <input type="hidden" class="login-radio-input" id="robot-click" value="0" />
                        </div>
                    </div>
                    <div class="login-input-element" style="margin-bottom: 15px;">
                        <div class="login-radio" data-value="0">
                            <span class="login-radio-circle"></span>
                            <span class="login-radio-label">remember me</span>
                            <input type="hidden" class="login-radio-input" name="remember" id="remember" />
                        </div>
                    </div>
                    <button id="login-submit">登录</button>
                </form>
                <div id="login-return">
                    <a href="<?php echo get_bloginfo('url'); ?>">← 返回到<span class="main-color"><?php echo get_bloginfo('name'); ?></span></a>
                </div>
            </div>
        </div>
        </body>
        </html>

<?php
    }
}
?>