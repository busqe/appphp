<? 
/* 

?filtro=codigo&valor=834276&pg=0

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 

echo"{\"android\": [\n";  // { "android": [

if($banco01){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 1;
	$pagina = $pagina *  $itens_por_pagina;	
	

    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
    
    if(strlen($filtro)<1){  $filtro = "codigo";}
    if(strlen($valor)<1){  $valor = "834276";} //834490 837992 834276
    if(strlen($termo)<1){  $termo = "teste";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}


    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){

				$mensagem .=  "Conectando... <br />";

		 		$sq_us = "SELECT * FROM  A01_LICENCIADO  WHERE CODBAR='".$valor."'  LIMIT 1 "; //".$pagina.",".$itens_por_pagina." 
		 		$rs_us = mysql_query( $sq_us, $banco01)or die(mysql_error($banco01)); //  or die(mysql_error())

				$mensagem .=  "Selecionando Produto... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				///echo "<H3>" .$sq_us ." -- TOTAL: " .$total ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Produtos... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

		
		  				$CODCOM = $linha['CODCOM']; 
						$CODBAR = $linha["CODBAR"];
						$CODFORN =  $linha["CODFORN"];

						$PUBLICAR =	"1";
						


					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}



			   		if($filtro=='codigo' && $banco00){

	            		$sq_sort = "SELECT * FROM TAB_SORTIMENTO_TEMP 
	                    WHERE CODBAR='".$valor."' ORDER BY CODBAR ASC LIMIT 20";
	                    
	                    $rs_sort = mysql_query($sq_sort, $banco06);
	                    $to_sort = mysql_num_rows($rs_sort);

	                    $mensagem .=  "Total de Sortimentos: $to_sort <br />";
	                    
						$contar = 0;
	                    if($to_sort>0){
	                          while($linha_sort = mysql_fetch_array($rs_sort))
	                          {
									if($contar < ($to_sort-1)){
										$virgula =", ";
									}else{
									 $virgula ="";	 
									}
								$SORTIMENTO .= $linha_sort["SORT_IMG"]."" .  $virgula; 
								
								$contar ++;

	                          }
	                    }else{
	                        $dados_sort = $linha["CODBAR"]."jpg";
							$SORTIMENTO = "0";
	                    }	
					}else{

						$mensagem .=  "Sortimentos nao selecionados.<br />";
						$SORTIMENTO = "0";
					}


				$SORTIMENTO = $SORTIMENTO;
				$TOTAL = $to_sort;



echo "{\"ver\": \"1\",
\"cod\": \"".time()."\",\"api\": \"".$CODBAR."\",\"codcom\": \"".$CODCOM."\",\"codbar\": \"".$CODBAR."\",\"publicar\": \"".$PUBLICAR."\" 
,\"sortimento\": \"".$SORTIMENTO."\",\"total\": \"".$TOTAL."\"
 }".$virgula."\n"; 

			
					$contar ++;
					}

					$mensagem .=  "Total de Produtos: $total <br />";

				}else{ // Produto

				  $mensagem .=  "Produto nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Produto nao encontrada!\" ,\"syAcesso\":\"1516884933\"}";
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