<?php
 //PAGINA RESTRITA - SOMENTE USUARIO
$restrita="mestre";
//include "validacoes/validacao.php";
//verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>V Semana da Engenharia Civil  - Cadastro de Usuários</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilocss/estilo.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="document.FormMail.codigo_usuario.focus();" ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<table width="777"  border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="20" valign="top" > </td>
  </tr>
</table>
<form name="FormMail" method="post" action="mestre_acao_cadastro.php" onSubmit="return Validar();">
  <table width="448" border="1" align="center" cellpadding="0" cellspacing="0" >
    <tr bgcolor="#0099FF"> 
      <th height="36" colspan="2">&nbsp;Cadastro de Usu&aacute;rio</th>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="24" class="texto"><div align="right">Tipo:</div></td>
      <td><select name="cadastra_usuario">
          <option value="usuario">Usuario</option>
          <option value="mestre">Mestre</option>
        </select></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td width="142" height="24" class="texto"> <div align="right">Usu&aacute;rio:&nbsp;&nbsp;</div></td>
      <td width="300"><input name="codigo_usuario" type="text" class="form" size="10" maxlength="10"></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="24" class="texto"> <div align="right">Nome:&nbsp;&nbsp;</div></td>
      <td><input name="nome" type="text" class="form" size="30" maxlength="20"></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="24" class="texto"> <div align="right">Sobrenome:&nbsp;&nbsp;</div></td>
      <td><input name="sobrenome" type="text" class="form" size="40" maxlength="30"></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="24" class="texto"> <div align="right">E-mail:&nbsp;&nbsp;</div></td>
      <td><input name="nemail" type="text" class="form" size="50" maxlength="50"></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="24" class="texto"> <div align="right">Senha:&nbsp;&nbsp;</div></td>
      <td><input name="numero_senha" type="password" class="form" size="10" maxlength="16"></td>
    </tr>
    <tr class="texto" bgcolor="#0099FF"> 
      <td height="17"><div align="right">Senha novamente:&nbsp;&nbsp;</div></td>
      <td><input name="numero_senha2" type="password" class="form" size="10" maxlength="16"></td>
    </tr>
    <tr bgcolor="#0099FF"> 
      <td height="17">&nbsp;</td>
      <script language='JavaScript'>
   function Branco(s) {
      return ((s == null) || (s.length == 0))
   }
   function Senha(s){
      return((s.length < 6))
   }
   
   function Critica (campo, s)
   {
      campo.focus();
	  alert(s);
	  return (false);
	}
	
	function Validar() {
	   	   
	   if (Branco(document.FormMail.cadastra_usuario.value)) {
	      Critica(document.FormMail.cadastra_usuario, 'É necessário informar o departamento!');
		  return(false);
		}
	   if (Branco(document.FormMail.codigo_usuario.value)) {
	      Critica(document.FormMail.codigo_usuario, 'É necessário informar o usuário!');
		  return(false);
		}
	   if (Branco(document.FormMail.nome.value)) {
	      Critica(document.FormMail.nome, 'É necessário informar seu nome!');
		  return(false);
		}
	   if (Branco(document.FormMail.sobrenome.value)) {
	      Critica(document.FormMail.sobrenome, 'É necessário informar seu sobrenome!');
		  return(false);
		}
	   if (Branco(document.FormMail.nemail.value)) {
	      Critica(document.FormMail.nemail, 'É necessário informar o email!');
		  return(false);
		}

	  if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.FormMail.nemail.value)))
	  {
	  	Critica(document.FormMail.nemail, 'Informe um e-mail válido!');
		return (false);
	  }
	   if(Senha(document.FormMail.numero_senha.value)){
	      Critica(document.FormMail.numero_senha, 'Sua senha deve ter no mínimo seis digitos!');
		  return(false);
		 }
	   if (Branco(document.FormMail.numero_senha.value)) {
	      Critica(document.FormMail.numero_senha, 'É necessário informar o senha!');
		  return(false);
		}
	   if (Branco(document.FormMail.numero_senha2.value)) {
	      Critica(document.FormMail.numero_senha2, 'É necessário confirmar a senha!');
		  return(false);
		}

	
      return(true);
   }
  </script>
      <td> <input name="Cadastrar" type="submit" class="botao" value="Cadastrar">
        &nbsp;&nbsp;&nbsp; <input name="Limpar" type="reset" class="botao" value="Limpar"></td>
    </tr>
  </table>
</form>
<p>
<div align="center"><a href="login.php?acao=fim" target="sistema">Sair do Sistema</a> </div>
</p>
</body>
</html>
