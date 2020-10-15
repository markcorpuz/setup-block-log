<?php

/*
 * TEMPLATE: GUIDEBOX-LIST-BAR
 */

global $block_css, $block_counter;

// increment counter
$block_counter ++ ;

$classes = array(
	'module',
	'log',
	'guidebox-list',
	'guidebox-list-line',
);

// Include CSS selectors manually entered thru wp-admin
//if( array_key_exists( 'className', $block ) ) {
    $classes = array_merge( $classes, explode( ' ', $block_css ) );
//}

?>

<?php echo '<div class="'.join( ' ', $classes ).'">'; ?>
	<div class="module-wrap">
		<div class="group line">
			<div class="left">
				<?php
				echo setup_be_log_code();
				echo setup_be_log_label();
				echo setup_be_log_date();
				echo setup_be_log_user();
				?>
			</div>
			<div class="right"><?php
				echo setup_be_log_title();
				echo setup_be_log_summary();
				echo setup_be_log_info();
			?></div>
		</div>
	</div>
</div>

<?php

// EOF