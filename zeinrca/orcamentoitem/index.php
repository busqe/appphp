<?
$acao = (strlen($_GET["acao"])>0) ? $_GET["acao"] : $_POST["acao"];
//inserir, alterar, excluir, finalizar  

switch ($acao) {
	case 'listar':
		$arquivo_abrir_acao ="orcamento_item_listar.php";
		break;
	case 'exibir':
		$arquivo_abrir_acao ="orcamento_item_exibir.php";
		break;
	default:
		$arquivo_abrir_acao ="orcamento_item_listar.php";
		break;
}


//exit("ACAO:" . $acao ."<br />");

include($arquivo_abrir_acao);

?>