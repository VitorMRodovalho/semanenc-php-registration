<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>Pesquisa de Cadastro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
<script language='JavaScript'>
function Validar()
   {
     if(document.form_pesquisas.opcao[0].checked == true)
       {
          if (Branco(document.form_pesquisas.pesquisa.value) || (document.form_pesquisas.pesquisa.value.length != 4))
               {
	             Critica(document.form_pesquisas.pesquisa, 'Informe corretamente o número de inscrição! \n Apenas números com 4 digítos.');
		         return(false);
		       }
       }
     if(document.form_pesquisas.opcao[1].checked == true)
       {
          if (Branco(document.form_pesquisas.pesquisa.value))
               {
	             Critica(document.form_pesquisas.pesquisa, 'É necessário digitar alguma letra!');
		         return(false);
		       }
       }
    }
function apaga()
  {
    document.form_pesquisas.pesquisa.value = '';
    document.form_pesquisas.pesquisa.focus();
  }
function so_numeros(src)
   {
     if(document.form_pesquisas.opcao[0].checked == true)
       {
          var i = src.value.length;
      	  var ascii = event.keyCode;
 		      if ((ascii > 47) && (ascii < 58))
                 { return }
		      else
                 { event.keyCode = 0 }
       }
	}
function Branco(s)
   {
      return ((s == null) || (s.length == 0))
   }
function Critica (campo, s)
   {
      campo.focus();
	  alert(s);
	  return (false);
	}
</script>
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<form name="form_pesquisas" method="get" action="cadastro_alunos_pesquisa_acao.php" onSubmit="return Validar();">
  <table border="0" class="formulario_geral">
    <tr>
      <td colspan="4" class="formulario_cor"> <div align="center">Procurar Cadastros:</div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">
          <input name="pesquisa" type="text" class="caixa" size="60" onKeyPress="so_numeros(this)">
        </div></td>
    </tr>
    <tr>
      <td colspan="4" class="formulario_cor"> <div align="center">Op&ccedil;&otilde;es:</div></td>
    </tr>
    <tr>
      <td>Pesquisar por:</td>
      <td class="formulario_ex">
      <input type="radio" name="opcao" value="numero" onClick="apaga()" checked >
        N&uacute;mero de Inscri&ccedil;&atilde;o</td>
      <td>&nbsp;</td>
      <td class="formulario_ex">
      <input type="radio" name="opcao" value="aluno" onClick="apaga()">
        Nome do Aluno</td>
    </tr>
    <tr>
      <td></td>
      <td class="formulario_ex">
      <input type="radio" name="opcao" value="todos" onClick="apaga()">
        Total cadastrados</td>
      <td>&nbsp;</td>
      <td class="formulario_ex">
      <input type="radio" name="opcao" value="ueg" onClick="apaga()">
        Total UEG</td>
    </tr>
    <tr>
      <td></td>
      <td class="formulario_ex">
      <input type="radio" name="opcao" value="outras" onClick="apaga()">
        Total outras</td>
      <td>&nbsp;</td>
      <td class="formulario_ex">
      </td>
    </tr>
    <tr>
      <td colspan="4" class="formulario_cor"><div align="center">
          <input type="hidden" name="acao" value="busca">
          <input type="submit" value="Pesquisar">
          <input type="button" value="Pesquisa avançada" onclick="window.open('cadastro_alunos_pesquisa_avancada.php','centro');">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
