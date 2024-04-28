<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lab. Cybersecurity <?php echo date("Y"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<!-- css -->
<link href="../../css/bootstrap.min.css" rel="stylesheet" />
<link href="../../css/fancybox/jquery.fancybox.css" rel="stylesheet">
<!-- <link href="../../css/jcarousel.css" rel="stylesheet" /> -->
<link href="../../css/flexslider.css" rel="stylesheet" />
<link href="../../css/style.css" rel="stylesheet" />


<!-- Theme skin -->
<link href="../../skins/default.css" rel="stylesheet" />

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
                    <a class="navbar-brand" href="../../index.php"><span>Lab Cybersecurity</span> <?php echo date("Y"); ?></a>

                </div>

                <!-- MENU -->
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="../../index.php">Home</a></li>
                        <li><a href="../../risorse-utili.php">Risorse utili</a></li>
                        <li><a href="../../contact.php">Contatti</a></li>
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
					<li><a href="../../index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li class="active">Esercitazione 1</li>
				</ul>
			</div>
		</div>
	</div>
	</section>



	<section id="content">
	<div class="container">
		<h1>Esercitazione 1</h1>

		<div class="row">
			<div class="col-lg-6">
				<!-- Description -->
				<h4>Esercizio 1: Strong password generator</h4>
				<img src="../../img/simpson.jpg" alt="">
				<br /><br />
				<p>Usare una password sicura è importante per garantire la sicurezza di qualsiasi applicativo web. Una password viene classificata sicura se è lunga almeno 8 caratteri alfanumerici, contiene caratteri speciali, non utilizza parole del vocabolario comuni.</p>
				<h5>Scopo dell'esercizio</h5>				
				<p>Realizzare in Php un generatore di password, di lunghezza variabile tra 8 e 16 caratteri.</p>
				<a href="pwd_generator_index.php">Crea una password sicura</a>
			</div>


			<!-- Horizontal Description -->
			<div class="col-lg-6">
				<h4>Esercizio 2: Cifratura a sostituzione</h4>
				<img src="../../img/cryptography.jpg" alt="">
				<br /><br />
				<p>Un cifrario a sostituzione è un metodo di cifratura in cui ogni unità del testo in chiaro è sostituita con del testo cifrato secondo uno schema regolare; le "unità" possono essere singole lettere, coppie di lettere, sillabe, mescolanze di esse, ed altro.</p>
				<h5>Scopo dell'esercizio</h5>
				<p>Realizzare un cifrario a sostituzione in PhP per la cifratura di testi di lunghezza variabile.</p>
				<a href="subCipher_index.php">Cifra una testo</a>
			</div>
		</div>

	</div>  <!-- close the container -->






	</section>
	



	<!-- THE FOOTER -->
	<?php
		include('../../footer.php');
	?>


</body>
</html>