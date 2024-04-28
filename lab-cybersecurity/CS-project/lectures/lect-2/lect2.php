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
					<li class="active">Esercitazione 2</li>
				</ul>
			</div>
		</div>
	</div>
	</section>



	<section id="content">
	<div class="container">
		<h1>Esercitazione 2</h1>

		<div class="row">
			<div class="col-lg-6">
				<h3>Parte A</h3>
				<p>Variabili spciali, richieste GET/POST, Cookie e Sessioni.</p>
				<br /><br />
				<h4>Esercizio 0: Test variabili speciali</h4>	
				<a href="test_server_var.php">Test $_SERVER</a>	
				<br /><br />
				<h4>Esercizio 1: GET and POST requests</h4>			
				<p>Relizzare una pagina in php per l'inoltro di informazioni mediante l'utilizzo dei metodi GET e POST.</p>
				<a href="get_data_index.php">Invia tramite GET</a>
				<br />
				<a href="post_data_index.php">Invia tramite POST</a>
				<br /><br />
				<h4>Esercizio 2: Cookies e Sessioni</h4>
				<h5>Esercizio 2a</h5>
				<p>Realizzare un applicativo in Php per il tracciamento delle scelte utente. Lo scopo è quello di utilizzare i cookie per registrare le scelte dell'utente e visualizzare di conseguenze dei banner pubblicitari.</p>
				<a href="myBanner_index.php">My banner</a>

				<h5>Esercizio 2b</h5>
				<p>Creare una sessione in php</p>
				<a href="session_index.php">Crea sessione</a>
			</div>


			<!-- Horizontal Description -->
			<div class="col-lg-6">
				<h3>Parte B</h3>
				<p>Operazioni sui database</p>
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