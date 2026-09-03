<div class="pull-right form-inline">
	<?php

	wp_dropdown_users(
		[
			'name'             => 'orbis_task_assignee',
			'selected'         => filter_input( INPUT_GET, 'orbis_task_assignee', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE ),
			'show_option_none' => __( '— Select Assignee —', 'orbis-5' ),
			'class'            => 'form-control',
		] 
	);

	?>

	<button class="btn btn-secondary ml-1" type="submit"><?php esc_html_e( 'Filter', 'orbis-5' ); ?></button>
</div>
