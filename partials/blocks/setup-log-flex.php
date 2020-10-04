<?php

$layout = get_field( 'log_layout' );

echo setup_acf_pull_view_template( $layout );

