<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<link href="estilocss/estilo.css" rel="stylesheet" type="text/css">
</head>
<base target="centro">
<body  topmargin="0" >
<table cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top"> <img src="imagens/logo_menu.jpg" width="776" height="80" border="0"></td>
  </tr>
</table>
<table cellpadding="0" width="776">
  <tr>
    <td class="menu" width="14%">
      <div align="center"><font color="#0066CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>..:: <a href="cadastro_alunos.php" target="centro">Cadastrar</a> ::..</strong></font></div>
    </td>
    <td class="menu" width="20%">
      <div align="center"><font color="#0066CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>..:: <a href="cadastro_alunos_pesquisa.php" target="centro">Pesquisar cadastro</a> :::...</strong></font></div>
    </td>
    <td class="menu" width="15%">
      <div align="center"><font color="#0066CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>..:: <a href="minicursos.php" target="centro">Minicursos</a> ::..</strong></font></div>
    </td>
    <td class="menu" width="15%">
      <div align="center"><font color="#0066CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>..:: <a href="gerar_certificado.php" target="centro">Certificado</a> ::..</strong></font></div>
    </td>
    <td class="menu" width="18%">
      <div align="center"><font color="#0066CC" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>..:: <a href="login.php?acao=fim" target="sistema">Sair do sistema</a> ::..</strong></font></div>
    </td>
  </tr>
</table>
</body>
</html>
