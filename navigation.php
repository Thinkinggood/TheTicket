<?php
/**
 * This file is used to display the navigation.
 *
 * @package Podcaster
 * @since 1.0
 * @author Theme Station
 * @copyright Copyright (c) 2014, Theme Station
 * @link http://www.themestation.co
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

$options = get_option('podcaster-theme');  
$pod_upload_logo_url = isset( $options['pod-upload-logo'] ) ? $options['pod-upload-logo'] : '';
$pod_sticky_header = isset( $options['pod-sticky-header'] ) ? $options['pod-sticky-header'] : '';
if( $pod_sticky_header == true ) {
	$pod_stcky_hdr = ' large_nav';
} else {
	$pod_stcky_hdr = '';
}

$pod_nav_bg = isset( $options['pod-nav-bg'] ) ? $options['pod-nav-bg'] : '';
if( $pod_nav_bg == 'transparent') {
	$pod_nav_bg_state = ' transparent';
} else {
	$pod_nav_bg_state = '';
}
$pod_responsive_style = isset( $options['pod-responsive-style'] ) ? $options['pod-responsive-style'] : '';

?>

<!-- Test -->

<div class="above <?php echo $pod_stcky_hdr; ?> <?php echo $pod_nav_bg_state; ?> <?php echo $pod_responsive_style; ?>">

	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<header class="header" id="top" role="banner">
					<a href="#" id="open-off-can" class="open-menu batch" data-icon="&#xF0AA;"></a>
					<?php if ( isset( $pod_upload_logo_url ) && $pod_upload_logo_url != '' ) : ?>
					<h1 class="main-title logo">
					<?php else : ?>
					<h1 class="main-title">
					<?php endif ; ?>
						<a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a>
					</h1>
				</header><!--header-->
			</div><!--col-lg-3-->

			<div class="col-lg-9 col-md-9">
			<?php if ( $pod_responsive_style == 'toggle') { ?>
				<nav id="nav" class="navigation toggle" role="navigation">
			<?php } else { ?>
				<nav id="nav" class="navigation drop" role="navigation">
			<?php } ?>
					<?php if ( has_nav_menu( 'header-menu' ) ) { ?>					
						<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container_id' => 'res-menu', 'sort_column' => 'menu_order', 'menu_class' => 'thst-menu', 'fallback_cb' => false, 'container' => false )); ?>						
					<?php } else { ?>
						<div class="menu">
							<a href="<?php echo $url = admin_url( 'nav-menus.php', 'admin' ); ?>">Please click here to create and set your menu</a>
						</div>
					<?php } ?>
				</nav><!--navigation-->
			</div><!--col-lg-9-->
		</div><!--row-->
	</div><!--container-->
</div><!-- .above -->
<div id="main-content">
		<div id="logo"></div>
		<h1><center>hosted by Ben Philpott &amp; Jay Root</center></h1>
		<center><p id="intro">Each week KUT's Ben Philpott and the Tribune's Jay Root provide a rundown<br>of the week's campaign actions and bring you interviews with people who<br> make a living working on, covering or commenting on the campaigns.</p></center>
		<div id="subscribe">
						<ul class="social-icons">
							<li>
							<h1>subscribe</h1>
							</li>
							<li>
							<a class="social-icon-soundcloud" href"https://soundcloud.com/the-ticket-2016"></a>
							</li>
							<li>
							<a class="social-icon-apple" href"https://itunes.apple.com/us/podcast/the-ticket-2016/id993772746?mt=2"></a>
							</li>
							<li>
							<a class="social-icon-stitcher" href "http://www.stitcher.com/podcast/kut-news-905/e/the-ticket-episode-1-37729574"></a>
							</li>
						</ul>
					</div>

		</div> <!-- END  main content -->