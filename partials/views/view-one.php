<?php

/*
 * TEMPLATE: ONE
 */


?>

This template is defined on the setup-log plugin itself called view-one.php. It's supposed to get the log_date.

<?php

//echo '<h1>'.get_field( 'log_label' ).'</h1>';
echo '<div class="item log date">' . get_field( 'log_date' ) . '</div>';

?><hr /><?php