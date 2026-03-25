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
<a href="gerar_certificado.php?acao=gerar_certificado">Gerar TXT etiqueta</a>&nbsp;&nbsp;
<a href="gerar_certificado.php?acao=gerar_lista_tex">Gerar TEX certificado</a>&nbsp;&nbsp;
<a href="gerar_certificado.php?acao=gerar_lista">Gerar lista de entrega Materiais</a>&nbsp;&nbsp;
<a href="gerar_certificado.php?acao=gerar_lista_presenca">Gerar lista de presença Minicurso</a>
<br>
<?php

if(!empty($_GET['acao']) && ($_GET['acao'] == 'gerar_certificado'))
  {
    $pont = fopen("certificado/chamados_certificado.txt","w+t"); // ABRE O ARQUIVO P/ READ E WRITE, TENTA CRIAR, DEIXA TMANHO 0
    $declaracoes = "nome,rg,minicurso\n";
    $escreve_declaracoes = fwrite($pont, $declaracoes);

    include "conexao/conexao.php";// CONECTA BD

    $n_minicursos = 6;

    function imprime($selecao, $linhas, $ponteiro)
     {
      for($i=0; $i<$linhas; $i++)
        {
          $aluno = mysql_result($selecao, $i, 0);
          $identidade = mysql_result($selecao, $i, 1);
          $n_mcurso = mysql_result($selecao, $i, 2);
     
          $minicurso = array(1 => "Montagem de Telhados", "Calculadora Hp para Iniciantes", "A confirmar", "Técnicas de Apresentação de trabalhos", "Planilha Eletrônica", "A Confirmar");
              $variaveis = "\n"."".$aluno.","."  "."".$identidade.","."  "."".strtoupper($minicurso[$n_mcurso]).""."\n";
          $escreve_variaveis = fwrite($ponteiro, $variaveis);
        }
    }

    for($j=1; $j<=$n_minicursos; $j++)
      {
          $sql = "SELECT aluno, identidade, micurso FROM tb_quinsem_alunos WHERE micurso = '$j' ORDER BY aluno ASC;";//and criacao>1129860000
          $sel = mysql_query($sql); // PESQUISA - SELECT
          $lin= mysql_num_rows($sel); // CONTA RESULTADOS
          $chama_funcao = imprime($sel, $lin, $pont);
       }

    $fecha_ponteiro = fclose($pont);
    $fecha_db = mysql_close();
    echo "<br><B>ARQUIVO TXT GERADO - ETIQUETAS</B><br><a href=\"certificado/chamados_certificado.txt\">Abrir</a>";
  }
if(!empty($_GET['acao']) && ($_GET['acao'] == 'gerar_lista'))
  {
    function imprime($selecao, $linhas, $ponteiro)
     {
      for($i=0; $i<$linhas; $i++)
        {
          $aluno = mysql_result($selecao, $i, 0);
          $identidade = mysql_result($selecao, $i, 1);
          $n_mcurso = mysql_result($selecao, $i, 2);

          $minicurso = array(1 => "Montagem de Telhados", "Calculadora Hp para Iniciantes", "A confirmar", "Técnicas de Apresentação de trabalhos", "Planilha Eletrônica", "A Confirmar");

          $variaveis = "<tr>\n<td style=\"border: 1 solid #000000; font-size: 9pt;\">".$aluno."</td>\n<td style=\"border: 1 solid #000000; font-size: 8pt;\">".$identidade."</td>\n<td style=\"border: 1 solid #000000; font-size: 8pt;\">".$minicurso[$n_mcurso]."</td>\n<td style=\"border: 1 solid #000000;\">&nbsp;</td><td style=\"border: 1 solid #000000;\">&nbsp;</td></tr>\n";
          $escreve_variaveis = fwrite($ponteiro, $variaveis);
        }
     }

    include "conexao/conexao.php";// CONECTA BD

    $n_minicursos = 6;
    
    for($j=1; $j<=$n_minicursos; $j++)
      {
          $pont = fopen("certificado/lista_kit$j.htm","w+t"); // ABRE O ARQUIVO P/ READ E WRITE, TENTA CRIAR, DEIXA TMANHO 0
          $declaracoes = "<html><body><table border=\"1\" style=\"font-size: 10pt;\" cellpadding=\"0\" cellspacing=\"0\"><tr>\n<td style=\"border: 1 solid #000000;\">Aluno</td>\n<td style=\"border: 1 solid #000000;\">Identidade</td>\n<td style=\"border: 1 solid #000000;\">Minicurso</td>\n<td style=\"border: 1 solid #000000;\">Identidade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style=\"border: 1 solid #000000;\">Assinatura&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>\n";
          $escreve_declaracoes = fwrite($pont, $declaracoes);

          $sql = "SELECT aluno, identidade, micurso FROM tb_quinsem_alunos WHERE micurso = '$j'ORDER BY aluno ASC;";
          $sel = mysql_query($sql); // PESQUISA - SELECT
          $lin= mysql_num_rows($sel); // CONTA RESULTADOS
          $chama_funcao = imprime($sel, $lin, $pont);
          
          $declaracoes = "</table><form><input type=\"button\" value=\"Imprimir\" onclick=\"self.print()\"></form></body><html>";
          $escreve_declaracoes = fwrite($pont, $declaracoes);
          $fecha_ponteiro = fclose($pont);
      }

   $fecha_db = mysql_close();
   echo "<br><B>LISTA ENTREGA KIT GERADA</B><br><a href=\"certificado/lista_kit1.htm\" target=\"geracao\">lista_kit[N].htm</a> para N de 1 a".$n_minicursos."<br><b>Desculpe o transtorno</b>";
  
   }
