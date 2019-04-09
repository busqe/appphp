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


$info[0]['TITULO']="Tire suas dúvidas a respeito das compras no site.";
$info[0]['TEXTO']="Venda somente para pessoa jurídica (CNPJ);- Fotos ilustrativas (PRODUTOS); Produtos atualizados diariamente; (Verifique disponibilidade)";
$info[0]['ENDERECO']="0";
$info[0]['CIDADE']="0";
$info[0]['ICONE']="0";
$info[0]['LINK']="0";
$info[0]['PUBLICAR']="1";

$info[1]['TITULO']="Serviço de Atendimento ao Cliente:";
$info[1]['TEXTO']="Contamos com uma equipe de profissionais qualificada e experiente para atendê-lo com praticidade e qualidade além de esclarecer todas as suas dúvidas. Entre em contato com a nossa Central de Atendimento";
$info[1]['ENDERECO']="0";
$info[1]['CIDADE']="0";
$info[1]['ICONE']="0";
$info[1]['LINK']="0";
$info[1]['PUBLICAR']="1";

$info[2]['TITULO']="SHOWROOM";
$info[2]['TEXTO']="Tel.: (11) 3227.1299";
$info[2]['ENDERECO']="Av. Senador Queiróz, 274 - 12 e 13 andares - Centro - São Paulo/SP";
$info[2]['CIDADE']="Centro - São Paulo/SP";
$info[2]['ICONE']="0";
$info[2]['LINK']="0";
$info[2]['PUBLICAR']="1";

$info[3]['TITULO']="TELEVENDAS";
$info[3]['TEXTO']="Tel.: (11) 3324.6409";
$info[3]['ENDERECO']="rfelipe@zeinimport.com.br";
$info[3]['CIDADE']="www.zein.com.br";
$info[3]['ICONE']="0";
$info[3]['LINK']="0";
$info[3]['PUBLICAR']="1";

$info[4]['TITULO']="ATENDIMENTO";
$info[4]['TEXTO']="8hs as 18hs";
$info[4]['ENDERECO']="rfelipe@zeinimport.com.br";
$info[4]['CIDADE']="De seg. a sexta-feira , Sabados - 8hs as 13hs";
$info[4]['ICONE']="0";
$info[4]['LINK']="0";
$info[4]['PUBLICAR']="1";


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