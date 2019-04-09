<? 
include"../../../config/conexao/iss_connect.php"; 
$acao = $_GET["acao"];

$IDLINK = "555555";
$CODBAR = ($_GET['codigo']>0) ? $_GET['codigo'] : "0"; //"999999";
$CODUSO = ($_GET['us']>0) ? $_GET['us'] : 0; //"111111"; 
$CURTIDA = "0"; 
$DATA_HOJE = date('Y-m-d');


switch ($acao) {
	
	case '2':
		
		$msg_acao =  "Mensagem comentada com sucesso!";
		$tipo="true";
		break;

	case '3':
	$banco04 = FN_conexao_banco(4);
	$banco01 = FN_conexao_banco(1);	

	if(strlen($CODBAR)==6 && $CODUSO>0 ){

		//$banex01 = FN_conexao_externa(1);
		
		 $sqq_buscar = "SELECT * FROM  TAB_PRODUTO_TODOS WHERE CODBAR LIKE '".$CODBAR . "' LIMIT 1";
		 $sql_buscar = mysql_query($sqq_buscar, $banco04);
		 $tot_buscar = mysql_num_rows($sql_buscar);	
 
		 if($tot_buscar>0){
			$linha_busca = mysql_fetch_array($sql_buscar);
	 
			  $CODBAR = $linha_busca["CODBAR"];
			  $sql_checar = mysql_query("SELECT * FROM  TAB_PRODUTO_CURTIR 
			  	WHERE
			  	 CT_CODBAR LIKE '".$CODBAR."'
			  	 AND CT_CODUSO=". $CODUSO."
			  	 LIMIT 1", $banco01);
			 	 $tot_checar = mysql_num_rows($sql_checar);	
	
				if($tot_checar<1){
				// GRAVA
					$sq_grava = "INSERT INTO
					 TAB_PRODUTO_CURTIR(CT_CODBAR, CT_CODUSO, CT_DATA)
					 VALUES('".$CODBAR."','".$CODUSO."','".$DATA_HOJE."')";
					$rs_grava = mysql_query($sq_grava, $banco01);	
					
						$mensagem_inserir .= "Item: ".$CODBAR." INSERIDO com sucesso no Curtir!".$quebralinha."";
						$mensagem_status = "true";
						$mensagem_codigo = 200;	
				}else{

						 $sq_grava = "DELETE FROM TAB_PRODUTO_CURTIR 
						 WHERE 
						  CT_CODBAR='".$CODBAR."'
						  AND
						  CT_CODUSO='".$CODUSO."' ";
						 $rs_grava = mysql_query($sq_grava, $banco01);	

						$mensagem_inserir .= "O item: ".$CODBAR." ja EXISTE no Curtir!".$quebralinha."";
						$mensagem_status = "false";
						$mensagem_codigo = 201;				
				}

					echo  "<br /><br />" .$sq_grava ."<br /><br />";


		 }else{
				  $mensagem_inserir .= "O item: ".$CODBAR." nao foi ENCONTRADO! ".$quebralinha."";
				  $mensagem_status = "false";
				  $mensagem_codigo = 202;			
		 }


			$msg_acao = $mensagem_inserir   ;
		}else{
			$msg_acao =  "Erro ao curtir Mensagem!";	
		}

		$tipo="true";
		break;

	case '4':
		
		$msg_acao =  "Mensagem compartilhada com sucesso!";
		$tipo="true";
		break;
	
	default:
		
		$msg_acao =  "Ops. Algo deu errado!";
		$tipo="false";
		break;
}



echo"{\"curtir\": [\n";  

echo "{\"ver\": \"".$tipo."\",\"cod\": \"".time()."\",\"api\": \"".$IDLINK."\",\"idlink\": \"".$IDLINK."\",\"CODUSO\": \"".$CODUSO."\",\"codbar\": \"".$CODBAR."\", \"mensagem\": \"".$msg_acao."\",\"curtida\": \"".$CURTIDA."\" }";

echo "]}";


 
//echo($mensagem . "");
//echo $praonde;

?>