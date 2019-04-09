<?  header('Content-Type: text/html; charset=utf-8');
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 

echo"{\"android\": [\n";  // { "android": [

if($conexao01){

     $area = $_GET["area"];
    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
   
   
    if(!$area ){$area ="sobre";}
    if(!$filtro ){$filtro ="aplicativo";}
    if(!$valor ){$valor ="exibir";}
   

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- area: " . $area . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){



$info[0]['TITULO']="O APLICATIVO";
$info[0]['TEXTO']="O aplicativo ISSAM possui informações para composição de custos de frete, medidas, códigos e divisões em subgrupos de produtos para facilitar a leitura e agilizar o processo de compra.";
$info[0]['ICONE']="0";
$info[0]['LINK']="0";
$info[0]['PUBLICAR']="1";

$info[1]['TITULO']="DADOS DE PRODUTOS";
$info[1]['TEXTO']="Dimensões: As dimensões informadas neste aplicativo são nominais, sujeitas a pequenas variações. Imagens: As imagens são mostradas apenas com finalidade ilustrativa, podendo variar em cores, medidas e padrões.";
$info[1]['ICONE']="0";
$info[1]['LINK']="0";
$info[1]['PUBLICAR']="1";

$info[2]['TITULO']="EQUIPE";
$info[2]['TEXTO']="Dispomos de uma equipe altamente capacitada, com representantes comerciais cobrindo todo o território nacional, além de um amplo showroom estrategicamente localizado no centro de São Paulo capital.";
$info[2]['ICONE']="0";
$info[2]['LINK']="0";
$info[2]['PUBLICAR']="1";

$info[3]['TITULO']="INFORMAÇÕES";
$info[3]['TEXTO']="Para demais informações, a ISSAM disponibiliza Central de Atendimento (11) 3224-6400 em horário comercial de segunda à sexta-feira.";
$info[3]['ICONE']="0";
$info[3]['LINK']="0";
$info[3]['PUBLICAR']="1";

$info[4]['TITULO']="DIREITOS";
$info[4]['TEXTO']="A ISSAM  reserva-se o direito de fazer alterações em seus produtos sem prévio aviso ou excluir qualquer item de linha mediante durabilidade dos nossos estoques.";
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
						$inLink = $info[$contar]['LINK'];  
						$inPublicar = $info[$contar]['PUBLICAR'];  

						if($contar < ($total-1)){

							$virgula =", ";
						}else{

							 $virgula ="";	 
						}

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$contar."\", \"inCodigo\": \"".$inCodigo."\",\"inTitulo\": \"".$inTitulo."\", \"inTexto\": \"".$inTexto."\",\"inIcone\": \"".$inIcone."\", \"inLink\": \"".$inLink."\", \"inPublicar\": \"".$inPublicar."\" }".$virgula." \n"; 
					
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