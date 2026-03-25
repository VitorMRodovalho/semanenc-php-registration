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
if(!empty($_GET['acao']) && ($_GET['acao'] == 'busca'))
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

    if($escolha == "minicurso")
      {
        $sql="SELECT id, aluno, micurso FROM tb_quinsem_alunos WHERE micurso = '$busca' ORDER BY aluno ASC;";
        $nome= "Minicurso";
      }
    elseif($escolha == "periodo")
      {
        $sql="SELECT id, aluno, periodo FROM tb_quinsem_alunos WHERE periodo = '$busca' ORDER BY aluno ASC;";
        $nome= "Período";
      }
    @$selecao= mysql_query($sql);  // PESQUISA - SELECT
    @$linhas= mysql_num_rows($selecao); // CONTA RESULTADOS

    if($linhas)
      {
        for($i=0; $i<$linhas; $i++)
	      {
            $id = mysql_result($selecao, $i, 0);
	        $aluno = mysql_result($selecao, $i, 1);
	        $assunto = mysql_result($selecao, $i, 2);

	        if(($i % 2) == 0) // RESTO DA DIVISAO POR 2
	          {
		        $bgcolor = "#EFEFEF";
     	        imprime_busca($id, $aluno, $assunto, $nome, $bgcolor, $i, $linhas);
              }
	        else
	          {
		        $bgcolor = "WHITE";
      	        imprime_busca($id, $aluno, $assunto, $nome, $bgcolor, $i, $linhas);
	  	      }
	      }
	   }
     else
       {
?>
         <tr>
           <td colspan="3" class="formulario_ex2"> <div align="center"><b>Não cadastrado ou<br>opção inexistente.</b>
           </div></td>
         </tr>
<?php
       }
     $fecha = mysql_close();
   }
function imprime_busca($texto1, $texto2, $texto3, $texto4, $cor, $subtit, $tot) // FUNCAO IMPRIME
  {
     $texto1= zeros($texto1);

     if($subtit==0)
     {
?>
           <tr>
               <td class="formulario_geral" colspan="3"><div align="center">Total da busca: <?php echo $tot;?> inscrito(s)</td>
           </tr>
           <tr>
               <td class="formulario_geral"><div align="center">Inscri&ccedil;&atilde;o</td>
               <td class="formulario_geral"><div align="center">Nome do aluno</td>
               <td class="formulario_geral"><div align="center"><?php echo $texto4;?></td>
           </tr>
<?php
      }
     echo "<tr bgcolor=\"".$cor."\">
             <td class=\"formulario_ex2\"><div align=\"center\">".$texto1."</div></td>
             <td class=\"formulario_ex2\"><div align=\"left\"><a href=\"cadastro_alunos_pesquisa_acao.php?acao=visualiza&pesquisa=".$texto1."&opcao=null\">".$texto2."</a></div></td>
             <td class=\"formulario_ex2\"><div align=\"center\">".$texto3."</div></td>
           </tr>";
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
