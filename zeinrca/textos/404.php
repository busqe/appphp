<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 

echo"{\"android\": [\n";  // { "android": [

$conexao01 = FN_conexao_banco(5);

if($conexao01){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $area = $_GET["area"];
   
    if(!$filtro ){$filtro ="aplicativo";}
    if(!$valor ){$valor ="exibir";}
    if(!$area ){$area ="sobre";}

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- area: " . $area . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){



$info[0]['TITULO']="ERRO 404";
$info[0]['TEXTO']="Pagina nao encontrada!";
$info[0]['ICONE']="0";
$info[0]['LINK']="0";
$info[0]['PUBLICAR']="1";

$contar = 0;
$total = count($info);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Informacao... <br />";

				   while($contar < $total) {

		
					    $inTitulo = $info[$contar]['TITULO']; 
						$inTexto = $info[$contar]['TEXTO']; 
						$inIcone = $info[$contar]['ICONE']; 
						$inPublicar = $info[$contar]['PUBLICAR'];  
						$inLink = $info[$contar]['LINK'];  
						

						if($contar < $total){

						$virgula =", ";
						}else{

						 $virgula ="";	 
						}

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$contar."\", \"ctCodigo\": \"".$ctCodigo."\",\"inTitulo\": \"".$inTitulo."\", \"inTexto\": \"".$inTexto."\",\"inIcone\": \"".$inIcone."\", \"inPublicar\": \"".$inPublicar."\",\"inLink\": \"".$inLink."\" }".$virgula." \n"; 
					
					$contar ++;
					}

					$mensagem .=  "Total de Informacao: $total <br />";

				}else{ // Categoria

				  $mensagem .=  "Categoria nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Informacao nao encontrada!\" ,\"syAcesso\":\"1516884933\"}";
				}

		}else{ // valor
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma valor!\" ,\"syAcesso\":\"1516884933\"}";
		}
 
	}else{ // filtro
		$mensagem .=  "Selecione um filtro!<br />";
		echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma filtro!\" ,\"syAcesso\":\"1516884933\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"1516884933\"}";
}


echo "]}";



if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>