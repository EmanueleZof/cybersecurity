<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lab. Cybersecurity <?php echo date("Y"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://bootstraptaste.com" />
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
                        <li><a href="risorse-utili.php">Risorse utili</a></li>
                        <li class="active"><a href="contact.php">Contatti</a></li>
                    </ul>
                </div>
                <!-- end MENU -->

            </div>
        </div>
	</header>
	<!-- end header -->
	<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Contatti</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2767.4930341880754!2d13.212078999999994!3d46.081148999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477a3514b908f531%3A0x625202800b966414!2sUniversit%C3%A0+degli+Studi+Di+Udine+-+Polo+Scientifico+Rizzi!5e0!3m2!1sen!2sit!4v1426069388152" width="800" height="600" frameborder="0" style="border:0"></iframe>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-4">
					<h3>Prof. Gian Luca FORESTI</h3>
					<p>Email: gianluca.foresti@uniud.it</p>
					<p>Website: <a href="http://users.dimi.uniud.it/~gianluca.foresti" target="blank">users.dimi.uniud.it/~gianluca.foresti</a></p>
				</div>
				<div class="col-lg-4">
					<h3>Dott. Andrea TOMA</h3>
					<p>Email: andrea.toma@uniud.it</p>
				</div>
				<div class="col-lg-4">
					<h3>E-learning Uniud</h3>
					<p>Website: <a href="http://elearning.uniud.it/" target="blank">Piattaforma E-learning uniud</a></p>
				</div>
		

			</div>
		</div>
	</div>
	</section>

	<!-- THE FOOTER -->
	<?php
		include('footer.php');
	?>

</body>
</html>