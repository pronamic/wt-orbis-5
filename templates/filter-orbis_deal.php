<div class="form-inline">
	<span><select name="orbis_deal_status" class="form-control">
		<?php

		$statuses = orbis_deal_get_statuses();

		array_unshift( $statuses, __( '— Select Status —', 'orbis-5' ) );

		$status_value = filter_input( INPUT_GET, 'orbis_deal_status', FILTER_UNSAFE_RAW );

		$status = ( null === $status_value ) ? '' : sanitize_text_field( wp_unslash( $status_value ) );

		foreach ( $statuses as $key => $label ) {
			printf(
				'<option value="%s" %s>%s</option>',
				esc_attr( $key ),
				selected( $key, $status, false ),
				esc_html( $label )
			);
		}

		?>
	</select> <button class="btn btn-secondary" type="submit"><?php esc_html_e( 'Filter', 'orbis-5' ); ?></button></span>
</div>
