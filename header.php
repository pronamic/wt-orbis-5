<!DOCTYPE html>

<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php // @codingStandardsIgnoreStart ?>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<?php
		// @codingStandardsIgnoreEnd
		// Ignoring WordPress.WP.EnqueuedResources.NonEnqueuedScript: only loading script when IE9 is used.
		?>

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<div class="page-wrapper">
			<div class="sidebar-wrapper">
				<div class="site-title">
					<a href="<?php echo esc_attr( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if ( get_theme_mod( 'orbis_logo' ) ) : ?>

							<img src="<?php echo esc_url( get_theme_mod( 'orbis_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />

						<?php else : ?>

							<?php bloginfo( 'name' ); ?>

						<?php endif; ?>
					</a>
				</div>

				<div class="primary-nav" role="navigation">
					<h3><?php esc_html_e( 'Menu', 'orbis-5' ); ?></h3>

					<?php

					wp_nav_menu(
						[
							'container'      => false,
							'theme_location' => 'primary',
							'depth'          => 2,
							'fallback_cb'    => '',
						]
					);

					?>

					<span class="orbis-toggle-nav text-light mt-2"><span class="nav-label"><?php esc_html_e( 'Collapse menu', 'orbis-5' ); ?></span></span>
				</div>
			</div>

			<div class="main-wrapper">
				<div class="page-header d-flex justify-content-between">
					<div>
						<h1 class="orbis-page-title">
							<?php echo esc_html( orbis_get_title() ); ?>
						</h1>

						<?php get_template_part( 'templates/breadcrumbs' ); ?>
					</div>

					<?php if ( is_user_logged_in() ) : ?>

						<?php $current_user = wp_get_current_user(); ?>

						<ul class="nav ms-auto align-items-center gap-2">
							<li class="nav-item dropdown">
								<button data-bs-toggle="dropdown" class="btn btn-light dropdown-toggle d-flex align-items-center gap-2 rounded-pill px-2 py-1" type="button" aria-expanded="false">
									<?php echo get_avatar( $current_user->ID, 32, '', '', [ 'class' => [ 'rounded-circle', 'flex-shrink-0' ] ] ); ?>
									<span><?php echo esc_html( $current_user->display_name ); ?></span>
								</button>

								<ul class="dropdown-menu dropdown-menu-end">
									<li>
										<a class="dropdown-item" href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>"><i class="fa fa-user"></i> <?php esc_html_e( 'Edit profile', 'orbis-5' ); ?></a>
									</li>
									<li><hr class="dropdown-divider"></li>
									<li>
										<a class="dropdown-item" href="<?php echo esc_url( wp_logout_url() ); ?>"><i class="fa fa-power-off"></i> <?php esc_html_e( 'Log out', 'orbis-5' ); ?></a>
									</li>
								</ul>
							</li>

							<li class="nav-item dropdown">
								<button data-bs-toggle="dropdown" class="btn btn-light rounded-circle p-2 lh-1 search-btn" type="button" aria-label="<?php esc_attr_e( 'Search', 'orbis-5' ); ?>" aria-expanded="false"><i class="fa fa-search" aria-hidden="true"></i></button>

								<div class="dropdown-menu dropdown-menu-end p-3 mt-2">
									<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
										<input type="search" name="s" class="form-control search-input" placeholder="<?php esc_attr_e( 'Search', 'orbis-5' ); ?>" value="<?php echo esc_attr( $s ); ?>">
									</form>
								</div>
							</li>
						</ul>

					<?php endif; ?>
				</div>

				<div class="main-content">

					<?php if ( is_post_type_archive() || is_home() ) : ?>

						<?php get_template_part( 'templates/add-new-post' ); ?>

					<?php endif; ?>
