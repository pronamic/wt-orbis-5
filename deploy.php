<?php
/**
 * Orbis 5 deploy
 *
 * @package orbis-5
 */

namespace Deployer;

require 'recipe/common.php';

set( 'theme_slug', 'orbis-5' );

set( 'build_path', './build/' );

host( 'orbis.pronamic.nl' )
	->set( 'hostname', 'esm7.siteground.biz' )
	->set( 'remote_user', 'u155-jlog1cramrrx' )
	->set( 'port', 18765 )
	->set( 'deploy_path', '~/projects/wt-orbis-5' )
	->set( 'themes_dir', '~/www/orbis.pronamic.nl/public_html/wp-content/themes' );

/**
 * Build.
 *
 * @link https://github.com/woocommerce/woocommerce/blob/48fdb94bf311c977d15cbaa3d8dab66bac01feb7/plugins/woocommerce/.distignore
 * @link https://github.com/woocommerce/woocommerce/blob/48fdb94bf311c977d15cbaa3d8dab66bac01feb7/plugins/woocommerce/bin/build-zip.sh
 */
task(
	'build',
	function () {
		runLocally( 'composer run-script build' );
	}
);

task(
	'deploy:update_code',
	function () {
		upload( '{{build_path}}/orbis-5/', '{{release_path}}' );
	}
);

task(
	'deploy:symlink_theme',
	function () {
		run( 'ln -sfn {{deploy_path}}/current {{themes_dir}}/{{theme_slug}}' );
	}
);

after( 'deploy:symlink', 'deploy:symlink_theme' );

task(
	'deploy',
	[
		'build',
		'deploy:prepare',
		'deploy:publish',
	]
);
