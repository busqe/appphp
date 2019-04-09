<?

$area = $_GET["area"];
 	

switch ($area) {
  case 'sobre':
		$arquivo =  "sobre.php"; 
 		 break;
  case 'ajuda':
		$arquivo =  "ajuda.php"; 
  		break;		 		 
  case 'links':
		$arquivo =  "links.php"; 
  		break;	
  case 'comprar':
  		$arquivo =  "comprar.php"; 
  		break;	
 default
  		$arquivo =  "404.php"; 
  		break;	  		

}


?>