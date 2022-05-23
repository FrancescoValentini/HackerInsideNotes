<?php
	
	function random_str(int $length = 64,string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
    	if ($length < 1) {
    	    throw new \RangeException("Length must be a positive integer");
    	}
    	$pieces = [];
    	$max = mb_strlen($keyspace, '8bit') - 1;
    	for ($i = 0; $i < $length; ++$i) {
    	    $pieces []= $keyspace[random_int(0, $max)];
    	}
    	return implode('', $pieces);
	}
	
	function sha256($data){
		return hash("sha256",$data);
	}
		
    function connect(){ //Crea la connessione con il database sql
		$db="my_francescovalentini";//Da Modificare per il proprio DB
		$conn=mysqli_connect("localhost","root","",$db);
        return $conn;
    }

    function checkIfUserExist($username){ //Verifica se l'utente esiste nel DB
		$conn = connect(); //Connessione al DB
		$username = mysqli_real_escape_string($conn, $username);
		
		$query="SELECT ID FROM utenti WHERE username = '$username';";
		$ris=mysqli_query($conn,$query);
		
		if(mysqli_num_rows($ris) == 0 ){
			//echo "non esiste";
			return false; //utente non trovato
		}
		else{
			//echo "esiste";
			return true; //utente trovato
		}
		mysqli_close($conn);
	}
	
    function checkLogin($username,$password){ //verifica le credenziali utente
		$conn = connect(); //Connessione al DB
		$username = mysqli_real_escape_string($conn, $username);
		$pwdHash = sha256($password);
		
		$query="SELECT id FROM utenti WHERE username= '$username' and password= '$pwdHash';";
		
		$ris=mysqli_query($conn,$query);
		mysqli_close($conn);
		if(mysqli_num_rows($ris)==0){
			$userId=-1;//utente non trovato
		}
		else{
			$riga=mysqli_fetch_array($ris);
			$userId= $riga['id'];
		}
		return $userId;
	}
	
    function register($username,$password,$email){
		$conn = connect(); //Connessione al DB
		$username = mysqli_real_escape_string($conn, $username);
		$email = mysqli_real_escape_string($conn, $email);
		$pwdHash = sha256($password);
		$uid = random_str(16);
		
		$query="INSERT INTO UTENTI (id, username, password, email) VALUES ('$uid','$username','$pwdHash','$email');";
		if(checkIfUserExist($username)){
			return -1;
		}else{
			$ris=mysqli_query($conn,$query);
		}

		mysqli_close($conn);
		return 0;
	}
	
	//Metodi per la gestione delle note
	function getNote($noteID){ //Prende una singola nota dato il suo ID
		$conn = connect(); //Connessione al DB
		$noteID = mysqli_real_escape_string($conn, $noteID);
		
		$query="SELECT note.ID,note.titolo,note.nota,note.dataSalvataggio FROM note,utenti WHERE note.ID = '$noteID' AND note.ID_utente = utenti.ID;";
		
		$ris=mysqli_query($conn,$query);
		mysqli_close($conn);

		if(mysqli_num_rows($ris)==0){
			$nota=-1;//nota non trovata
		}
		else{
			$note = array();
			while($riga=mysqli_fetch_array($ris,MYSQLI_ASSOC)){
				$note[] = $riga;
			}
			return $note;
		}
	}

	function getNotes($uid){ //prende tutte le note dato l'id utente
		$conn = connect(); //Connessione al DB
		$uid = mysqli_real_escape_string($conn, $uid);
		
		$query="SELECT note.ID,note.titolo,note.nota,note.dataSalvataggio FROM note,utenti WHERE note.ID_utente = '$uid' AND note.ID_utente = utenti.ID;";
		
		$ris=mysqli_query($conn,$query);
		mysqli_close($conn);

		if(mysqli_num_rows($ris)==0){
			$nota=-1;//nota non trovata
		}
		else{
			$notes = array();
			while($riga=mysqli_fetch_array($ris,MYSQLI_ASSOC)){
				$notes[] = $riga;
			}
			return $notes;
		}
	}
	function addNote($uid,$titolo,$nota){ //aggiunge una nuova nota
		$conn = connect(); //Connessione al DB
		$uid = mysqli_real_escape_string($conn, $uid);
		$titolo = mysqli_real_escape_string($conn, $titolo);
		$nota = mysqli_real_escape_string($conn, $nota);

		$noteID = random_str(16);
		$time = date ('Y-m-d H:i:s', time());

		$query="INSERT INTO note (id, ID_utente, titolo, nota,dataSalvataggio) VALUES ('$noteID','$uid','$titolo','$nota','$time');";

		$ris=mysqli_query($conn,$query);

		mysqli_close($conn);
		return 0;
	}

	function deleteNote($noteID){ //Elimina una nota
		$conn = connect(); //Connessione al DB
		$noteID = mysqli_real_escape_string($conn, $noteID);
		
		$query="DELETE FROM note WHERE note.ID='$noteID';";
		
		$ris=mysqli_query($conn,$query);
		mysqli_close($conn);
		return 0;
	}

	function editNote($noteID,$titolo,$nota){  //modifica una nota
		$conn = connect(); //Connessione al DB
		$noteID = mysqli_real_escape_string($conn, $noteID);
		$titolo = mysqli_real_escape_string($conn, $titolo);
		$nota = mysqli_real_escape_string($conn, $nota);

		$time = date ('Y-m-d H:i:s', time());

		$query="UPDATE Note SET titolo='$titolo', nota='$nota',dataSalvataggio='$time' WHERE note.ID = '$noteID';";

		$ris=mysqli_query($conn,$query);

		mysqli_close($conn);
		return 0;
	}
	function globalCountNotes(){  //modifica una nota
		$conn = connect(); //Connessione al DB

		$query="SELECT COUNT(ID) AS NumeroNote FROM Note;";

		$ris=mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($ris);;
		return $row['NumeroNote'];
		mysqli_close($conn);
		return 0;
	}
	function globalCounUsers(){  //modifica una nota
		$conn = connect(); //Connessione al DB

		$query="SELECT COUNT(ID) AS NumeroUtenti FROM Utenti;";

		$ris=mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($ris);;
		return $row['NumeroUtenti'];
		mysqli_close($conn);
		return 0;
	}


	//echo globalCounUsers();
	//register("utente","utente","utente@prova.it");
	//echo(checkLogin("utente","utente"));
	//echo(checkLogin("admin","admin"));

	//addNote("3dpoANLgeksFvufR","Nota di prova","prova di scrittura, nota di prova, demo, test, prova");
	//print_r(getNotes("3dpoANLgeksFvufR"));
	//deleteNote("SiQ0IOSko3m85sWy");
	//editNote("2JGTox8GuL7RoHog","Nota Aggiotnata","Nota aggiornata");
?>