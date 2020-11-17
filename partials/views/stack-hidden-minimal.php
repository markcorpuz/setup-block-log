<?php

/*
 * TEMPLATE: STACK-HIDDEN-MINIMAL
 */

global $block_css, $block_counter;

// increment counter
$block_counter ++ ;

$classes = array(
	'module',
	'log',
	'stack',
	'minimal',
);

// Include CSS selectors manually entered thru wp-admin
//if( array_key_exists( 'className', $block ) ) {
    $classes = array_merge( $classes, explode( ' ', $block_css ) );
//}


// VALIDATE INFO FIRST
if( get_field( 'log_title' ) || get_field( 'log_summary' ) || get_field( 'log_info' ) ) {

	$group_info = '<div class="group info hide" id="group_info__'.$block_counter.'">
						<div class="group summary">'.
							setup_be_log_title().
							setup_be_log_summary().
							setup_be_log_info().
						'</div>
						<div class="group innerblock"><InnerBlocks /></div>
					</div>';

	$expander = '<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>';

} else {

	// Check for inner blocks
	$content = get_the_content();

	$inner_blocks = isset( $content ) ? $content : false;

	if( !empty( trim( strip_tags( $inner_blocks ) ) ) ) {

		$group_info = '<div class="group info hide" id="group_info__'.$block_counter.'">
								<div class="group innerblock"><InnerBlocks /></div>
							</div>';

		$expander = '<div class="left"><a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a></div>';

	} else {

		// declare empty variables
		$group_info = '';
		$expander = '';

	}

}
/*
function copter_remove_crappy_markup( $string ) {
    $patterns = array(
        '#^\s*</p>#',
        '#<p>\s*$#'
    );

    return preg_replace($patterns, '', $string);
}
*/


// output
echo '<div class="'.join( ' ', $classes ).'" id="ekaj"><div class="module-wrap">
			<div class="group bar">
				'.$expander.'
				<div class="right">
					'.setup_be_log_code().setup_be_log_label().setup_be_log_date().setup_be_log_user().setup_be_log_link_external().'
				</div>
			</div>
			'.$group_info.'
	</div></div>';


/*
// THIS IS THE ORIGINAL OUTPUT CODE
echo '<div class="'.join( ' ', $classes ).'">'; ?>
	<div class="module-wrap">
		<div class="group bar">
			<div class="left">
				<?php
				echo '<a class="item expand" id="group_line_expander__'.$block_counter.'">CLICK TO EXPAND</a>';
				?>
			</div>
			<div class="right">
				<?php
				echo setup_be_log_code();
				echo setup_be_log_label();
				echo setup_be_log_date();
				echo setup_be_log_user();
				echo setup_be_log_link();
				?>
			</div>
		</div><?php
		// THIS ENTIRE DIV WILL BE HIDDEN ON PAGE LOAD
		echo '<div class="group info hide" id="group_info__'.$block_counter.'">';
			?><div class="group summary"><?php
				echo setup_be_log_title();
				echo setup_be_log_summary();
				echo setup_be_log_info();
				?>
			</div>
			<div class="group innerblock">
				<?php
				echo '<InnerBlocks />';
				?>	
			</div>
		</div>
	</div>
</div>
<?php
*/

// EOF