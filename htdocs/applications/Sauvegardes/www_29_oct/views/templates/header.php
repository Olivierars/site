<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">

	<title><?php echo htmlspecialchars($title);?></title> 
	<meta name="robots" content="index,follow" />
	<meta name="description" content="<?php echo htmlspecialchars($description);?>" />
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
	