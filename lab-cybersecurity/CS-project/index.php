<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lab. Cybersecurity <?php echo 'A.Y. 2023-24'; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="index.php"><span>Lab Cybersecurity</span> <?php echo 'A.Y. 2023-24'; ?></a>
                </div>



                <!-- MENU -->
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="risorse-utili.php">Risorse utili</a></li>
                        <li><a href="contact.php">Contatti</a></li>
                    </ul>
                </div>
                <!-- end MENU -->
            </div>
        </div>
	</header>
	<!-- end header -->
	<section id="featured">
	<!-- start slider -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
	<!-- Slider -->
        <div id="main-slider" class="flexslider">
            <ul class="slides">
              <li>
                <img src="img/slides/slide_1.png" alt="" />
            </ul>
        </div>
	<!-- end slider -->
			</div>
		</div>
	</div>	
	
	

	</section>
	<section class="callaction">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="big-cta">
					<div class="cta-text">
						<h2>Laboratorio di <span>cybersecurity</span> per applicazioni multimediali</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
						<div class="box">
							<div class="box-gray aligncenter">
								<h4>Cifratura in Php</h4>
								<div class="icon">
								<i class="fa fa-desktop fa-3x"></i>
								</div>
								<p>
								 Utilizzo del linguaggio di programmazione PHP per la codifica dei testi in chiaro
								</p>
									
							</div>
							<div class="box-bottom">
								<a href="lectures/lect-1/lect1.php">Esercitazione 1</a>
							</div>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="box">
							<div class="box-gray aligncenter">
								<h4>Database sicuri</h4>
								<div class="icon">
								<i class="fa fa-edit fa-3x"></i>
								</div>
								<p>
								 Memorizzazzione sicura dei dati mediante l'utilizzo del database MySql.
								</p>
									
							</div>
							<div class="box-bottom">
								<a href="lectures/lect-2/lect2.php">Esercitazione 2</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="box">
							<div class="box-gray aligncenter">
								<h4>Applicazioni web sicure</h4>
								<div class="icon">
								<i class="fa fa-code fa-3x"></i>
								</div>
								<p>
								 Applicazione web sicure e accesso ai dati mediante l'utilizzo di connessioni cifrate.
								</p>
									
							</div>
							<div class="box-bottom">
								<a href="lectures/lect-3/lect3.php"">Esercitazione 3</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- divider -->
		<div class="row">
			<div class="col-lg-12">
				<div class="solidline">
				</div>
			</div>
		</div>
		<!-- end divider -->


	</div>
	</section>
	



	<!-- THE FOOTER -->
	<?php
		include('footer.php');
	?>



</body>
</html>