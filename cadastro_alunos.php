<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>Cadastro de Alunos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
<script language='JavaScript'>
function Validar()
   {
          if (Branco(document.form_cadastro.nome_aluno.value))
               {
	             Critica(document.form_cadastro.nome_aluno, 'É necessário informar o nome do aluno!');
		         return(false);
		       }
           if (Branco(document.form_cadastro.datanasc.value) || (document.form_cadastro.datanasc.value.length != 10 ))
               {
	             Critica(document.form_cadastro.datanasc, ' É necessário informar a data do nascimento. \n Informe corretamente a data.');
		         return(false);
               }
            else
              {
                confirmar = confirm("Confirmar cadastro?")
                if(confirmar==false)
                  {  return(false); }
                else
                  {  return(true);  }
              }
    }
function so_numeros(src, mask)
   {
	var i = src.value.length;
    var saida = mask.substring(i,i+1);
	var ascii = event.keyCode;
	if (saida == "0") {
		if ((ascii >= 48) && (ascii <= 57)) { return }
		else { event.keyCode = 0 }
	} else  {
		src.value += saida;
		i += 1
		saida = mask.substring(i,i+1);
        if (saida == "0") {
				if ((ascii >= 48) && (ascii <= 57)) { return }
				else { event.keyCode = 0 }
		} else { return; }
	  }
	}
function verifica_numeros(src)
   {
          var i = src.value.length;
      	  var ascii = event.keyCode;
 		      if ((ascii >= 45) && (ascii <= 57))
                 { return }
		      else
                 { event.keyCode = 0 }
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
<form name="form_cadastro" method="post" action="cadastro_alunos_acao.php" onSubmit="return Validar();">
  <table border="0" class="formulario_geral">
    <tr> 
      <td colspan="4" class="formulario_cor"> <div align="center">Cadastro de 
          Alunos:</div></td>
    </tr>
    <tr> 
      <td>Nome:</td>
      <td colspan="3"><input name="nome_aluno" type="text" class="caixa" size="60" maxlength="40"></td>
    </tr>
    <tr> 
      <td>D. Identidade:</td>
      <td><input name="identidade" type="text"  maxlength="15" size="11" class="caixa" onKeyPress="verifica_numeros(this)"></td>
      <td>Org. Expedidor</td>
      <td>
          <select name="expedidor" class="caixa">
            <option value="SSP">SSP</option>
            <option value="DGPC" >DGPC</option>
            <option value="SPTC" >SPTC</option>
          </select>
          <select name="exp_estado" class="caixa">
            <option value="AC">AC</option>
            <option value="AL" >AL</option>
			<option value="AM" >AM</option>
			<option value="AP" >AP</option>
			<option value="BA">BA</option>
			<option value="CE">CE</option>
			<option value="DF">DF</option>
			<option value="ES">ES</option>
			<option value="GO">GO</option>
			<option value="MA">MA</option>
			<option value="MG">MG</option>
			<option value="MS">MS</option>
			<option value="MT">MT</option>
			<option value="PA">PA</option>
			<option value="PB">PB</option>
			<option value="PE">PE</option>
			<option value="PI">PI</option>
			<option value="PR">PR</option>
			<option value="RJ">RJ</option>
			<option value="RN">RN</option>
			<option value="RO">RO</option>
			<option value="RR">RR</option>
			<option value="RS">RS</option>
			<option value="SC">SC</option>
			<option value="SE">SE</option>
			<option value="SP">SP</option>
			<option value="TO">TO</option>
          </select></td>
    </tr>
    <tr>
      <td>Data de Nasc:</td>
      <td><input name="datanasc" type="text" class="caixa" size="7" maxlength="10" onKeyPress="so_numeros(this,'00/00/0000')"></td>
      <td>Data Inscrição:</td>
      <td><input name="data_criacao" type="text" class="caixa" size="7" maxlength="10" onKeyPress="so_numeros(this,'00/00/0000')"></td>
    </tr>
    <tr> 
      <td colspan="4" class="formulario_cor"><div align="center">Universidade</div></td>
    </tr>
    <tr> 
      <td>Universidade:</td>
      <td colspan="3"><input name="universidade" type="text" class="caixa" size="50" maxlength="50">
         <select name="aluno_ueg" class="caixa">
            <option value="ueg">UEG</option>
            <option value="out">Outras</option>
          </select></td>
    </tr>
    <tr> 
      <td>Cidade:</td>
      <td><input name="cidade_univer" type="text" class="caixa" maxlength="30"></td>
      <td>Per&iacute;odo/Ano:</td>
      <td><select name="periodo" class="caixa">
          <option value="1º período" >1º período</option>
          <option value="2º período">2º período</option>
          <option value="3º período">3º período</option>
          <option value="4º período">4º período</option>
          <option value="5º período">5º período</option>
          <option value="6º período">6º período</option>
          <option value="7º período">7º período</option>
          <option value="8º período">8º período</option>
          <option value="9º período">9º período</option>
          <option value="10º período">10º período</option>
          <option value="1º ano">1º ano</option>
          <option value="2º ano">2º ano</option>
          <option value="3º ano">3º ano</option>
          <option value="4º ano">4º ano</option>
          <option value="5º ano">5º ano</option>
        </select></td>
    </tr>
    <tr> 
      <td>Curso:</td>
      <td colspan="3"><input name="curso" type="text" class="caixa" size="60" maxlength="20"></td>
    </tr>
    <tr> 
      <td colspan="4" class="formulario_cor"><div align="center">Contatos</div></td>
    </tr>
    <tr> 
      <td>Endere&ccedil;o:</td>
      <td colspan="3"><input name="endereco" type="text" class="caixa" size="60"></td>
    </tr>
    <tr> 
      <td>Bairro:</td>
      <td><input name="bairro" type="text" class="caixa" ></td>
      <td>Cidade:</td>
      <td><input name="cidade" type="text" class="caixa" ></td>
    </tr>
    <tr> 
      <td>Cep:</td>
      <td colspan="3"><input name="cep" type="text" class="caixa" size="10" maxlength="10" onKeyPress="so_numeros(this,'00.000-000')"></td>
    </tr>
    <tr> 
      <td>Telefone:</td>
      <td><input name="telefone" type="text" class="caixa" size="12" maxlength="13" onKeyPress="so_numeros(this,'(00)0000-0')"></td>
      <td>Celular:</td>
      <td><input name="celular" type="text" class="caixa"  size="12" maxlength="13" onKeyPress="so_numeros(this,'(00)0000-0')"></td>
    </tr>
    <tr> 
      <td>Email:</td>
      <td colspan="3"><input name="email" type="text" class="caixa" size="60"></td>
    </tr>
    <tr> 
      <td colspan="4" class="formulario_cor"> <div align="center">Outros:</div></td>
    </tr>
    <tr> 
      <td>Mini-curso:</td>
      <td><select name="mini_curso" class="caixa">
          <option value="1">01 Montagem de Telhados</option>
          <option value="2">02 Calculadora Hp para Iniciantes</option>
          <option value="3">03 A Confirmar</option>
          <option value="4">04 Técnicas de Apresentação de trabalhos</option>
          <option value="5">05 Planilha Eletrônica (MS Excel)</option>
          <option value="6">06 A Confirmar</option>
        </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" class="formulario_cor"><div align="center"> 
          <input type="submit" name="Submit" value="Enviar">
          <input type="reset" name="Reset" value="Limpar">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>
