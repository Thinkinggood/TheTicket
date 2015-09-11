<?php

/**
 * This file is used to display your front page.
 * @package Podcaster
 * @since 1.0
 * @author Theme Station : http://www.themestation.net
 * @copyright Copyright (c) 2014, Theme Station
 * @link http://www.themestation.net
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/*
Template Name: Front Page
*/

get_header(); ?>

    <?php

    if ( have_posts() ) : while ( have_posts() ) : the_post();

    $attachment_id = get_post_thumbnail_id( $post->ID );
    $image_attributes = wp_get_attachment_image_src( $attachment_id, 'original' ); // returns an array
    $thumb_back = $image_attributes[0];

    //Header Settings
    $subtitle_blurb = get_post_meta($post->ID, 'cmb_thst_page_subtitle', true);
    $bg_style = get_post_meta($post->ID, 'cmb_thst_page_header_bg_style', true);
    $bg_parallax = get_post_meta($post->ID, 'cmb_thst_page_header_parallax', true);
    $heading_align = get_post_meta($post->ID, 'cmb_thst_page_header_align', true);

    //For the custom loop
    $options = get_option('podcaster-theme');
    $arch_category = isset( $options['pod-recordings-category'] ) ? $options['pod-recordings-category'] : '';
    $pod_front_num_posts = isset( $options['pod-front-posts'] ) ? $options['pod-front-posts'] : '';
    $pod_archive_link = isset( $options['pod-archive-link'] ) ? $options['pod-archive-link'] : '';
    $pod_archive_link_txt = isset( $options['pod-archive-link-txt'] ) ? $options['pod-archive-link-txt'] : '';

    /* Featured Post */
    $pod_featured_heading = isset( $options['pod-featured-heading'] ) ? $options['pod-featured-heading'] : '';
    $pod_preview_heading = isset( $options['pod-preview-heading'] ) ? $options['pod-preview-heading'] : '';
    $pod_preview_title = isset( $options['pod-preview-title'] ) ? $options['pod-preview-title'] : '';
    $pod_page_image = isset( $options['pod-page-image'] ) ? $options['pod-page-image'] : '';

    $pod_featured_excerpt = isset( $options['pod-frontpage-fetured-ex'] ) ? $options['pod-frontpage-fetured-ex'] : '';
    $pod_excerpt_type = isset( $options['pod-excerpts-type'] ) ? $options['pod-excerpts-type'] : '';
    $arch_category = isset( $options['pod-recordings-category'] ) ? $options['pod-recordings-category'] : 1;
    $pod_front_num_posts = isset( $options['pod-front-posts'] ) ? $options['pod-front-posts'] : '';

    /* Scheduled posts */
    $pod_scheduled_posts = isset( $options['pod-scheduling'] ) ? $options['pod-scheduling'] :'';

    /* Subscribe Buttons */
    $pod_butn_one = isset( $options['pod-subscribe1'] ) ? $options['pod-subscribe1'] : '';
    $pod_butn_one_url  = isset( $options['pod-subscribe1-url'] ) ? $options['pod-subscribe1-url'] : '';
    $pod_butn_two = isset( $options['pod-subscribe2'] ) ? $options['pod-subscribe2'] : '';
    $pod_butn_two_url  = isset( $options['pod-subscribe2-url'] ) ? $options['pod-subscribe2-url'] : '';
    $pod_fontpage_header = isset( $options['pod-fontpage-header'] ) ? $options['pod-fontpage-header'] : '';


    $pod_display_excerpt = isset( $options['pod-display-excerpts'] ) ? $options['pod-display-excerpts'] : '';
    $pod_excerpts_style  = isset( $options['pod-excerpts-style'] ) ? $options['pod-excerpts-style'] : '';
    $pod_sticky_header = isset( $options['pod-sticky-header'] ) ? $options['pod-sticky-header'] : '';
    if( $pod_sticky_header == true ) {
        $pod_stcky_hdr = ' sticky';
    } else {
        $pod_stcky_hdr = '';
    }
    $pod_nav_bg = isset( $options['pod-nav-bg'] ) ? $options['pod-nav-bg'] : '';
    if( $pod_nav_bg == 'transparent') {
        $pod_nav_bg_state = ' transparent sticky';
    } else {
        $pod_nav_bg_state = '';
    }

    $pod_frontpage_header  = isset( $options['pod-upload-frontpage-header'] ) ? $options['pod-upload-frontpage-header'] : '';
    $pod_frontpage_header_url = isset( $pod_frontpage_header['url'] ) ? $pod_frontpage_header['url'] : '';
    $pod_frontpage_bg_style = isset( $options['pod-frontpage-bg-style'] ) ? $options['pod-frontpage-bg-style'] : '';
    $pod_frontpage_header_par = isset( $options['pod-frontpage-header-par'] ) ? $options['pod-frontpage-header-par'] : '';
    if($pod_frontpage_header_par == TRUE){
            $parallax = 'data-stellar-background-ratio="0.5"';
        } else {
            $parallax = '';
    }

    $pod_nextweek = isset( $options['pod-frontpage-nextweek'] ) ? $options['pod-frontpage-nextweek'] : '';

    /* Avatar Settings*/
    $pod_avtr_frnt = isset( $options['pod-avatar-front'] ) ? $options['pod-avatar-front'] : '';
    $show_avtrs = get_option('show_avatars');

    $plugin_inuse = get_pod_plugin_active();
    ?>

    <?php if ( $pod_frontpage_header_url != '' && $pod_page_image == false ) { ?>
        <div <?php echo $parallax; ?> class="latest-episode front-header <?php echo $pod_nav_bg_state; ?> <?php echo $pod_stcky_hdr; ?>" style="background-image: url('<?php echo $pod_frontpage_header_url; ?>'); <?php if(isset($pod_frontpage_bg_style)) echo $pod_frontpage_bg_style; ?> background-position:center;">
    <?php } elseif( $pod_page_image == true && $thumb_back != '' ) { ?>
        <div <?php echo $parallax; ?> class="latest-episode front-header <?php echo $pod_nav_bg_state; ?> <?php echo $pod_stcky_hdr; ?>" style="background-image: url('<?php echo $thumb_back; ?>'); <?php if(isset($pod_frontpage_bg_style)) echo $pod_frontpage_bg_style; ?> background-position:center;">
    <?php } else { ?>
        <div class="latest-episode <?php echo $pod_stcky_hdr; ?>">
    <?php } ?>
            <div id="loading_bg"></div>
            <?php if ( $pod_frontpage_header_url != '' || ( $pod_page_image == true && $thumb_back != '' ) ) { ?>
                <div class="translucent">
            <?php } ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-featured-post clearfix">
                                <span class="mini-title">
                                    <?php if( isset( $options['pod-featured-heading'] ) ) {
                                        if ( $pod_featured_heading != '' ) {
                                            echo $pod_featured_heading;
                                        } else {
                                            echo __( 'Featured Episode', 'thstlang' );
                                        }
                                    } else {
                                        echo __( 'Featured Episode', 'thstlang' );
                                    } ?>
                                </span>

                                <!--Post starts here -->
                                <?php if( $plugin_inuse == 'ssp' ) { ?>
                                    <?php $args = array(
                                        'post_type' => 'podcast',
                                        'posts_per_page' => 1,
                                        'paged' => get_query_var( 'paged' ),
                                        'ignore_sticky_posts' => true
                                    );
                                    $category_posts = new WP_Query($args);

                                    if( $category_posts->have_posts() ) {
                                        while( $category_posts->have_posts() ) {
                                            $category_posts->the_post();

                                            global $ss_podcasting, $wp_query;
                                            $id = get_the_ID();
                                            $file = get_post_meta( $id , 'enclosure' , true );
                                            $terms = wp_get_post_terms( $id , 'series' );
                                            foreach( $terms as $term ) {
                                                $series_id = $term->term_id;
                                                $series = $term->name;
                                                break;
                                            }
                                            $ep_explicit = get_post_meta( get_the_ID() , 'explicit' , true );
                                            $ep_explicit && $ep_explicit == 'on' ? $explicit_flag = 'Yes' : $explicit_flag = 'No';
                                            ?>
                                            <?php if( $explicit_flag == 'Yes' ) { ?>
                                                <span class="mini-ex"><?php echo __('Explicit', 'thstlang'); ?></span>
                                            <?php } ?>
                                            <a href="<?php echo get_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>
                                            <div class="audio">
                                                <?php if( $file != '' ) { ?>
                                                <div class="audio_player"><?php echo do_shortcode('[audio src="' . $file . '"][/audio]'); ?></div><!--audio_player-->
                                                <?php } ?>
                                            </div><!-- .audio -->
                                            <?php if ( $pod_featured_excerpt == true ) { ?>
                                                <div class="featured-excerpt <?php echo $post_format; ?>">
                                                <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                    <?php echo get_the_excerpt(); ?>
                                                    <a href="<?php echo get_permalink(); ?>" class="more-link">
                                                        <?php echo __( ' Read More', 'thstlang'); ?>
                                                        <span class="meta-nav"></span>
                                                    </a>
                                                <?php } else {
                                                    global $more;
                                                    $more = 0; ?>
                                                    <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                                <?php } ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php wp_reset_query(); ?>

                                <?php } elseif( $plugin_inuse == 'bpp' ) { ?>
                                    <?php if( isset( $arch_category ) ) {
                                        $args = array( 'cat' => $arch_category, 'posts_per_page' => 1, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                    } else {
                                        $args = array( 'posts_per_page' => 1, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                    }
                                    $category_posts = new WP_Query($args);
                                    if( $category_posts->have_posts()) {
                                        while($category_posts->have_posts()) {
                                            $category_posts->the_post();

                                            /* PowerPress Files*/
                                            $pp_audio_str = get_post_meta( $post->ID, 'enclosure', true );
                                            $pp_audiourl = strtok($pp_audio_str, "\n");
                                            $post_format = get_post_format(); ?>
                                            <a href="<?php echo get_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>

                                            <?php if( $pp_audiourl != '') { ?>
                                                <?php echo the_powerpress_content(); ?>
                                            <?php } ?>

                                            <?php if ( $pod_featured_excerpt == true ) { ?>
                                                <div class="featured-excerpt <?php echo $post_format; ?>">
                                                    <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                        <?php echo get_the_excerpt(); ?><a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo __( ' Read More', 'thstlang'); ?><span class="meta-nav"></span></a>
                                                    <?php } else {
                                                        global $more;
                                                        $more = 0; ?>
                                                        <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php wp_reset_query(); ?>

                                <?php } else { ?>
                                    <?php if( isset( $arch_category ) ) {
                                        $args = array( 'cat' => $arch_category, 'posts_per_page' => 1, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                    } else {
                                        $args = array( 'posts_per_page' => 1, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                    }

                                    $category_posts = new WP_Query($args);
                                    if($category_posts->have_posts()) {
                                        while($category_posts->have_posts()) {
                                            $category_posts->the_post();

                                        //For the audio player
                                        $audiourl = get_post_meta( $post->ID, 'cmb_thst_audio_url', true );
                                        $audioembed = get_post_meta( $post->ID, 'cmb_thst_audio_embed', true );
                                        $audioembedcode = get_post_meta( $post->ID, 'cmb_thst_audio_embed_code', true );
                                        $audiocapt = get_post_meta( $post->ID, 'cmb_thst_audio_capt', true );
                                        $audioplists = get_post_meta( $post->ID, 'cmb_thst_audio_playlist', true );
                                        $au_uploadcode = wp_audio_shortcode( $audiourl );

                                        $videoembed = get_post_meta( $post->ID, 'cmb_thst_video_embed', true );
                                        $videoembedcode = get_post_meta( $post->ID, 'cmb_thst_video_embed_code', true );
                                        $videourl = get_post_meta( $post->ID, 'cmb_thst_video_url', true );
                                        $videocapt = get_post_meta($post->ID, 'cmb_thst_video_capt', true);
                                        $videoplists = get_post_meta( $post->ID, 'cmb_thst_video_playlist', true );
                                        $videothumb = get_post_meta($post->ID, 'cmb_thst_video_thumb',true);

                                        $audioex = get_post_meta( $post->ID, 'cmb_thst_audio_explicit', true );
                                        $videoex = get_post_meta( $post->ID, 'cmb_thst_video_explicit', true );

                                        $post_format = get_post_format();
                                        ?>
                                        <?php if( $audioex == 'on' || $videoex == 'on' ) { ?>
                                            <span class="mini-ex"><?php echo __('Explicit', 'thstlang'); ?></span>
                                        <?php } ?>

                                        <a href="<?php echo get_permalink(); ?>"><h2><?php echo get_the_title(); ?></h2></a>

                                        <?php if ( $post_format == 'audio' ) {
                                            if($audioembed != '') {
                                                $au_embedcode = wp_oembed_get( $audioembed );
                                                echo '<div class="audio_player au_oembed">' . $au_embedcode . '</div><!--audio_player-->';
                                            } elseif($audiourl != '') {
                                                echo '<div class="audio_player">' . do_shortcode('[audio src="' .$audiourl. '"][/audio]') . '</div><!--audio_player-->';
                                            } elseif( is_array( $audioplists ) ) {
                                                echo do_shortcode('[playlist type="audio" ids="'.implode(',', array_keys($audioplists)).'"][/playlist]');
                                            } elseif ( $audioembedcode != '') {
                                                echo '<div class="audio_player embed_code">' . $audioembedcode . '</div><!--audio_player-->';
                                            }
                                        } elseif ( $post_format == 'video') {
                                            global $more;
                                            $more = 0;
                                            ?>
                                            <div class="row">
                                            <?php if( $videoembed != '' ) {
                                                echo '<div class="col-lg-6"><div class="video_player">' .  wp_oembed_get($videoembed) . '</div><!-- .col --></div><!--video_player-->';
                                                if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                } else {
                                                echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                }
                                            } elseif( $videourl != '' ){
                                                echo '<div class="col-lg-6"><div class="video_player">' . do_shortcode('[video poster="' .$videothumb. '" src="' .$videourl. '"][/video]') .'</div><!-- .col --></div><!--video_player-->';
                                                if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                } else {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                }
                                            } elseif( is_array( $videoplists ) ) {
                                                echo '<div class="col-lg-6"><div class="video_player">' . do_shortcode('[playlist type="video" ids="'.implode(',', array_keys($videoplists)).'"][/playlist]') .'</div><!-- .col --></div><!--video_player-->';
                                                if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                } else {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                }
                                            } elseif ( $videoembedcode != '') {
                                                echo '<div class="col-lg-6"><div class="video_player">' . $videoembedcode .'</div><!-- .col --></div><!--video_player-->';
                                                if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                } else {
                                                    echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                }
                                            } ?>
                                            </div><!-- .row -->
                                        <?php } ?>

                                        <?php if ( $pod_featured_excerpt == true ) { ?>
                                            <div class="featured-excerpt <?php echo $post_format; ?>">
                                                <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                    <?php echo get_the_excerpt(); ?>
                                                    <a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo __( ' Read More', 'thstlang'); ?><span class="meta-nav"></span></a>
                                            <?php } else {
                                                global $more;
                                                $more = 0; ?>
                                                <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                            <?php } ?>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </div><!-- .main-featured-post -->
                            <?php if ( $pod_nextweek == 'show' ) { ?>

                            <div class="next-week">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <span class="mini-title">
                                            <?php if( isset( $pod_preview_title ) && $pod_preview_title != '') {
                                                echo $pod_preview_title;
                                            } else {
                                                echo __('Next Time on Podcaster', 'thstlang');
                                            } ?>
                                        </span>

                                        <?php if( $pod_scheduled_posts  == true ) { ?>
                                            <?php
                                            if ( $plugin_inuse == 'ssp' ) {
                                                $sched_args = array(
                                                    'post_type' => 'podcast',
                                                    'posts_per_page' => 15,
                                                    'ignore_sticky_posts' => true,
                                                    'post_status' => 'future',
                                                    'order' => 'ASC',
                                                );
                                            } else {
                                                $sched_args = array(
                                                    'post_type' => 'post',
                                                    'cat' => $arch_category,
                                                    'posts_per_page' => 1,
                                                    'ignore_sticky_posts' => true,
                                                    'post_status' => 'future',
                                                    'order' => 'ASC',
                                                );

                                            }
                                            $sched_q = new WP_Query($sched_args);
                                            if( !($sched_q->have_posts()) ) {
                                                echo '<p class="schedule-message">' . __('Please schedule a podcast post, to make it visible here.', 'thstlang') . '</p>';
                                            } else {

                                            while( $sched_q->have_posts() ) : $sched_q->the_post(); ?>
                                            <h3><?php the_title(); ?></h3>
                                            <?php endwhile; ?>
                                            <?php wp_reset_query(); ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                        <h3>
                                            <?php if( isset ( $pod_preview_heading ) && $pod_preview_heading != '') {
                                                echo $pod_preview_heading;
                                            } else {
                                                echo __('Episode 12: A Long Walk in the Forest', 'thstlang');
                                            } ?>
                                        </h3>
                                        <?php } ?>
                                    </div><!-- .col -->
                                    <div class="col-lg-6 col-md-6">
                                        <div class="content">
                                            <?php if( isset( $options['pod-subscribe1'] ) ) { ?>
                                                <a href="<?php echo $pod_butn_one_url ?>" class="butn small"><?php echo $pod_butn_one ?></a>
                                            <?php } else { ?>
                                                <a href="#" class="butn small"><?php echo __('Subscribe with iTunes', 'thstlang'); ?></a>
                                            <?php } ?>
                                            <?php if( isset( $options['pod-subscribe2'] ) ) { ?>
                                                <a href="<?php echo $pod_butn_two_url ?>" class="butn small"><?php echo $pod_butn_two ?></a>
                                            <?php } else { ?>
                                                <a href="#" class="butn small"><?php echo __('Subscribe with RSS', 'thstlang'); ?></a>
                                            <?php } ?>
                                        </div><!-- .content -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .next-week -->
                            <?php } ?>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            <?php if ( $pod_frontpage_header_url != '' || ( $pod_page_image == true && $thumb_back != '' )  ) { ?>
                </div><!-- .translucent -->
            <?php } ?>
            </div><!-- .latest-episode -->
            <div class="list-of-episodes">
                <div class="container">
                    <div class="row">
                        <?php
                        /* Varialbes & Paths */
                        $active_plugin = get_pod_plugin_active();

                        /* WP_Query() for the most recent posts on the front page */
                        if( $active_plugin == 'ssp' ) {
                            $args = array( 'post_type' => 'podcast', 'posts_per_page' => $pod_front_num_posts, 'offset' => 1, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );

                            $category_posts2 = new WP_Query($args);

                            if( $category_posts2->have_posts() ) {
                                while( $category_posts2->have_posts() ) {
                                    $category_posts2->the_post();

                                    global $ss_podcasting, $wp_query;
                                    $id = get_the_ID();
                                    $terms = wp_get_post_terms( $id , 'series' );
                                    foreach( $terms as $term ) {
                                        $series_id = $term->term_id;
                                        $series = $term->name;
                                        break;
                                    }

                                    $ep_explicit = get_post_meta( get_the_ID() , 'explicit' , true );
                                    if( $ep_explicit && $ep_explicit == 'on' ) {
                                        $explicit_flag = 'Yes';
                                    } else {
                                        $explicit_flag = 'No';
                                    }
                                    $get_classes = get_post_class();
                                    $classes = implode(' ', $get_classes); ?>

                                    <article class="<?php echo $classes; ?> col-lg-12 list">
                                        <div class="featured-image">
                                            <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail($id, 'square'); ?></a>
                                            <div class="hover">
                                                <a href="<?php echo get_permalink() ?>" class="batch icon" data-icon="&#xF16b;"></a>
                                            </div><!-- .hover -->
                                        </div><!-- .featured-image -->
                                        <div class="inside">
                                            <div class="post-header">
                                                <?php if( $terms || $explicit_flag == 'Yes' ) { ?>
                                                    <ul>
                                                        <li><?php echo $series; ?></li>
                                                        <li>
                                                        <?php if( $explicit_flag == 'Yes' ) { ?>
                                                            <span class="mini-ex">
                                                                <?php echo __('Explicit', 'thstlang') ?>
                                                            </span>
                                                        <?php } ?>
                                                        </li>
                                                    </ul>
                                                <?php } ?>
                                                <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                            </div><!-- .post-header -->
                                            <div class="post-content">
                                                <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                    <?php echo get_the_excerpt(); ?><a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo __( ' Read More', 'thstlang'); ?><span class="meta-nav"></span></a>
                                                <?php } else {
                                                    global $more;
                                                    $more = 0; ?>
                                                    <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                                <?php } ?>
                                            </div>
                                            <div class="post-footer clearfix">
                                                <span class="date"><?php echo get_the_date(); ?></span>
                                            </div><!-- .post-footer -->
                                        </div><!-- .inside -->
                                    </article>
                                <?php } ?>
                            <?php } ?>
                            <?php wp_reset_query(); ?>
                        <?php } elseif( $active_plugin == 'bpp' ) {
                            global $post;
                            if ( isset( $pod_front_num_posts ) && isset($arch_category) ) {
                                $args = array( 'offset' => 1, 'cat' => $arch_category, 'posts_per_page' =>  $pod_front_num_posts, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                            } else {
                                $args = array( 'offset' => 1, 'cat' => 'uncategorized', 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true);
                            }

                            $category_posts = new WP_Query($args);
                            if( $category_posts->have_posts() ) {
                                while( $category_posts->have_posts() ) {
                                    $category_posts->the_post();

                                    $audioex = get_post_meta( $post->ID, 'cmb_thst_audio_explicit', true );
                                    $videoex = get_post_meta( $post->ID, 'cmb_thst_video_explicit', true );
                                    $get_classes = get_post_class();
                                    $classes = implode(' ', $get_classes);
                                    $categories = get_the_category(); ?>

                                    <article class="<?php echo $classes; ?> col-lg-12 list">
                                        <div class="featured-image">
                                            <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail( $post->ID, "square"); ?></a>
                                            <div class="hover">
                                                <a href="<?php echo get_permalink(); ?>" class="batch icon" data-icon="&#xF16b;"></a>
                                            </div><!-- .hover -->
                                        </div><!-- .featured-image -->
                                        <div class="inside">
                                            <div class="post-header">
                                            <?php if( has_category() ) { ?>
                                                <ul>
                                                <?php foreach( $categories as $category ) { ?>
                                                    <li>
                                                    <?php echo $category->name; ?>
                                                    </li>
                                                <?php } ?>
                                                </ul>
                                            <?php } ?>

                                            <?php if( $audioex == 'on' || $videoex == 'on' ) { ?>
                                                <ul>
                                                <li><span class="mini-ex">
                                                <?php echo __('Explicit', 'thstlang'); ?>
                                                </span></li>
                                                </ul>
                                            <?php } ?>

                                            <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                            </div><!-- .post-header -->
                                            <div class="post-content">
                                            <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                <?php echo get_the_excerpt(); ?>
                                                <a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo __( ' Read More', 'thstlang' ) ?><span class="meta-nav"></span></a>
                                            <?php } else {
                                                global $more;
                                                $more = 0; ?>
                                                <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                            <?php } ?>
                                            </div>
                                            <div class="post-footer clearfix">
                                                <span class="date"><?php echo get_the_date(); ?></span>
                                            </div><!-- .post-footer -->
                                        </div><!-- .inside -->
                                    </article>
                                <?php } ?>
                            <?php } ?>
                            <?php wp_reset_query(); ?>

                        <?php } else {
                            global $post;
                            $get_classes = get_post_class();
                            $classes = implode(' ', $get_classes);
                            $categories = get_the_category();

                            if ( isset( $pod_front_num_posts ) && isset($arch_category) ) {
                                $args = array( 'offset' => 1, 'cat' => $arch_category, 'posts_per_page' =>  $pod_front_num_posts, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                            } else {
                                $args = array( 'offset' => 1, 'cat' => 'uncategorized', 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true);
                            }

                            $category_posts = new WP_Query($args);
                            if( $category_posts->have_posts() ) {
                                while( $category_posts->have_posts() ) {
                                    $category_posts->the_post();

                                    $audioex = get_post_meta( $post->ID, 'cmb_thst_audio_explicit', true );
                                    $videoex = get_post_meta( $post->ID, 'cmb_thst_video_explicit', true );
                                    ?>
                                    <article class="<?php echo $classes; ?> col-lg-12 list">
                                        <div class="featured-image">
                                            <?php echo get_the_post_thumbnail( $post->ID, 'square' ); ?>
                                        </div><!-- .featured-image -->
                                        <div class="inside">
                                            <div class="post-header">
                                                <ul>
                                                <?php if( has_category() ) {
                                                    foreach( $categories as $category ) { ?>
                                                        <li>
                                                        <?php echo $category->name; ?>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>

                                                <?php if( $audioex == 'on' || $videoex == 'on' ) { ?>
                                                <li><span class="mini-ex">
                                                    <?php echo __('Explicit', 'thstlang'); ?>
                                                <?php echo '</span></li>' ?>
                                                <?php } ?>
                                                </ul>

                                                <h2><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                            </div><!-- .post-header -->
                                            <div class="post-content">
                                            <?php if ( $pod_excerpt_type == 'force_excerpt' || $pod_excerpt_type == '' ) { ?>
                                                <?php echo get_the_excerpt(); ?>









                                                <!-- THIS IS THE OVERRIDE -->
                                                <?php
                                                    //For the audio player
                                                    $audiourl = get_post_meta( $post->ID, 'cmb_thst_audio_url', true );
                                                    $audioembed = get_post_meta( $post->ID, 'cmb_thst_audio_embed', true );
                                                    $audioembedcode = get_post_meta( $post->ID, 'cmb_thst_audio_embed_code', true );
                                                    $audiocapt = get_post_meta( $post->ID, 'cmb_thst_audio_capt', true );
                                                    $audioplists = get_post_meta( $post->ID, 'cmb_thst_audio_playlist', true );
                                                    $au_uploadcode = wp_audio_shortcode( $audiourl );

                                                    $videoembed = get_post_meta( $post->ID, 'cmb_thst_video_embed', true );
                                                    $videoembedcode = get_post_meta( $post->ID, 'cmb_thst_video_embed_code', true );
                                                    $videourl = get_post_meta( $post->ID, 'cmb_thst_video_url', true );
                                                    $videocapt = get_post_meta($post->ID, 'cmb_thst_video_capt', true);
                                                    $videoplists = get_post_meta( $post->ID, 'cmb_thst_video_playlist', true );
                                                    $videothumb = get_post_meta($post->ID, 'cmb_thst_video_thumb',true);

                                                    $audioex = get_post_meta( $post->ID, 'cmb_thst_audio_explicit', true );
                                                    $videoex = get_post_meta( $post->ID, 'cmb_thst_video_explicit', true );

                                                    $post_format = get_post_format();
                                                ?>
                                                <?php if( $audioex == 'on' || $videoex == 'on' ) { ?>
                                                    <span class="mini-ex"><?php echo __('Explicit', 'thstlang'); ?></span>
                                                <?php } ?>

                                                <?php if ( $post_format == 'audio' ) {
                                                    if($audioembed != '') {
                                                        $au_embedcode = wp_oembed_get( $audioembed );
                                                        echo '<div class="audio_player au_oembed">' . $au_embedcode . '</div><!--audio_player-->';
                                                    } elseif($audiourl != '') {
                                                        echo '<div class="audio_player">' . do_shortcode('[audio src="' .$audiourl. '"][/audio]') . '</div><!--audio_player-->';
                                                    } elseif( is_array( $audioplists ) ) {
                                                        echo do_shortcode('[playlist type="audio" ids="'.implode(',', array_keys($audioplists)).'"][/playlist]');
                                                    } elseif ( $audioembedcode != '') {
                                                        echo '<div class="audio_player embed_code">' . $audioembedcode . '</div><!--audio_player-->';
                                                    }
                                                } elseif ( $post_format == 'video') {
                                                    global $more;
                                                    $more = 0;
                                                    ?>
                                                    <div class="row">
                                                    <?php if( $videoembed != '' ) {
                                                        echo '<div class="col-lg-6"><div class="video_player">' .  wp_oembed_get($videoembed) . '</div><!-- .col --></div><!--video_player-->';
                                                        if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                        echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                        } else {
                                                        echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                        }
                                                    } elseif( $videourl != '' ){
                                                        echo '<div class="col-lg-6"><div class="video_player">' . do_shortcode('[video poster="' .$videothumb. '" src="' .$videourl. '"][/video]') .'</div><!-- .col --></div><!--video_player-->';
                                                        if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                        } else {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                        }
                                                    } elseif( is_array( $videoplists ) ) {
                                                        echo '<div class="col-lg-6"><div class="video_player">' . do_shortcode('[playlist type="video" ids="'.implode(',', array_keys($videoplists)).'"][/playlist]') .'</div><!-- .col --></div><!--video_player-->';
                                                        if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                        } else {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                        }
                                                    } elseif ( $videoembedcode != '') {
                                                        echo '<div class="col-lg-6"><div class="video_player">' . $videoembedcode .'</div><!-- .col --></div><!--video_player-->';
                                                        if ( $pod_excerpt_type == 'force_excerpt' ) {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_excerpt('') . '</div></div>';
                                                        } else {
                                                            echo '<div class="col-lg-6"><div class="content">' . get_the_content('') . '</div></div>';
                                                        }
                                                    } ?>
                                                    </div><!-- .row -->
                                                <?php } ?>

                                                <?php if ( $pod_featured_excerpt == true ) { ?>
                                                    <div class="featured-excerpt <?php echo $post_format; ?>">
                                                        <?php if ( $pod_excerpt_type == 'force_excerpt' ) { ?>
                                                            <?php echo get_the_excerpt(); ?>
                                                            <a href="<?php echo get_permalink(); ?>" class="more-link"><?php echo __( ' Read More', 'thstlang'); ?><span class="meta-nav"></span></a>
                                                    <?php } else {
                                                        global $more;
                                                        $more = 0; ?>
                                                        <?php echo get_the_content( __(' Read More', 'thstlang') ); ?>
                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <!-- THIS IS THE OVERRIDE -->










                                            <?php } else {
                                                global $more;
                                                $more = 0; ?>
                                                <?php the_content( __(' Read More', 'thstlang') ); ?>
                                            <?php } ?>
                                            </div>
                                            <div class="post-footer clearfix">
                                                <span class="date"><?php echo get_the_date(); ?></span>
                                            </div><!-- .post-footer -->
                                        </div><!-- .inside -->
                                    </article>
                                <?php } ?>
                            <?php } ?>
                            <?php wp_reset_query(); ?>
                        <?php } ?>

                        <?php if( $pod_archive_link != '' ): ?>
                            <div class="button-container col-lg-12">
                                <a class="butn small" href="<?php echo $pod_archive_link ?>"><?php echo __($pod_archive_link_txt, 'thstlang'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div><!-- .row -->
                </div><!-- .container -->
            </div><!-- .list-of-episodes -->

        <?php if (  isset( $pod_excerpts_style ) && $pod_excerpts_style == 'columns' ) : ?>
            <div class="fromtheblog">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title"><?php echo __('From the Blog', 'thstlang') ?></h2>
                            <div class="row">

                                <?php
                                if( isset( $arch_category ) ) {
                                    $args = array( 'cat' => -$arch_category, 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true);
                                } else {
                                    $args = array( 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                }
                                //echo $arch_category;
                                $fromblog_posts = new WP_Query($args);

                                if( $fromblog_posts->have_posts() ) : while( $fromblog_posts->have_posts() ) : $fromblog_posts->the_post(); ?>
                                <article <?php post_class('col-lg-3'); ?>>
                                    <div class="featured-image">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('square'); ?></a>
                                    </div><!-- .featured-image -->
                                    <div class="inside">
                                        <div class="post-header">
                                            <?php if( has_category() ) : ?>
                                            <ul>
                                                <li><?php the_category(', </li> <li> '); ?></li>
                                            </ul>
                                            <?php endif ; ?>
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                        </div><!-- .post-header -->
                                        <div class="post-content">
                                            <?php if ( $pod_excerpt_type == 'force_excerpt' ) : ?>
                                                <?php the_excerpt(); ?>
                                            <?php else : ?>
                                                <?php global $more; $more = 0; the_content(''); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="post-footer clearfix">
                                            <a href="<?php the_permalink(); ?>"><?php echo __('Read More', 'thstlang') ?></a>
                                        </div><!-- .post-footer -->
                                    </div><!-- .inside -->
                                </article>
                                <?php endwhile; ?>
                            <?php endif; wp_reset_query(); ?>
                        </div><!-- .col-->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
             </div><!-- .fromtheblog -->
        <?php elseif( $pod_excerpts_style == 'list' || $pod_excerpts_style == ''  ) : ?>
            <div class="fromtheblog list">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="title"><?php echo __('From the Blog', 'thstlang') ?></h2>

                                <?php
                                if ( isset( $arch_category ) ) {
                                    $args = array( 'cat' => -$arch_category , 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                } else {
                                    $args = array( 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ), 'ignore_sticky_posts' => true );
                                }
                                $fromblog_posts = new WP_Query($args);

                                if( $fromblog_posts->have_posts() ) : while( $fromblog_posts->have_posts() ) : $fromblog_posts->the_post(); ?>
                                <article <?php post_class(); ?>>
                                    <div class="inside clearfix">
                                        <div class="cont post-header">
                                            <?php if( $show_avtrs == true && $pod_avtr_frnt == true ) : ?>
                                            <a class="user_img_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                            <?php
                                                $usr_avatar = get_avatar( get_the_author_meta( 'ID' ), 32 );
                                                echo $usr_avatar;
                                            ?>
                                            </a>
                                            <?php endif; ?>
                                            <span><?php the_author(); ?></span>
                                        </div>
                                        <div class="cont_large post-content">
                                            <span class="cats"><?php the_category('</span> <span class="cats"> '); ?></span>
                                            <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                        </div><!-- .post-header -->

                                        <div class="cont date post-footer">
                                            <span><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
                                        </div><!-- .post-footer -->
                                    </div><!-- .inside -->
                                </article>
                                <?php endwhile; ?>
                            <?php endif; wp_reset_query(); ?>

                            <?php if( get_option( 'show_on_front' ) == 'page' ) { ?>
                                <div class="button-container">
                                    <a class="butn small" href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>"><?php echo __('Go to Blog', 'thstlang') ?></a>
                                </div>
                            <?php } ?>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .container -->
            </div>
        <?php else : ?>
            <?php //Do nothing. ?>
        <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>