<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Banner: <br />";
include"../../../config/conexao/iss_connect.php"; 
$banco30 = FN_conexao_banco(30);

echo"{\"android\": [\n";  // { "android": [

if($banco30){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 10;
	$pagina = $pagina *  $itens_por_pagina;	
	

    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
    
    if(strlen($filtro)<1){  $filtro = "todos";}
    if(strlen($valor)<1){  $valor = "1";}
    if(strlen($termo)<1){  $termo = "teste";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}



    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

	 


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 		$sq_us = "SELECT * FROM  app1_banner_frame_online  ORDER  BY ORDEM ASC LIMIT 10 ";
		 		$rs_us = mysql_query( $sq_us, $banco30)or die(mysql_error($banco30)); //  or die(mysql_error())

				$mensagem .=  "Selecionando Banner... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Banners... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {
					   
					  // print_r($linha);
				 
				  	//$JSON_Banner_ATUAL = json_encode($Banner_dados ); 
				    //echo $JSON_Banner_ATUAL . "";

		
				    $bnCodigo = $linha['IDLINK']; 
					$bnNome = $linha['DESCRICAO']; 
					$bnSigla = "BN"; 
					$usHome= $linha['HOME']; 
					$bnPublicar = $linha['PUBLICAR']; 
					$bnTotal = 1; 
					$codico = (strlen($bnCodigo)<2) ? "0".$bnCodigo : $bnCodigo;	
					$bnIcone = "http://www.zein.com.br/ximages2/banner_frame/".$linha[ARQUIVO]."";
					

					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}
					//if($linha['TOTAL']>0){

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$ctCodigo."\", \"bnCodigo\": \"".$bnCodigo."\",\"bnNome\": \"".$bnNome."\", \"bnSigla\": \"".$bnSigla."\",\"bnPublicar\": \"".$bnPublicar."\", \"bnTotal\": \"".$bnTotal."\",\"bnIcone\": \"".$bnIcone."\" }".$virgula." \n"; 
					
					//}
					
					$contar ++;
					}

					$mensagem .=  "Total de Banners: $total <br />";

				}else{ // Banner

				  $mensagem .=  "Banner nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Banner nao encontrada!\" ,\"syAcesso\":\"".time()."\"}";
				}

		}else{ // valor
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma valor!\" ,\"syAcesso\":\"".time()."\"}";
		}
 
	}else{ // filtro
		$mensagem .=  "Selecione um filtro!<br />";
		echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma filtro!\" ,\"syAcesso\":\"".time()."\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"".time()."\"}";
}


echo "]}";



if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>