<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- permet au CSS de déterminer la résolution de l'écran en fonction du périphérique -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">

	<title><?php echo htmlspecialchars($title);?></title> 
	<meta name="robots" content="index,follow" />
	<meta name="description" content="<?php echo htmlspecialchars($description);?>" />
	
	<!-- Pour qu'IE < 9  comprennent les balise HTML5 -->
	<!--[if lt IE 9]>
    <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="/assets/bootstrap-3.2.0-dist/css/bootstrap.css"> 
	<link href="/assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="/assets/bootstrap-3.2.0-dist/js/jquery-1.10.2.js"></script> 
	<script src="/assets/bootstrap-3.2.0-dist/js/bootstrap.js"></script>

 	<link rel="stylesheet" href="/assets/css/style.css" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script language="Javascript"> 
		function bascule(elem) 
		{ 
			etat=document.getElementById(elem).style.visibility; 
			if(etat=="hidden")
			{
				document.getElementById(elem).style.visibility="visible";
			} 
			else
			{
				document.getElementById(elem).style.visibility="hidden";
			} 
		} 
	</script> 

	
</head>

<body>