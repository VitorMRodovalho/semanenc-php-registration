<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
 <title>Resultado da Pesquisa</title>
</head>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false" onkeypress="return false">
<table border="0" class="formulario_geral">
  <tr>
    <td colspan="3" class="formulario_cor"> <div align="center">Resultado de cadastros
        :</div></td>
  </tr>
<?php
if(!empty($_GET['acao']) && ($_GET['acao'] == 'busca'|| $_GET['acao'] == 'visualiza'))
  {
    $acao = $_GET['acao'];
    $pesquisa = $_GET['pesquisa'];
    $opcao = $_GET['opcao'];
 
    $funcao = $acao($pesquisa, $opcao);
  }
else
  {
?>
      <tr>
        <td colspan="3" class="formulario_ex2"> <div align="center"><b>Pesquisa incorreta!</b>
        </div></td>
      </tr>
<?php
  }
function busca($busca, $escolha)
  {
    include "conexao/conexao.php";
    
    if($escolha == "numero")
      {
        $sql="SELECT id, aluno, criacao FROM tb_quinsem_alunos WHERE id='$busca';";
      }
    elseif($escolha == "aluno")
      {
        $sql="SELECT id, aluno, criacao FROM tb_quinsem_alunos WHERE aluno LIKE '%".$busca."%' ORDER BY id ASC;";
      }
    elseif($escolha == "todos")
      {
        $sql="SELECT id, aluno, criacao FROM tb_quinsem_alunos ORDER BY id ASC;";
      }
    elseif($escolha == "outras")
      {
        $sql="SELECT id, aluno, criacao FROM tb_quinsem_alunos WHERE interno ='out' ORDER BY id ASC;";
      }
    elseif($escolha == "ueg")
      {
        $sql="SELECT id, aluno, criacao FROM tb_quinsem_alunos WHERE interno = 'ueg' ORDER BY id ASC;";
      }
    $selecao= mysql_query($sql);  // PESQUISA - SELECT
    $linhas= mysql_num_rows($selecao); // CONTA RESULTADOS

    if($linhas)
      {
        for($i=0; $i<$linhas; $i++)
	      {
            $id = mysql_result($selecao, $i, 0);
	        $aluno = mysql_result($selecao, $i, 1);
	        $criacao = mysql_result($selecao, $i, 2);

	        if(($i % 2) == 0) // RESTO DA DIVISAO POR 2
	          {
		        $bgcolor = "#EFEFEF";
     	        imprime_busca($id, $aluno, $criacao, $bgcolor, $i, $linhas);
              }
	        else
	          {
		        $bgcolor = "WHITE";
      	        imprime_busca($id, $aluno, $criacao, $bgcolor, $i, $linhas);
	  	      }
	      }
	   }
     else
       {
?>
         <tr>
           <td colspan="3" class="formulario_ex2"> <div align="center"><b>Aluno não cadastrado ou<br>Número de inscrição inexistente.</b>
           </div></td>
         </tr>
<?php
       }
     $fecha = mysql_close();
   }

function visualiza($inscricao)
  {
    include "conexao/conexao.php";
    
    $sql="select * from tb_quinsem_alunos WHERE id='$inscricao';";
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
    $aluno_ueg= mysql_result($selecao, 0, 17);

    $GLOBALS['aluno_ueg'] = $aluno_ueg;

	imprime_visualiza($id, $data_criacao, $aluno, $nascimento, $identidade, $universidade, $cid_univer, $periodo, $curso, $endereco, $bairro, $cidade, $telefone, $celular, $email, $mini_curso ); // FUNCAO IMPRIME DADOS DO ALUNO

    $fecha = mysql_close();
  }
