<!--  Redirect to index page  -->
<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

	/* New Approch*/
	header('Location: '.$uri.'/xampp/XadapterAssignment/view/index.php');

	/* OLD Approch*/
	//require_once('C:\xampp\htdocs\xampp\CURDUsingClass\view\index.php');
?>