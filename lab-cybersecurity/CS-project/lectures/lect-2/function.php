<?php

//funzione per la connessione al database
function dbConnect() {
	define('DB_HOST', '127.0.0.1');
	define('DB_NAME', 'sicurezza_db');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');

	//DA COMPLETARE
	$db=  

	if (!$db) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
}
	return $db;
}




//inserimento di un utente
function inserisci_utente($username, $password){
	$conn=dbConnect();
	$sql="INSERT INTO sc_users (users_username, users_password) VALUES ('". $username ."', '". $password ."')";
	if(!$conn->query($sql)){  //stampo un errore
		 echo '<div class="alert alert-danger"><strong>Attenzione errore nella query:</strong> ' . $sql . "\n" . mysql_error() .'</div>';
	}
	else{
		echo '<div class="alert alert-success">
				<strong>Utente inserito con successo</strong>
			  </div>';
		header( "refresh:3;url=database_index.php" );
	}
	
	mysqli_close($conn); 
	                                                            
}


//stampo la lista degli utenti
function lista_utenti(){
	$risultato=array(); // $risultato="";
	$conn=dbConnect();
	$sql="SELECT * FROM sc_users";
	$risposta = $conn->query($sql) or die("Errore nella query: " . $sql . "\n" . mysql_error());
	
	while ($riga = mysqli_fetch_row($risposta)) {  //restituisce una riga della tabella sc_users altrimenti FALSE
	    $risultato[] = $riga;
	  	}
		mysqli_close($conn);
	return $risultato;  //ritorno l'array risultato
}


//rimuovo un utente
function rimuovi_utente($users_id){
	$conn=dbConnect();
	$sql="DELETE FROM sc_users WHERE users_id = $users_id";
	$risposta=$conn->query($sql)  or die("Errore nella query: " . $sql . "\n" . mysql_error());
    mysqli_close($conn);
    header("Location: database_index.php");

}



?>