function imprime_busca($texto1, $texto2, $texto3, $cor, $subtit, $tot) // FUNCAO IMPRIME
  {
     $texto1= zeros($texto1);
     $texto3= date('d/m/Y',$texto3);

     if($subtit==0)
     {
?>
           <tr>
               <td class="formulario_geral" colspan="3"><div align="center">Total da busca: <?php echo $tot;?> inscrito(s)</td>
           </tr>
           <tr>
               <td class="formulario_geral"><div align="center">Inscri&ccedil;&atilde;o</td>
               <td class="formulario_geral"><div align="center">Nome do aluno</td>
               <td class="formulario_geral"><div align="center">Criado</td>
           </tr>
<?php
      }
     echo "<tr bgcolor=\"".$cor."\">
             <td class=\"formulario_ex2\"><div align=\"center\">".$texto1."</div></td>
             <td class=\"formulario_ex2\"><div align=\"left\"><a href=\"cadastro_alunos_pesquisa_acao.php?acao=visualiza&pesquisa=".$texto1."&opcao=null\">".$texto2."</a></div></td>
             <td class=\"formulario_ex2\"><div align=\"center\">".$texto3."</div></td>
           </tr>";
  }
function imprime_visualiza($text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8, $text9, $text10, $text11, $text12, $text13, $text14, $text15, $text16)
  {
     $text1 = zeros($text1);
     $text2 = date('d/m/Y',$text2);
     $text4 = date('d/m/Y', $text4);
     $text = array( 1 => $text1, $text2, $text3, $text4, $text5, $text6, $text7, $text8, $text9, $text10, $text11, $text12, $text13, $text14, $text15, $text16);
     $titulo = array( 1 => 'Inscri&ccedil;&atilde;o:', 'Insc. Criada:', 'Aluno:', 'Nascimento:', 'Identidade:',
                      'Universidade', 'Cidade:', 'Peri&oacute;do:', 'Curso:', 'Endere&ccedil;o:', 'Bairro:',
                      'Cidade:', 'T. Residencial:', 'Celular:', 'Email:', 'Mini-Curso:');

     for( $i=1; $i<=16; $i++ )
       {
          $tag[$i] = "<tr>
                       <td class=\"formulario_geral\">".$titulo[$i]."</td>
                       <td class=\"formulario_ex2\">".$text[$i]."</td>
                      </tr>";
       }

     echo $tag[1].$tag[2].$tag[3].$tag[4].$tag[5].
          "<tr>
            <td colspan=\"2\" class=\"formulario_cor\"> <div align=\"center\">Universidade</div></td>
           </tr>
          ".$tag[6].$tag[7].$tag[8].$tag[9]."
           <tr>
            <td colspan=\"2\" class=\"formulario_cor\"><div align=\"center\">Contatos:</div></td>
           </tr>
          ".$tag[10].$tag[11].$tag[12].$tag[13].$tag[14].$tag[15]."
           <tr>
             <td colspan=\"2\" class=\"formulario_cor\"><div align=\"center\">Outros:</div></td>
           </tr>
          ".$tag[16];
?>
</table>
<br>
<table>
  <table border="0" class="formulario_geral">
    <tr>
      <td colspan="3" class="formulario_cor"> <div align="center">Op&ccedil;&otilde;es
          :</div></td>
    </tr>
    <tr>
<?php
       if($GLOBALS['aluno_ueg']=="ueg")
         {
?>
      <td class="formulario_geral">
      <a href="cadastro_alunos_carne_criar.php?acao=cr_carne&pesquisa=<?php echo $text1;?>">
      Criar Carne</a></td>
<?php
         }
?>
      <td class="formulario_geral">
      <a href="cadastro_alunos_alterar.php?acao=alterar&pesquisa=<?php echo $text1;?>">
        Modificar Cadastro</a></td>
      <td class="formulario_geral">
      <a href="cadastro_alunos_excluir.php?acao=excluir&pesquisa=<?php echo $text1;?>">
        Excluir Cadastro</a></td>
    </tr>
  </table>
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
</table>
<form>
<input type="button" value="Voltar" onclick="javascript:history.go(-1)">
<input type="button" value="Imprimir" onclick="self.print()">
</form>
</body>
</html>
