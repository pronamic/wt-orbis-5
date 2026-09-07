<?php

$min_postcode = get_query_var( 'min_postcode' );
$max_postcode = get_query_var( 'max_postcode' );
$is_advanced  = ! empty( $min_postcode ) || ! empty( $max_postcode );

?>

<div id="advanced-search" class="<?php echo $is_advanced ? 'show' : 'collapse'; ?>">
	<fieldset>
		<legend><?php esc_html_e( 'Advanced Search', 'orbis-5' ); ?></legend>

		<div class="form-group">
			<label for="orbis_min_postcode"><?php esc_html_e( 'Postcode from', 'orbis-5' ); ?></label>
			<input id="orbis_min_postcode" class="form-control" name="min_postcode" value="<?php echo esc_attr( $min_postcode ); ?>" type="text" placeholder="<?php esc_html_e( '1234', 'orbis-5' ); ?>">
			<label for="orbis_max_postcode"><?php esc_html_e( 'to', 'orbis-5' ); ?></label>
			<input id="orbis_max_postcode" class="form-control" name="max_postcode" value="<?php echo esc_attr( $max_postcode ); ?>" type="text" placeholder="<?php esc_html_e( '1234', 'orbis-5' ); ?>">
		</div>

		<div class="form-footer">
			<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Search', 'orbis-5' ); ?></button>
			<button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#advanced-search"><?php esc_html_e( 'Cancel', 'orbis-5' ); ?></button>
		</div>
	</fieldset>
</div>
