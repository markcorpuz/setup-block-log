<?php

/*
 * TEMPLATE: GUIDEBOX-LIST
 */

global $block_css;

$classes = array(
	'module',
	'log',
	'guidebox-list',
	'jake',
);

// Include CSS selectors manually entered thru wp-admin
//if( array_key_exists( 'className', $block ) ) {
    $classes = array_merge( $classes, explode( ' ', $block_css ) );
//}

?>

<div class="fontsize-tiny"><strong>START</strong></div>

<?php echo '<div class="'.join( ' ', $classes ).'">'; ?>
	<div class="module-wrap">
		<div class="group line">
			<?php
			echo setup_be_log_code();
			echo setup_be_log_date();
			echo setup_be_log_label();
			echo setup_be_log_user();
			?>
			<a class="item expand">Expand</a>
		</div>
		<div class="group info">
			<?php 
			echo setup_be_log_title();
			echo setup_be_log_summary();
			echo setup_be_log_info();
			?>
		</div>
		<div class="group detail">
			<?php
			echo '<InnerBlocks />';
			?>	
		</div>
	</div>
</div>

<div class="fontsize-tiny"><strong>END</strong></div>
<?php

// EOF