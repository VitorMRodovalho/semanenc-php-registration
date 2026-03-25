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
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<?php
if(!empty($_GET['acao']) && ($_GET['acao'] == 'alterar'))
  {
    $acao = $_GET['acao'];
    $pesquisa = $_GET['pesquisa'];

    $funcao = $acao($pesquisa);
  }
elseif(!empty($_POST['acao'])&& ($_POST['acao'] == 'alterado'))
  {
    $acao = $_POST['acao'];
    $pesquisa = $_POST['pesquisa'];
    $nome_aluno = $_POST['nome_aluno'];
    $datanasc = $_POST['datanasc'];
    $identidade = $_POST['identidade'];
    $universidade = $_POST['universidade'];
    $cidade_univer = $_POST['cidade_univer'];
    $periodo = $_POST['periodo'];
    $curso = $_POST['curso'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $mini_curso = $_POST['mini_curso'];
    $data_criacao = $_POST['data_criacao'];
    
    @list($nasc_dia, $nasc_mes, $nasc_ano) = explode('/', $datanasc); // @ tira linha de erro impressa
    $datanasc = mktime( 0, 0, 0, $nasc_mes, $nasc_dia, $nasc_ano); // Timestamp
    
    @list($cria_dia, $cria_mes, $cria_ano) = explode('/', $data_criacao); // @ tira linha de erro impressa
    $data_criacao = mktime( 0, 0, 0, $cria_mes, $cria_dia, $cria_ano); // Timestamp

    $funcao = $acao($pesquisa, $nome_aluno, $datanasc, $identidade, $universidade, $cidade_univer, $periodo, $curso, $endereco, $bairro, $cidade, $cep, $telefone, $celular, $email, $mini_curso, $data_criacao);
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


function alterar($id)
  {
    include "conexao/conexao.php";

    $sql="SELECT * FROM tb_quinsem_alunos WHERE id='$id';";
    $selecao= mysql_query($sql);

	$id= mysql_result($selecao, 0, 0);
	$aluno= mysql_result($selecao, 0, 1);
	$nascimento= mysql_result($selecao, 0, 2);
	$identidade= mysql_result($selecao, 0, 3);
	$universidade= mysql_result($selecao, 0, 4);
	$cid_univer= mysql_result($selecao, 0, 5);
	$periodo= mysql_result($selecao, 0, 6);
    $curso= mysql_result($selecao, 0, 7);
    $endereco= mysql_result($selecao, 0, 8);
    $bairro= mysql_result($selecao, 0, 9);
    $cidade= mysql_result($selecao, 0, 10); 
    $cep= mysql_result($selecao, 0, 11); 
    $telefone= mysql_result($selecao, 0, 12);
    $celular= mysql_result($selecao, 0, 13);
    $email= mysql_result($selecao, 0, 14);
    $mini_curso= mysql_result($selecao, 0, 15);
    $data_criacao= mysql_result($selecao, 0, 16);
?>
<script language='JavaScript'>
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
</script>
<form name="form1" method="post" action="cadastro_alunos_alterar.php">
  <table border="0" class="formulario_geral">
    <tr>
      <td colspan="4" class="formulario_cor"> <div align="center">Alteração de Cadastro
         :</div></td>
    </tr>
    <tr>
      <td>Nome:</td>
      <td colspan="3"><input name="nome_aluno" value="<?php echo $aluno;?>" type="text" class="caixa" size="60" maxlength="40"></td>
    </tr>
    <tr>
      <td>D. Identidade:</td>
      <td><input name="identidade" value="<?php echo $identidade;?>" type="text"  maxlength="20" size="14" class="caixa"></td>
      <td></td>
      <td>
      </td>
    </tr>
    <tr>
      <td>Data de Nasc:</td>
      <td><input name="datanasc" value="<?php echo date('d/m/Y',$nascimento);?>" type="text" class="caixa" size="7" maxlength="10" onKeyPress="so_numeros(this,'00/00/0000')"></td>
      <td>Data Inscrição:</td>
      <td><input name="data_criacao" value="<?php echo date('d/m/Y',$data_criacao);?>" type="text" class="caixa" size="7" maxlength="10" onKeyPress="so_numeros(this,'00/00/0000')"></td>
    </tr>
    <tr>
      <td colspan="4" class="formulario_cor"><div align="center">Universidade</div></td>
    </tr>
    <tr>
      <td>Universidade:</td>
      <td colspan="3"><input name="universidade" value="<?php echo $universidade;?>" type="text" class="caixa" size="60" maxlength="50"></td>
    </tr>
    <tr>
      <td>Cidade:</td>
      <td><input name="cidade_univer" value="<?php echo $cid_univer;?>" type="text" class="caixa" maxlength="30"></td>
      <td>Per&iacute;odo/Ano:</td>
      <td><select name="periodo" class="caixa">
          <option value="<?php echo $periodo;?>" ><?php echo $periodo;?></option>
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
      <td colspan="3"><input name="curso" value="<?php echo $curso;?>" type="text" class="caixa" size="60" maxlength="20"></td>
    </tr>
    <tr>
      <td colspan="4" class="formulario_cor"><div align="center">Contatos</div></td>
    </tr>
    <tr>
      <td>Endere&ccedil;o:</td>
      <td colspan="3"><input name="endereco" value="<?php echo $endereco;?>" type="text" class="caixa" size="60"></td>
    </tr>
    <tr>
      <td>Bairro:</td>
      <td><input name="bairro" value="<?php echo $bairro;?>" type="text" class="caixa" ></td>
      <td>Cidade:</td>
      <td><input name="cidade" value="<?php echo $cidade;?>" type="text" class="caixa" ></td>
    </tr>
    <tr>
      <td>cep:</td>
      <td colspan="3"><input name="cep" value="<?php echo $cep;?>" type="text" class="caixa" size="10" maxlength="10" onKeyPress="so_numeros(this,'00.000-000')"></td>
    </tr>
    <tr>
      <td>Telefone:</td>
      <td><input name="telefone"  value="<?php echo $telefone;?>"type="text" class="caixa" size="12" maxlength="13" onKeyPress="so_numeros(this,'(00)0000-0')"></td>
      <td>Celular:</td>
      <td><input name="celular"  value="<?php echo $celular;?>"type="text" class="caixa"  size="12" maxlength="13" onKeyPress="so_numeros(this,'(00)0000-0')"></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td colspan="3"><input name="email" value="<?php echo $email;?>" type="text" class="caixa" size="60"></td>
    </tr>
    <tr>
      <td colspan="4" class="formulario_cor"> <div align="center">Outros:</div></td>
    </tr>
    <tr>
      <td>Mini-curso:</td>
      <td><select name="mini_curso" class="caixa">
          <option value="<?php echo $mini_curso;?>" ><?php echo $mini_curso;?></option>
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
          <input type="hidden" name="acao" value="alterado">
          <input type="hidden" name="pesquisa" value="<?php echo $id;?>">
          <input type="submit" name="Submit" value="Modificar">
          <input type="reset" name="Reset" value="Cadastro original">
        </div></td>
    </tr>
  </table>
</form>
<?php
    $fecha = mysql_close();
  }
function alterado($id, $t1, $t2, $t3, $t4, $t5, $t6, $t7, $t8, $t9, $t10, $t11, $t12, $t13, $t14, $t15, $t16)
  {
    include "conexao/conexao.php";
    
    $sql = "UPDATE tb_quinsem_alunos SET aluno='$t1', nasc='$t2', identidade='$t3', univer='$t4' , cid_univer='$t5', periodo='$t6', curso='$t7', endereco='$t8', bairro='$t9', cidade='$t10', cep='$t11', fone='$t12', celu='$t13', email='$t14', micurso='$t15', criacao='$t16' WHERE id='$id';";
    $alterar = mysql_query($sql);
    if($alterar)
      {
        echo "<center><b>Cadastro alterado com sucesso!</b>";
	  }
     else
      {
	    echo "<center><b>Erro: </b>".mysql_error()."<br><b>Não foi possível alterar cadastro!</b>";
	  }
    $fecha = mysql_close();
  }
function zeros($id)
  {
    $cont = strlen($id); // CONTA A STRING
    $zeros = 4 - $cont;
    $addzeros = '';
    for($i=1; $i <=$zeros; $i++)
           {
             $addzeros .= '0';
           }
    $id = $addzeros.$id;
    return $id;
  }
?>
</body>
</html>
