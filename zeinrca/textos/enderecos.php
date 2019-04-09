<?  header('Content-Type: text/html; charset=utf-8');
/* 

?area=contato&filtro=contato&valor=1

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



$info[0]['TITULO']="SHOWROOM";
$info[0]['TEXTO']="Tel.: (11) 3227.1299";
$info[0]['ENDERECO']="Av. Senador Queiróz, 274 - 12 e 13 andares - Centro - São Paulo/SP";
$info[0]['CIDADE']="Centro - São Paulo/SP";
$info[0]['ICONE']="0";
$info[0]['LINK']="0";
$info[0]['PUBLICAR']="1";

$info[1]['TITULO']="TELEVENDAS";
$info[1]['TEXTO']="Tel.: (11) 3324.6409";
$info[1]['ENDERECO']="rfelipe@zeinimport.com.br";
$info[1]['CIDADE']="www.zein.com.br";
$info[1]['ICONE']="0";
$info[1]['LINK']="0";
$info[1]['PUBLICAR']="1";

$info[2]['TITULO']="ATENDIMENTO";
$info[2]['TEXTO']="8hs as 18hs";
$info[2]['ENDERECO']="rfelipe@zeinimport.com.br";
$info[2]['CIDADE']="De seg. a sexta-feira , Sabados - 8hs as 13hs";
$info[2]['ICONE']="0";
$info[2]['LINK']="0";
$info[2]['PUBLICAR']="1";


$contar = 0;
$total = count($info);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Categorias... <br />";

				   while($contar < $total) {

		
					    $inCodigo = ($contar+1); 
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

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$contar."\", \"inCodigo\": \"".$inCodigo."\",\"inTitulo\": \"".$inTitulo."\", \"inTexto\": \"".$inTexto."\",\"inIcone\": \"".$inIcone."\", \"inPublicar\": \"".$inPublicar."\",\"inLink\": \"".$inLink."\" }".$virgula." \n"; 
					
					$contar ++;
					}

					$mensagem .=  "Total de Categorias: $total <br />";

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