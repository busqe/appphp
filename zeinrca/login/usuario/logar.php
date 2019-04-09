<?php session_start(); 


$email = $_POST['email'];
$senha = $_POST['password'];


if(strlen($email)>0){
	$_SESSION['EMAIL'] = $email;
}

if(strlen($senha)>0){
	$_SESSION['SENHA'] = $senha;
}

$tempo = time();


echo "{\"email\":\"$email\",\"senha\":\"$senha\",\"sessao\":\"$tempo\"} ";
 

 // json_encode($_POST)
// {"email":"teste1516017496@teste.com","name":"teste"} 


if($_GET["teste"]){

	echo " <BR ><BR >RESULTADO SESSAO: <BR > EMAIL: " . $_SESSION["EMAIL"] . "<BR >SENHA: " . $_SESSION["SENHA"] . "<BR >";
}

?>