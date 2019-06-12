<?php
/**
 * Template Name: comment
 */
?>

<?php get_header(); ?>
    <div id="container">
        <article>
            <?php
            if(have_posts()) :
                while(have_posts()) :
                    global $post;
                    the_post(); ?>
                    <div id="single-cover" style="background-image:url(<?php echo get_template_directory_uri().'/image/single-cover.jpg'; ?>);">
                        <div id="single-top">
                            <h2 id="single-title"><?php the_title(); ?></h2>
                            <div id="single-info">
                                <div id="avatar">
                                    <?php echo get_avatar(get_the_author_meta('user_email')); ?>
                                </div>
                                <div id="author">
                                    <?php the_author_posts_link(); ?>
                                </div>
                                <?php $post->post_author.the_category(' · '); ?>
                                <span style="margin-left: 10px;"><?php the_time('Y-m-d'); ?></span>
                            </div>
                        </div>
                    </div>
                    <div id="single-content">
                        <div id="single-entry">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile;
            endif;
            ?>
        </article>
        <?php comments_template(); ?>
    </div>
<?php get_footer(); ?>