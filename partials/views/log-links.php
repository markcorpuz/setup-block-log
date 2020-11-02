<?php

echo '<p><strong>Title:</strong> '.get_field( 'log_title' ).'</p>';


echo '<p><strong>Summary:</strong> '.get_field( 'log_summary' ).'</p>';


$internal_link = get_field( 'log_link' );
if( !empty( $internal_link ) ) {

	echo '<p><a href="'.$internal_link.'" target="_blank">'.$internal_link.'</a></p>';

} else {

	$external_link = get_field( 'log_link_internal' );
	if( is_array( $external_link ) ) {

		if( count( $rel_cta_entries ) > 1 ) {

			echo '<p>Log Link Internal should only have 1 entry.</p>';

		} else {

			foreach( $external_link as $val ) {
				echo '<p><a href="'.get_the_permalink( $val ).'">'.get_the_title( $val ).'</a></p>';
			}

		}

	}

}