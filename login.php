<?php

if(isset($_GET['acao']) && $_GET['acao']=='fim')
  {  logout(); }

function logout()
 {
   include "conexao/conexao.php";
   $usuario=$_COOKIE['usuario'];
   $sql= "DELETE FROM tb_quinsem_logado WHERE user_logado='$usuario'";
   $logout= mysql_query($sql) or die('erro');

   session_start();//inicia os dados de uma session
   session_destroy();//destroi os dados < back
      
   setcookie('id');
   setcookie('usuario');
   setcookie('senha');
 }
?>
<html>
<head>
<title>V Semana de Engenharia Civil - Sistema de Login - Bem Vindo Usuário!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilocss/estilo.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="0" marginwidth="0" onload="document.form1.usuario.focus()" ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<table width="777"  border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="93" valign="top" >
    <img src="imagens/logo_menu.jpg" width="776" height="80" border="0">
    </td>
  </tr>
  <tr> 
    <td height="52">&nbsp;</td>
  </tr>
  <tr> 
    <td height="114"> <form name="form1" method="post" action="validacoes/validacao.php" <?php if(!isset($_GET['acao'])){ echo "target=\"sistema\"";} ?> class="texto">
        <table width="140" border="1" align="center" >
          <tr bgcolor="#0099FF"> 
            <th colspan="2" > <div align="center">Sistema do Loga&ccedil;&atilde;o</div></th>
          </tr>
          <tr bgcolor="#0099FF" > 
            <td width="78" class="texto">Usuário</td>
            <td width="46"> <input name="usuario" type="text"></td>
          </tr>
          <tr bgcolor="#0099FF"> 
            <td class="texto">Senha</td>
            <td> <input name="senha" type="password"></td>
          </tr><input name="oculto" type="hidden" value="valida_validacao_php">
          <tr bgcolor="#0099FF"> 
            <td colspan="2"> <div align="center"> 
                <input name="submit" type="submit" value="Logar">
                <input name="reset" type="reset" id="reset" value="Limpar">
              </div></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr> 
    <td> <div align="center"><a href="javascript:close()"  target="sistema">Ainda não sou cadastrado</a> </div></td>
  </tr>
</table>
</body>
</html>
