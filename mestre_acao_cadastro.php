<?php
 //PAGINA RESTRITA - SOMENTE USUARIO
$restrita="mestre";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>V Semana da Engenharia Civil - Cadastro de usuários</title>
<link href="estilocss/estilo.css" rel="stylesheet" type="text/css">
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<?php
include "conexao/conexao.php";

$codigo_usuario=$_POST['codigo_usuario'];
$nome_completo= $_POST['nome']; $nome_completo.= " "; $nome_completo.= $_POST['sobrenome'];
$nemail= $_POST['nemail'];
$numero_senha= $_POST['numero_senha'];
$numero_senha2= $_POST['numero_senha2'];
$cadastra_usuario= $_POST['cadastra_usuario'];

if($numero_senha==$numero_senha2)
  {
    $sql= "INSERT INTO tb_quinsem_usuarios (nome, email, usuarios, senha, statos) values( '$nome_completo', '$nemail', '$codigo_usuario', '$numero_senha', '$cadastra_usuario')";
    $incluir_usuario= mysql_query($sql);
    $verifica_inclusao = mysql_affected_rows(); // verifica se houve alguma linha que foi incluida na tabela, valor 1.
    if($verifica_inclusao > 0)
      {
	    echo "<center><b>Usuário cadastrado com sucesso!</b>
		     <p><div align=\"center\"><a href=\"login.php?acao=fim\" target=\"sistema\">Sair do Sistema</a>
		     <br><a href=\"mestre_cadastro.php\" target=\"sistema\">Cadastrar Usuário</a>
			 </div></p>";
	  }
    else
      {
	   echo "<center><b>Não foi possível cadastrar Usuário!</b>
	         <p><div align=\"center\"><a href=\"javascript:history.go(-1);\"  target=\"sistema\">Voltar cadasto</a>
			 </div></p>";
	  }
  }
else
  {
	echo "<center><b>Não foi possível cadastrar Usuário!<br>A confirmação da senha não confere!</b>
	      <p><div align=\"center\"><a href=\"javascript:history.go(-1);\"  target=\"sistema\">Voltar cadasto</a>
		  </div></p>";
  }	 
?>
</body>
</html>