if(!empty($_GET['acao']) && ($_GET['acao'] == 'gerar_lista_tex'))
  {
  $pont = fopen("certificado/chamados_certificado.tex","w+t"); // ABRE O ARQUIVO P/ READ E WRITE, TENTA CRIAR, DEIXA TMANHO 0
    $declaracoes = "\declarefields{nome,rg,minicurso}"."\n\n"."\\newcommand{\defineasentradas}[3]{\\newentry{{#1},{#2},{#3}}}"."\n\n";
    $escreve_declaracoes = fwrite($pont, $declaracoes);

    include "conexao/conexao.php";// CONECTA BD

    $n_minicursos = 12;

    function imprime($selecao, $linhas, $ponteiro)
     {
      for($i=0; $i<$linhas; $i++)
        {
          $aluno = mysql_result($selecao, $i, 0);
          $identidade = mysql_result($selecao, $i, 1);
          $n_mcurso = mysql_result($selecao, $i, 2);

          $minicurso = array(1 => "Montagem de Telhados", "Calculadora Hp para Iniciantes", "A confirmar", "Técnicas de Apresentação de trabalhos", "Planilha Eletrônica", "A Confirmar");

          $variaveis = "\defineasentradas"."\n"."{".$aluno."}"."  "."{".$identidade."}"."  "."{".strtoupper($minicurso[$n_mcurso])."}"."\n\n\n";
          $escreve_variaveis = fwrite($ponteiro, $variaveis);
        }
    }

    for($j=1; $j<=$n_minicursos; $j++)
      {
          $sql = "SELECT aluno, identidade, micurso FROM tb_quinsem_alunos WHERE micurso = '$j'ORDER BY aluno ASC;";
          $sel = mysql_query($sql); // PESQUISA - SELECT
          $lin= mysql_num_rows($sel); // CONTA RESULTADOS
          $chama_funcao = imprime($sel, $lin, $pont);
       }

    $fecha_ponteiro = fclose($pont);
    $fecha_db = mysql_close();
    echo "<br><B>ARQUIVO TEX GERADO </B><br><a href=\"certificado/chamados_certificado.tex\">Abrir</a>";
  }
if(!empty($_GET['acao']) && ($_GET['acao'] == 'gerar_lista_presenca'))
  {
    function imprime($selecao, $linhas, $ponteiro)
     {
      for($i=0; $i<$linhas; $i++)
        {
          $aluno = mysql_result($selecao, $i, 0);
          $n_mcurso = mysql_result($selecao, $i, 1);

          $minicurso = array(1 => "Montagem de Telhados", "Calculadora Hp para Iniciantes", "A confirmar", "Técnicas de Apresentação de trabalhos", "Planilha Eletrônica", "A Confirmar");

          $variaveis = "<tr>\n<td style=\"border: 1 solid #000000; font-size: 9pt;\">".$aluno."</td>\n<td style=\"border: 1 solid #000000; font-size: 8pt;\">".$minicurso[$n_mcurso]."</td>\n<td style=\"border: 1 solid #000000;\">&nbsp;</td><td style=\"border: 1 solid #000000;\">&nbsp;</td></tr>\n";
          $escreve_variaveis = fwrite($ponteiro, $variaveis);
        }
     }

    include "conexao/conexao.php";// CONECTA BD

    $n_minicursos = 6;

    for($j=1; $j<=$n_minicursos; $j++)
      {
          $pont = fopen("certificado/lista_Pres_Mini$j.htm","w+t"); // ABRE O ARQUIVO P/ READ E WRITE, TENTA CRIAR, DEIXA TMANHO 0
          $declaracoes = "<html><body><table border=\"1\" style=\"font-size: 10pt;\" cellpadding=\"0\" cellspacing=\"0\"><tr>\n<td style=\"border: 1 solid #000000;\">Aluno</td>\n<td style=\"border: 1 solid #000000;\">Minicurso</td>\n<td style=\"border: 1 solid #000000;\">Entrada&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style=\"border: 1 solid #000000;\">Saída&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>\n";
          $escreve_declaracoes = fwrite($pont, $declaracoes);

          $sql = "SELECT aluno, micurso FROM tb_quinsem_alunos WHERE micurso = '$j'ORDER BY aluno ASC;";
          $sel = mysql_query($sql); // PESQUISA - SELECT
          $lin= mysql_num_rows($sel); // CONTA RESULTADOS
          $chama_funcao = imprime($sel, $lin, $pont);

          $declaracoes = "</table><form><input type=\"button\" value=\"Imprimir\" onclick=\"self.print()\"></form></body><html>";
          $escreve_declaracoes = fwrite($pont, $declaracoes);
          $fecha_ponteiro = fclose($pont);
      }

   $fecha_db = mysql_close();
   echo "<br><B>LISTA PRESENÇA MINICURSO GERADA</B><br><a href=\"certificado/lista_Pres_Mini1.htm\" target=\"geracao\">lista_Pres_Mini[N].htm</a> para N de 1 a".$n_minicursos."<br><b>Desculpe o transtorno</b>";

   }
?>
</body>
</html>
