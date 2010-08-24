<?
// Exit if we have no repost url
if ( !isset( $_POST['m_3'] ) ) {
	echo "Error";
	exit;
}

// Start Form
echo '<form name="vorentoe" method="post" action="' . $_POST['m_3'] . '">';

// Two types of variables - p is mandatory, m_ is custom
$var_base = array( 'p' => 12, 'm_' => 10 );

foreach ( $var_base as $k => $u ) {
	// Cycle through parameters
	for ( $i=1; $i<=$u; $i++ ) {
		$v = '';

		// Check if we have any value here
		if ( isset( $_POST[$k.$i] ) ) {
			$v = $_POST[$k.$i];
		}

		echo '<input type="hidden" name="' . $k.$i . '" value="' . $v . '">';
	}
}

// Extra parameters
$extra = array( 'pam' );

foreach ( $extra as $k ) {
	$v = '';

	// Check if we have any value here
	if ( isset( $_POST[$k] ) ) {
		$v = $_POST[$k];
	}

	echo '<input type="hidden" name="' . $k . '" value="' . $v . '">';
}

// End Form
echo '</form>';

// Auto Submit via Javascript
echo '<script language="javascript">document.'.'vorentoe'.'.submit()</script>';

?>