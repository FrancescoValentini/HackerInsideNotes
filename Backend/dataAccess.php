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
			echo "non esiste";
			return false; //utente non trovato
		}
		else{
			echo "esiste";
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
	
	//echo random_str(16);
	//register("utente","utente","utente@prova.it");
	//echo(checkLogin("utente","utente"));
	//echo(checkLogin("admin","admin"));
	
?>