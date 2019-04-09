<?

$area = $_GET["area"];
 if(!$area ){$area ="sobre";}	

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
  case 'comocomprar':
  		$arquivo =  "comocomprar.php"; 
  		break;	
  case 'contato':
      $arquivo =  "contato.php"; 
      break;    
  case 'mapa':
      $arquivo =  "mapa.php"; 
      break;   

  default:
  		$arquivo =  "404.php"; 
  		break;	  		

}

include($arquivo);

?>