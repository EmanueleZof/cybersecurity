<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lab. Cybersecurity <?php echo date("Y"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />


<!-- Theme skin -->
<link href="skins/default.css" rel="stylesheet" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><span>Lab Cybersecurity</span> <?php echo date("Y"); ?></a>

                </div>


                <!-- MENU -->
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="risorse-utili.php">Risorse utili</a></li>
                        <li><a href="contact.php">Contatti</a></li>
                    </ul>
                </div>
                <!-- end MENU -->


            </div>
        </div>
	</header>
	<!-- end header -->


	<!-- BREADCRUMBS -->
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Risorse utili</li>
				</ul>
			</div>
		</div>
	</div>
	</section>



	<section id="content">
	<div class="container">
		<ul>
			<h4>Linguaggio PHP</h4>
			<li><a href="http://www.html.it/guide/guida-php-di-base/" target="blank">HTML.it Guida PHP</a></li>
			<li><a href="http://php.net/" target="blank">PHP net</a></li>
			<li><a href="http://www.w3schools.com/php/default.asp" target="blank">W3schools PHP</a></li>
			<br />
			<h4>HTML-CSS</h4>
			<li><a href="http://www.html.it/guide/guida-css-di-base" target="blank">HTML.it Guida CSS</a></li>
			<li><a href="http://www.w3schools.com/html/default.asp" target="blank">W3schools HTML</a></li>
			<li><a href="http://http://www.w3schools.com/css/default.asp" target="blank">W3schools CSS</a></li>
			<br />
			<h4>Misc</h4>
			<li><a href="https://www.apachefriends.org/it/index.html" target="blank">Ambiente XAMPP</a></li>
			<li><a href="http://getbootstrap.com/" target="blank">Bootstrap</a></li>
			<li><a href="http://jquery.com/" target="blank">JQuery</a></li>
			<li><a href="components.php">Template components</a></li>
			<li><a href="http://www.w3schools.com/" target="blank">W3Schools tutorials</a></li>


		</ul>
		

	</div>  <!-- close the container -->






	</section>
	



	<!-- THE FOOTER -->
	<?php
		include('footer.php');
	?>


</body>
</html>