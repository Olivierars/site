<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
	<title><?php echo htmlspecialchars($title);?></title> 
	<meta name="robots" content="index,follow" />
	<meta name="description" content="<?php echo htmlspecialchars($description);?>" />
	

	<link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../assets/js/star-rating.js" type="text/javascript"></script>


	<!-- Pour qu'IE < 9  comprennent les balise HTML5 -->
	<!--[if lt IE 9]>
    <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
	<![endif]-->

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