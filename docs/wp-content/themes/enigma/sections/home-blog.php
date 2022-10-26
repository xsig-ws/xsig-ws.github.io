<div class="enigma_blog_area ">
    <?php 
    $blog_title1 = get_theme_mod('blog_title', __('Latest News','enigma'));
    if ( ! empty ( $blog_title1 ) ) { ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="enigma_heading_title">
                        <h3><?php echo esc_html( $blog_title1); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container">
        <div id="enigma_blog_section">
            <?php 
            $posts_count = wp_count_posts()->publish;
           
           $blog_category = get_theme_mod('blog_category', '1');
            if ($blog_category) {
                $category = get_theme_mod('blog_category', '1');
                $args = array('post_type' => 'post', 'posts_per_page' => $posts_count, 'ignore_sticky_posts' => 1, 'cat' => $category);
            } else {
                $args = array('post_type' => 'post', 'posts_per_page' => $posts_count, 'ignore_sticky_posts' => 1);
            }
            
            $post_type_data = new WP_Query($args);
            if($post_type_data->have_posts()){
                while ($post_type_data->have_posts()):
                    $post_type_data->the_post();
                    ?>
                    <div class="col-md-4 col-sm-12 scrollimation scale-in d2 pull-left">
                        <div class="enigma_blog_thumb_wrapper">
                            <div class="enigma_blog_thumb_wrapper_showcase">
                                <?php $img = array('class' => 'enigma_img_responsive');
                                if (has_post_thumbnail()):
                                    the_post_thumbnail('enigma_home_post_thumb', $img);
                                endif; ?>
                                <div class="enigma_blog_thumb_wrapper_showcase_overlay">
                                    <div class="enigma_blog_thumb_wrapper_showcase_overlay_inner ">
                                        <div class="enigma_blog_thumb_wrapper_showcase_icons">
                                            <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if (get_the_tag_list() != '') { ?>
                                <p class="enigma_tags"><?php the_tags('Tags :&nbsp;', '', '<br />'); ?></p>
                            <?php } ?>
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="enigma_blog_read_btn"><i class="fa fa-plus-circle"></i>
                                <?php 
                                $read_more = get_theme_mod('read_more', __('Read More','enigma'));
                                if (!empty ($read_more)) {
                                    echo esc_html($read_more );
                                } ?>
                            </a>
                            <div class="enigma_blog_thumb_footer">
                                <ul class="enigma_blog_thumb_date">
                                    <li><i class="fa fa-user"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                    </li>
                                    <li><i class="fas fa-clock"></i>
                                        <?php the_date(); ?>
                                    </li>
                                    <li>
                                        <i class="fas fa-comments"></i><?php comments_popup_link('0', '1', '%', '', '-'); ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endwhile; 
            } ?>
        </div>
        <div class="enigma_carousel-navi">
            <div id="port-next" class="enigma_carousel-prev"><i class="fa fa-arrow-left"></i></div>
            <div id="port-prev" class="enigma_carousel-next"><i class="fa fa-arrow-right"></i></div>
        </div>
    </div>
</div>