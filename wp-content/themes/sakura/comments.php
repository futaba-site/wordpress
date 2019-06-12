<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https:www.sometimesnaive.com.cn
 *
 * @package Crown
 * @subpackage Sakura
 * @since 1.0.0
 */

/*
 * 拒绝直接访问该文件
*/

if(isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Do not load this page directly!');

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}

?>
<div id="comments">
    <h2 id="comments-title">Comments | <span>评论区</span></h2>
    <div id="comments-content">
    <?php
    /*
     * 评论权限未打开
     * */
    if(!comments_open()) {
        ?>
    <p>评论区未打开</p>
    <?php
    /*
     * 评论权限已打开
     * */
    } else {
        /*
         * 没有评论
         * */
        if(!have_comments()) { ?>
            <p>暂时没有评论</p>
        <?php
        /*
         * 评论系统
         * */
        } else { ?>
            <div id="comments-list">
                <?php wp_list_comments(array(
                        'style'     => 'ul',
                        'type'      => 'comment',
                        'callback'  => 'aurelius_comment'
                )); ?>
            </div>
            <?php
        } //else
        ?>
        <form id="comments-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
            <div style="margin:10px 0;"><a class="comment-reply-cancel" href="javascript:;">取消</a></div>
            <textarea name="comment"></textarea>
            <div id="input-group">
                <div id="comments-input-avatar">
                    <img src="https://secure.gravatar.com/avatar/" />
                </div>
                <input id="qqId" type="text" placeholder="QQ号（*必须）" />
                <input id="qqName" name="author" type="text" placeholder="昵称（*必须）" />
                <input id="qqEmail" name="email" type="hidden" />
            </div>
            <?php comment_id_fields(); ?>
            <span>*QQ号仅用于方便拉取头像和昵称，不会做多余的事情哦。</span>
            <button id="comments-submit">自由民主和谐富强地发表言论</button>
        </form>
        <?php
    } //else
    ?>
    </div>
</div>