<?php
require_once 'subCipher_class.php';

$keyVal = $_GET['key'];
$textVal = $_GET['text'];


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
					<li><a href="lect1.php">Esercitazione 1</a></li>
					<li class="active">Cifratura a sostituzione</li>
				</ul>
			</div>
		</div>
	</div>
	</section>


	<!-- CONTENT start -->
	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
	<section id="content">
	<div class="container">
		<h1>Cifratura a sostituzione</h1>
	
	<div id="myContent" style="text-align:center;">
		
		<?php
		if($keyVal != "" && $textVal != ""){
			//invoco il metodo per cifrare il testo
			$cipher = new SubCipher($keyVal);
			//stampo il risultato
			echo '<h3 class="alert alert-success">Il testo cifrato della stringa "'.$textVal.'" è:</h3>';
			echo $cipher->textCoding($textVal);
		}
		else{
			echo '<h3 class="alert alert-danger">Errore: compila tutti i campi</h3>';
		}
		?>
		<br />
		<br />
	
		<a href="./subCipher_index.php" class="btn btn-theme">Cifra un altro testo</a>

	</div><!-- /.container -->
	</section>

	<!-- CONTENT end -->
	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->




	<!-- THE FOOTER -->
	<?php
		include('../../footer.php');
	?>


</body>
</html>