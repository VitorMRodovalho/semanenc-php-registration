<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
 <title>Geração de Carne</title>
<link href="estilocss/carne.css" rel="stylesheet" type="text/css">
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false" >
<?php
if(!empty($_POST['ndocumento']))
  {
   bdados();
  }
else
  {
?>
      <tr>
        <td colspan="2" class="formulario_ex2"> <div align="center"><b>Carne incorreto!</b>        </div></td>
      </tr>
<?php
 }

function bdados()
  {
    $ndocumento = $_POST['ndocumento'];
    $dataemissao = $_POST['dataemissao'];
    $data_vencimento = $_POST['data_vencimento'];
    $nomealuno = $_POST['nomealuno'];
    $plano = $_POST['plano'];
    $periodo = $_POST['periodo']; //período
    $valor_total = $_POST['valor_total']; //40

    include "conexao/conexao.php";

    $sql = "UPDATE tb_quinsem_alunos SET carne_emissao='$dataemissao', parcela='$plano' WHERE id='$ndocumento';";
    $alterar = mysql_query($sql);
    if(!$alterar)
      {
        echo "<center><b>Erro: </b>".mysql_error()."<br><b>Não foi possível alterar cadastro!</b>";
	  }
     else
      {

    $fecha = mysql_close();

    $valorparcela = "R\$ ".round($valor_total / $plano, 2); // arrendonda em casas decimais
    $data_vencimento = $dataemissao + ($data_vencimento*24*60*60); // vencimento com base em dias da dataemissao
    $dataemissao = date('d/m/Y', $dataemissao);

    for($parcela=1; $parcela<=$plano; $parcela++)
      {
        $gera_vencimento = $data_vencimento + (31*24*60*60*($parcela-1)); // calculo parcela dos meses
        $gera_vencimento = date('d/m/Y', $gera_vencimento);

        Imprime_carne($ndocumento, $dataemissao, $gera_vencimento, $nomealuno, $parcela, $plano, $periodo, $valorparcela);
      }
      }
  }
function Imprime_carne($ndoc, $dtemis, $dtvenc, $aluno, $parc, $plan, $periodo, $vlparc)
  {
    $carne = "<table width=\"305\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >
        <tr>
          <td colspan=\"6\"><img src=\"imagens/2.gif\" width=\"300\" height=\"2\" ></td>
        </tr>
        <tr>
          <td width=\"4\"><img src=\"imagens/3.gif\" width=\"2\" height=\"32\" ></td>
          <td colspan=\"3\" class=\"tit\">UEG - Engenharia Cilvil</td>
          <td width=\"4\"></td>
          <td width=\"101\"><div align=\"right\" ><img src=\"imagens/logo_mono.jpg\" width=\"32\" height=\"32\" ></div></td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td colspan=\"5\" class=\"tit\" >III - Semana da Engenharia Civil</td>
        </tr>
        <tr>
          <td colspan=\"6\"><img src=\"imagens/2.gif\" width=\"300\" height=\"2\"></td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td width=\"92\" valign=\"top\" class=\"ct\">N&ordm; documento:</td>
          <td width=\"4\"><img src=\"imagens/1.gif\" width=\"1\" height=\"19\" ></td>
          <td width=\"100\" valign=\"top\" class=\"ct\">Emiss&atilde;o:</td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td valign=\"top\" class=\"ct\">Vencimento:</td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\" ></td>
          <td class=\"cp\" ><div align=\"center\" >".$ndoc."</div></td>
          <td><img src=\"imagens/1.gif\" width=\"1\" height=\"21\" ></td>
          <td><div align=\"left\" ><span class=\"cp\" >".$dtemis."</span></div></td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\" ></td>
          <td><div align=\"left\"><span class=\"cp\" >".$dtvenc."</span></div></td>
        </tr>
        <tr>
          <td colspan=\"6\" ><img src=\"imagens/2.gif\" width=\"300\" height=\"1\" ></td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td colspan=\"3\" valign=\"top\" class=\"ct\" >Aluno:</td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td valign=\"top\" class=\"ct\" >Parc. / Plano:</td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\" ></td>
          <td colspan=\"3\" class=\"cp\" >".$aluno."</td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\" ></td>
          <td><div align=\"center\" >
              <p class=\"cp\" >".$parc."/".$plan."</p>
            </div></td>
        </tr>
        <tr>
          <td colspan=\"6\"><img src=\"imagens/2.gif\" width=\"300\" height=\"1\" ></td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td colspan=\"3\" valign=\"top\" class=\"ct\" >Periodo:</td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\" ></td>
          <td valign=\"top\" class=\"ct\" >Valor presta&ccedil;&atilde;o:</td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\"></td>
          <td colspan=\"3\" class=\"cp\">".$periodo."</td>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\"></td>
          <td class=\"cp\">".$vlparc."</td>
        </tr>
        <tr>
          <td colspan=\"6\"><img src=\"imagens/2.gif\" width=\"300\" height=\"2\"></td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"19\"></td>
          <td colspan=\"3\" valign=\"top\" class=\"ct\">Obs:</td>
          <td><img src=\"imagens/1.gif\" width=\"1\" height=\"19\"></td>
          <td class=\"ct\">Referente:</td>
        </tr>
        <tr>
          <td><img src=\"imagens/3.gif\" width=\"2\" height=\"21\" ></td>
          <td colspan=\"3\" class=\"ld\" >Somente para alunos da UEG</td>
          <td><img src=\"imagens/1.gif\" width=\"1\" height=\"21\" ></td>
          <td class=\"ld\" >3&ordm;. Semana da Eng.</td>
        </tr>
        <tr>
          <td colspan=\"6\" ><img src=\"imagens/2.gif\" width=\"300\" height=\"2\" ></td>
        </tr>
      </table>";

      echo "<table>
             <tr>
              <td>
               ".$carne."
              </td>
              <td>|
              </td>
              <td>
               ".$carne."
              </td>
             </tr>
            </table>";
      }
?>
<form>
<input type="button" value="Imprimir" onclick="self.print()">
</form>
</body>
</html>
