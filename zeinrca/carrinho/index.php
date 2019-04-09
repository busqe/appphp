<?
$acao = (strlen($_GET["acao"])>0) ? $_GET["acao"] : $_POST["acao"];
//inserir, alterar, excluir, finalizar  

switch ($acao) {
	case 'inserir':
	case 'alterar':
	case 'excluir':
		$arquivo_abrir_acao ="carrinho_editar.php";
		break;
	case 'finalizar':
		$arquivo_abrir_acao ="carrinho_finalizar.php";
		break;
	default:
		$arquivo_abrir_acao ="carrinho_listar.php";
		break;
}


//exit("ACAO:" . $acao ."<br />");

include($arquivo_abrir_acao);

?>