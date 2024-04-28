<?php
include("../../config.php");
?>


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

</head>cooki
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
					<li><a href="lect2.php">Esercitazione 2</a></li>
					<li class="active">My banner result</li>
				</ul>
			</div>
		</div>
	</div>
	</section>



	<!-- CONTENT start -->
	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
	<section id="content">
	<div class="container">

		<?php
			if(//##### COMPLETARE #####)){
				//##### COMPLETARE #####
			}
			else{
			echo '<h3>nessuna preferenza</h3>' ;
			}?>

		<h1>My Banner</h1>
			
				<h3>La Renault Clio</h3>
				<p>
				<?php echo '<img src="'.DB_IMG_FOLDER.'clio.png" alt="" width="300" style="float:right;"/>' ?>
				La Renault Clio ha avuto molto successo nelle competizioni automobilistiche. Lanciata nel mondo delle corse con il primo modello datato 1991 con motorizzazione 1800 16V la Clio è stata sempre ai vertici delle classifiche; successivamente, appena immesso sul mercato il modello celebrativo "Williams" con motorizzazione 2000 16v, la 1800 16v è stata accantonata. Negli ultimi anni è stata omologata per le competizioni anche il modello "Rs" e la recentissima versione "R3" della New Clio, ma la regina al momento resta sempre la Clio Williams, soprattutto nei Rally con le due conformità SuperN e Gruppo A. L'omologazione della "Williams" è scaduta a fine 2007 e pertanto dal 1º gennaio 2008 è entrata a far parte delle vetture "Fuori Omologazione", mantenendo la sua configurazione originale. In questo modo le ex Gruppo A entrano nel gruppo FA e le ex gruppo N entrano nel gruppo FN, rispettivamente FA7 e FN3.
				</p>
				<?php echo '<a href="'.DB_LECTURES_FOLDER.'lect-2/myBanner_index.php" class="btn btn-theme">Torna alla Golf</a>'; ?>

		

	</div> <!-- /.container -->
	</section>
	<!-- CONTENT end -->
	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->


	<!-- THE FOOTER -->
	<?php
		include('../../footer.php');
	?>

</body>
</html>