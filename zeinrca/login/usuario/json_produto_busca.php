<? 
$mensagem = "<br /><br />Mensagens de usuario: <br />";
include"../../../../config/conexao/iss_connect.php"; 


if($banco01){

    $codigo = $_GET["pd_codigo"];
    $acao = $_GET["pd_acao"];

    if($codigo<1){ $codigo = $_POST["pd_codigo"];}
    if(strlen($acao)<1){ $acao = $_POST["pd_acao"];}
    //if(!$acao ){$acao ="exibir";}

	if($codigo>0){	
		if($acao=="exibir"){

			$mensagem .=  "Conectando... <br />";

		 	$sq_us = mysql_query("SELECT 
		 		CODCOM as barcode, 
		 		CODBAR as reduzido, 
		 		DESCRICAO as nome,
		 		CODFORN as codforn,
				FABRICANTE as fornecedor
		 		FROM  A01_LICENCIADO WHERE CODCOM = '".$codigo."' LIMIT 1", $banco01);

				$mensagem .=  "Selecionando usuario... <br />";

		 		if(mysql_num_rows($sq_us) > 0)
				{
				   $linha = mysql_fetch_array($sq_us);
				  
				   $mensagem .=  "Listado usuario... <br />";

				   	$produto_dados = array();
				    $produto_dados["syMsg"] = "true"; 
				    $produto_dados["barcode"] = $linha['barcode']; 
					$produto_dados["reduzido"] = $linha['reduzido']; 
					$produto_dados["nome"] = $linha['nome']; 
					$produto_dados["codforn"] = $linha['codforn']; 
					$produto_dados["syAcesso"] = "".time().""; 
					//$produto_dados = $linha['usoSetor']; 
					//$produto_dados = $linha['usoNivel']; 
					//$produto_dados = $setCod;

				 
				  	$JSON_PRODUTO_ATUAL = json_encode($produto_dados ); 
				    echo $JSON_PRODUTO_ATUAL . "";


					$mensagem .=  "Produto: $usoNom <br />";
			
			
				}else{ // usuario

				  $mensagem .=  "Produto nao encontrado! <br />";
				  echo "{\"syMsg\":\"false\",\"mensagem\":\"Usuario nao encontrado!\" ,\"syAcesso\":\"1516884933\"}";
				}

		}else{ // usuario
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"syMsg\":\"false\",\"mensagem\":\"Selecione uma acao!\" ,\"syAcesso\":\"1516884933\"}";
		}
 
	}else{ // usuario
		$mensagem .=  "Selecione um produto!<br />";
		echo "{\"syMsg\":\"false\",\"mensagem\":\"Selecione uma acao!\" ,\"syAcesso\":\"1516884933\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"syMsg\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"1516884933\"}";
}


if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>