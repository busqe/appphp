<?

$pagina = $_GET["pg"];
if($pagina<1){$pagina=1;}
$pagina = $pagina-1;

$itens_por_pagina = 20;
$pagina = $pagina *  $itens_por_pagina;	



	
echo "
{
	\"android\": [
";	
  $x = $pagina;
  $z= $pagina + $itens_por_pagina;
  while($x < $z){
	  
	  if($x < ($z-1)){
	  		$virgula =",";
	  }else{
	  	   $virgula ="";
	  }
	  
	echo "
    {
		\"ver\": \"".$x."\",
		\"name\": \"Categoria ".$x."\",
		\"api\": \"Produtos: ".$x."\"
	}" .$virgula;
  
  $x ++;
	}
echo "
    ]
}
";	
?>  
