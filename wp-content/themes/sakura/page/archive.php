<?php
/**
 * Template Name: archive
 */
?>
<?php get_header(); ?>
<div id="home">
    <div id="cover">
        <div id="cover-shade"></div>
        <div id="cover-down" class="upAndDown infinite animated slow"><svg class="icon svg-icon" aria-hidden="true"><use xlink:href="#icon-icon_down"></use></svg></div>
        <div id="cover-wave-1" data-move="left"></div>
        <div id="cover-wave-2" data-move="right"></div>
        <div id="cover-master">
            <div id="cover-master-avatar"><?php echo get_avatar(get_bloginfo('admin_email')); ?></div>
            <div id="cover-hitokoto">
                <div id="text">
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-baojiaquotation2"></use>
                    </svg>
                    <span id="hitokoto"></span>
                    <svg class="icon svg-icon" aria-hidden="true">
                        <use xlink:href="#icon-baojiaquotation"></use>
                    </svg>
                </div>
                <div id="from"><span id="hitokoto-from"></span></div>
            </div>
        </div>
    </div>
    <div class="section">
        <h2 class="section-title">POSTS</h2>
        <div class="post-list">
            <?php if(have_posts()) : ?>
            <?php while(have_posts()) : the_post(); ?>
                <div class="post">
                    <div class="post-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php the_post_thumbnail_url(); ?>" />
                        </a>
                    </div><div class="post-content">
                        <p class="post-time"><svg class="icon svg-icon" aria-hidden="true">
                                <use xlink:href="#icon-time-circle"></use>
                            </svg><?php the_time('Y-m-d') ?></p>
                        <h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-categories"><svg class="icon svg-icon" aria-hidden="true">
                                <use xlink:href="#icon-folder-open"></use>
                            </svg><?php the_category(' · '); ?></div>
                        <div class="post-entry">
                            <?php the_excerpt(); ?>
                            <div class="post-more">
                                <a href="<?php the_permalink(); ?>">
                                    <svg class="icon svg-icon" aria-hidden="true"><use xlink:href="#icon-ellipsis"></use></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div id="pagination"><?php next_posts_link(__('LOAD MORE')); ?></div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>


