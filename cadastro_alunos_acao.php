<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
  <title>Inserir Cadastro</title>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
</head>
<body ondragstart="return false"  onselectstart="return false">
<?
if(!empty($_POST['nome_aluno']) && ($_POST['nome_aluno'] <> ''))
  {

    include "conexao/conexao.php";

    $nome_aluno = $_POST['nome_aluno'];
    $datanasc = $_POST['datanasc'];
    $identidade = $_POST['identidade'];
    $expedidor = $_POST['expedidor'];
    $exp_estado = $_POST['exp_estado'];
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
    $aluno_ueg = $_POST['aluno_ueg'];

    $identidade = $identidade.' '.$expedidor.'-'.$exp_estado;

    @list($nasc_dia, $nasc_mes, $nasc_ano) = explode('/', $datanasc); // @ tira linha de erro impressa
    $datanasc = mktime( 0, 0, 0, $nasc_mes, $nasc_dia, $nasc_ano); // Timestamp
    
    @list($cria_dia, $cria_mes, $cria_ano) = explode('/', $data_criacao); // @ tira linha de erro impressa
    $data_criacao = mktime( 0, 0, 0, $cria_mes, $cria_dia, $cria_ano); // Timestamp

    $sql= "INSERT INTO tb_quinsem_alunos (aluno, nasc, identidade, univer, cid_univer, periodo, curso, endereco, bairro, cidade, cep, fone, celu, email, micurso, criacao, interno) values ( '$nome_aluno', '$datanasc', '$identidade', '$universidade', '$cidade_univer', '$periodo', '$curso', '$endereco', '$bairro', '$cidade', '$cep', '$telefone', '$celular', '$email', '$mini_curso', '$data_criacao', '$aluno_ueg');";
    $incluir= mysql_query($sql);
    $verifica_inclusao = mysql_affected_rows(); // verifica se houve alguma linha que foi incluida na tabela, valor 1.
      if($verifica_inclusao > 0)
        {
          $id_insert = mysql_insert_id();
          $id_insert = zeros($id_insert);
?>
            <table class="formulario_geral">
				<tr>
    			  <td colspan="3" class="formulario_cor">
	 			  <div align="center">Aluno cadastrado com com sucesso!</div>
	 			  </td>
  				</tr>
  				<tr>
                  <td class="formulario_geral"><div align="center">Inscri&ccedil;&atilde;o</td>
                  <td class="formulario_geral" colspan="2"><div align="center">Nome do aluno</td>
                </tr>
                <tr>
                  <td bgcolor="#EFEFEF" class="formulario_ex2">
                     <div align="center"><?php echo $id_insert;?></div></td>
                  <td bgcolor="#EFEFEF" class="formulario_ex2" colspan="2"><div align="left"><?php echo $nome_aluno;?></div></td>
                </tr>
				<tr>
      			  <td class="formulario_cor" colspan="3"> <div align="center">Op&ccedil;&otilde;es
          		  :</div></td>
    			</tr>
    			<tr>
<?php
       if($aluno_ueg=="ueg")
         {
?>
				  <td class="formulario_geral" align="center">
      				<a href="cadastro_alunos_carne_criar.php?acao=cr_carne&pesquisa=<?php echo $id_insert;?>">
      				Criar Carne</a></td>
<?php
         }
?>
	   			  <td class="formulario_geral">
      				<a href="cadastro_alunos_alterar.php?acao=alterar&pesquisa=<?php echo $id_insert;?>">
			        Modificar Cadastro</a></td>
      			  <td class="formulario_geral">
      				<a href="cadastro_alunos_excluir.php?acao=excluir&pesquisa=<?php echo $id_insert;?>">
       				Excluir Cadastro</a></td>
    			</tr>
		  </table>
<?php
       	}
      else
       {
	   echo "<center><b>Erro: </b>".mysql_error()."<br><b>Não foi possível cadastrar aluno!</b>";
	   }
    $fecha = mysql_close();
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
