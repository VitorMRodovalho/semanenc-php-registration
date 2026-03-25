<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
  <title>Excluir Cadastro</title>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<?
if(!empty($_GET['acao']) && ($_GET['acao'] == 'excluir'))
  {
    $acao = $_GET['acao'];
    $pesquisa = $_GET['pesquisa'];

    $funcao = $acao($pesquisa);
  }
else
  {
?>
      <tr>
        <td colspan="2" class="formulario_ex2"> <div align="center"><b>Procedimento incorreto!</b>
        </div></td>
      </tr>
<?php
  }

function excluir($id)
  {
     include "conexao/conexao.php";
     
     $sql = "DELETE FROM tb_quinsem_alunos WHERE id = $id;";
     $excluir = mysql_query($sql);
     if($excluir)
      {
        echo "<center><b>Cadastro excluido com sucesso!</b>";
	  }
     else
      {
	    echo "<center><b>Erro: </b>".mysql_error()."<br><b>Não foi possível excluir cadastro!</b>";
	  }
    $fecha = mysql_close();
  }
?>
</body>
</body>
