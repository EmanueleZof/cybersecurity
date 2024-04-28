<?php
include("../../config.php");
include('function.php');
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
					<li><a href="lect2.php">Esercitazione 2</a></li>
					<li class="active">Database</li>
				</ul>
			</div>
		</div>
	</div>
	</section>



	<!-- CONTENT start -->
	<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
	<section id="content">
	<div class="container">
		<h1>Operazioni sui database</h1>
		<h3>Inserisci un nuovo utente</h3>


			<!-- form per l'inserimento di dati sul DB -->
		<div id="myContent" style="text-align:center;">
			<form action="database_inserisci_utente.php" name='form' method="POST">
				<p align="center">Inserisci username</p> <input type='text' name='username'/><br/><br/>
				<p align="center">Inserisci password</p> <input type='password' name='password'/><br/><br/>
			<p align="center"><input type='submit' value='Inserisci utente' class="btn btn-theme"/><br><br><br><br></p>
			</form>
		</div>


		<h3>Lista degli utenti</h3>
		
	<?php
		//stampo la lista degli utenti
		$users = lista_utenti();  //se la lista degli utenti non è vuota stampo una tabella
		if(!empty($users)){
			echo '<table style="width:100%">
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Password</th>
					<th>Remove</th>
				</tr>';
			foreach ($users as $user) {  //ad ogni iterazione il valore di $users (che è un array) viene assegnato a $user
				echo '<tr>
						<td>' . $user[0] . ' </td>
						<td>' . $user[1] . ' </td>
						<td>' . $user[2] . ' </td>
						<td><a href="database_rimuovi_utente.php?id='.$user[0].'">Rimuovi utente</a></td>
					  </tr>' ;
			}
			echo '</table>';
		}
		else{
			echo '<div class="alert alert-warning">
					<strong>Nessun utente presente sul database</strong>
				  </div>';
		}
?>




		





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