<?  header('Content-Type: text/html; charset=utf-8');

/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 
$conexao01 = FN_conexao_banco(5);


echo"{\"android\": [\n";  // { "android": [

if($conexao01){

     $area = $_GET["area"];
    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
   
   
    if(!$area ){$area ="sobre";}
    if(!$filtro ){$filtro ="aplicativo";}
    if(!$valor ){$valor ="exibir";}
   
    $pagina = $_GET["pg"];
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 10;
	$pagina = $pagina *  $itens_por_pagina;	


	$data_codigo = date('Ymd');
	$dias_emana = array('domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado');
	$data_hoje = date('Y-m-d');
	$dia_semana_numero = date('w', strtotime($data_hoje));
	
	// ximages/social/issam/2018/2018-03-01/aplicativo/2018-03-01__quinta__botao3_issam.jpg

	$EMPRESA_NOME = "issam";
	$EMPRESA_FILIAL = "issam";
	$ENDERECO_GERAL = "http://www.zein.com.br/hotsite/18/site/licenciados/images/app/";

	

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- area: " . $area . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){

// grande ---



$data_banners_home = $data_hoje . "__" . $dias_emana[$dia_semana_numero] ."__";
$data_banners_home="";
$remove_cache ="?" . time();
$remove_cache="";

$info[0]['CODIGO']= ($data_codigo + 1);
$info[0]['NOME']="BANNER";
$info[0]['TEXTO']="0";
$info[0]['ICONE']="0";
$info[0]['IMAGEM'] = $ENDERECO_GERAL . $data_banners_home . "quadrado1_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[0]['LINK']="0";
$info[0]['FILTRO']="PRODUTO";
$info[0]['VALOR']="838917";
$info[0]['LAYOUT']="quadrado";
$info[0]['PUBLICAR']="1";

// botao ---

$info[1]['CODIGO']= ($data_codigo + 2);
$info[1]['NOME']="BANNER";
$info[1]['TEXTO']="0";
$info[1]['ICONE']="0";
$info[1]['IMAGEM'] = $ENDERECO_GERAL . $data_banners_home . "botao1_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[1]['LINK']="0";
$info[1]['FILTRO']="CATEGORIAS";
$info[1]['VALOR']="5";
$info[1]['LAYOUT']="botao";
$info[1]['PUBLICAR']="1";

$info[2]['CODIGO']= ($data_codigo + 3);
$info[2]['NOME']="BANNER";
$info[2]['TEXTO']="0";
$info[2]['ICONE']="0";
$info[2]['IMAGEM']= $ENDERECO_GERAL . $data_banners_home . "botao2_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[2]['LINK']="0";
$info[2]['FILTRO']="CATEGORIAS";
$info[2]['VALOR']="3";
$info[2]['LAYOUT']="botao";
$info[2]['PUBLICAR']="1";

$info[3]['CODIGO']= ($data_codigo + 4);
$info[3]['NOME']="BANNER";
$info[3]['TEXTO']="0";
$info[3]['ICONE']="0";
$info[3]['IMAGEM']= $ENDERECO_GERAL . $data_banners_home . "botao3_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[3]['LINK']="0";
$info[3]['FILTRO']="CATEGORIAS";
$info[3]['VALOR']="2";
$info[3]['LAYOUT']="botao";
$info[3]['PUBLICAR']="1";

$info[4]['CODIGO']= ($data_codigo + 5);
$info[4]['NOME']="BANNER";
$info[4]['TEXTO']="0";
$info[4]['ICONE']="0";
$info[4]['IMAGEM']= $ENDERECO_GERAL . $data_banners_home . "botao4_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[4]['LINK']="0";
$info[4]['FILTRO']="CATEGORIAS";
$info[4]['VALOR']="8";
$info[4]['LAYOUT']="botao";
$info[4]['PUBLICAR']="1";

// horizontal ---

$info[5]['CODIGO']= ($data_codigo + 6);
$info[5]['NOME']="BANNER";
$info[5]['TEXTO']="0";
$info[5]['ICONE']="0";
$info[5]['IMAGEM'] = $ENDERECO_GERAL .  $data_banners_home . "horizontal1b_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[5]['LINK']="produto=860141";
$info[5]['FILTRO']="FORNECEDORES";
$info[5]['VALOR']="3";
$info[5]['LAYOUT']="horizontal";
$info[5]['PUBLICAR']="1";

$info[6]['CODIGO']= ($data_codigo + 7);
$info[6]['NOME']="BANNER";
$info[6]['TEXTO']="0";
$info[6]['ICONE']="0";
$info[6]['IMAGEM'] = $ENDERECO_GERAL . $data_banners_home . "horizontal2b_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[6]['LINK']="0";
$info[6]['FILTRO']="CATEGORIAS";
$info[6]['VALOR']="2";
$info[6]['LAYOUT']="horizontal";
$info[6]['PUBLICAR']="1";

$info[7]['CODIGO']= ($data_codigo + 8);
$info[7]['NOME']="BANNER";
$info[7]['TEXTO']="0";
$info[7]['ICONE']="0";
$info[7]['IMAGEM']=   $ENDERECO_GERAL . $data_banners_home . "horizontal3_".$EMPRESA_FILIAL .".jpg". $remove_cache;
$info[7]['LINK']="0";
$info[7]['FILTRO']="CATEGORIAS";
$info[7]['VALOR']="11";
$info[7]['LAYOUT']="horizontal";
$info[7]['PUBLICAR']="1";

// contatos ---

$info[8]['CODIGO']= ($data_codigo + 9);
$info[8]['NOME']="Representante da Região"; 
$info[8]['TEXTO']="Tel.: (11) 3324-6400"; 
$info[8]['ICONE']="ico_fone.png";
$info[8]['IMAGEM']="0";
$info[8]['LINK']="0";
$info[8]['FILTRO']="contato";
$info[8]['VALOR']="1";
$info[8]['LAYOUT']="0";
$info[8]['PUBLICAR']="1";


$info[9]['CODIGO']= ($data_codigo + 10);
$info[9]['NOME']="Vendas Externas";
$info[9]['TEXTO']="+55 (11) 3324.6400";
$info[9]['ICONE']="ico_fone.png";
$info[9]['IMAGEM']="0";
$info[9]['LINK']="0";
$info[9]['FILTRO']="contato";
$info[9]['VALOR']="1";
$info[9]['LAYOUT']="0";
$info[9]['PUBLICAR']="1";


$info[10]['CODIGO']= ($data_codigo + 11);
$info[10]['NOME']=" SAC";
$info[10]['TEXTO']="+55 (11) 3224.6400 R:6492";
$info[10]['ICONE']="ico_fone.png";
$info[10]['IMAGEM']="0";
$info[10]['LINK']="01";
$info[10]['FILTRO']="contato";
$info[10]['VALOR']="1";
$info[10]['LAYOUT']="0";
$info[10]['PUBLICAR']="1";


$info[11]['CODIGO']= ($data_codigo + 12);
$info[11]['NOME']="Av. Senador Queiróz, 274 - 12 e 13 andares";
$info[11]['TEXTO']="Centro - São Paulo/SP, Centro, São Paulo/SP";
$info[11]['ICONE']="ico_fone.png";
$info[11]['IMAGEM']="0";
$info[11]['LINK']="01";
$info[11]['FILTRO']="contato";
$info[11]['VALOR']="1";
$info[11]['LAYOUT']="0";
$info[11]['PUBLICAR']="1";

$info[12]['CODIGO']= ($data_codigo + 13);
$info[12]['NOME']="Website";
$info[12]['TEXTO']="www.zein.com.br";
$info[12]['ICONE']="ico_fone.png";
$info[12]['IMAGEM']="0";
$info[12]['LINK']="01";
$info[12]['FILTRO']="contato";
$info[12]['VALOR']="1";
$info[12]['LAYOUT']="0";
$info[12]['PUBLICAR']="1";

$info[13]['CODIGO']= ($data_codigo + 14);
$info[13]['NOME']="Facebook";
$info[13]['TEXTO']="ZeinImportados";
$info[13]['ICONE']="ico_social_fb.png";
$info[13]['IMAGEM']="0";
$info[13]['LINK']="01";
$info[13]['FILTRO']="contato";
$info[13]['VALOR']="1";
$info[13]['LAYOUT']="0";
$info[13]['PUBLICAR']="1";

$info[14]['CODIGO']= ($data_codigo + 15);
$info[14]['NOME']="Instagram";
$info[14]['TEXTO']="zein_importadora";
$info[14]['ICONE']="ico_social_ig.png";
$info[14]['IMAGEM']="0";
$info[14]['LINK']="01";
$info[14]['FILTRO']="contato";
$info[14]['VALOR']="1";
$info[14]['LAYOUT']="0";
$info[14]['PUBLICAR']="1";




$contar = 0;
$total = count($info);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0 && $pagina < 2)
				{

					$mensagem .=  "Listando Categorias... <br />";

				   while($contar < $total) {

		
					    $pbCodigo = $info[$contar]['CODIGO']; 
					    $pbNome = $info[$contar]['NOME']; 
						$pbTexto = $info[$contar]['TEXTO']; 
						$pbImagem = $info[$contar]['IMAGEM']; 
						$pbLink = $info[$contar]['LINK'];  
						$pbLayout = $info[$contar]['LAYOUT'];
						$pbFiltro = $info[$contar]['FILTRO'];  
						$pbValor = $info[$contar]['VALOR'];  
						$pbPublicar = $info[$contar]['PUBLICAR'];  

						if($contar < ($total-1)){

							$virgula =", ";
						}else{

							 $virgula ="";	 
						}

//$marcador = ($contar+1);

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$contar."\", \"pbCodigo\": \"".$pbCodigo."\",\"pbNome\": \"".$pbNome."\", \"pbTexto\": \"".$pbTexto."\",\"pbImagem\": \"".$pbImagem."\", \"pbLink\": \"".$pbLink."\", \"pbLayout\": \"".$pbLayout."\",\"pbFiltro\": \"".$pbFiltro."\",\"pbValor\": \"".$pbValor."\", \"pbPublicar\": \"".$pbPublicar."\" }".$virgula." \n"; 
					
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