<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>Criar carne</title>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<?php
if(!empty($_GET['acao']) && ($_GET['acao'] == 'cr_carne'))
  {
    $acao = $_GET['acao'];
    $pesquisa = $_GET['pesquisa'];

    $funcao = $acao($pesquisa);
  }
else
  {
?>
      <tr>
        <td colspan="2" class="formulario_ex2"> <div align="center"><b>Carne incorreto!</b>
        </div></td>
      </tr>
<?php
  }
function cr_carne($id)
  {
    include "conexao/conexao.php";
    
    $sql = "SELECT id, aluno, periodo, criacao, carne_emissao, parcela FROM tb_quinsem_alunos WHERE id = $id;";
    $selecionar = mysql_query($sql) or die ('falhou');
    $ndocumento = mysql_result($selecionar, 0, 0);
    $nomealuno = mysql_result($selecionar, 0, 1);
    $periodo = mysql_result($selecionar, 0, 2);
    $datacriacao = mysql_result($selecionar, 0, 3);
    $dataemissao = mysql_result($selecionar, 0, 4);
    $parcela  = mysql_result($selecionar, 0, 5);
    if($dataemissao==0)
      {
        $dataemissao = $datacriacao;
      }
        include "preco.php";
        $valor_total = $preco;
        $ndocumento = zeros($ndocumento);
?>
        <form action="cadastro_alunos_carne_ver.php" method="post">
        <table border="0" class="formulario_geral">
        <tr>
          <td colspan="2" class="formulario_cor"> <div align="center">Criar carne:</div></td>
        </tr>
        <tr>
          <td class="formulario_geral">N.&ordm; documento:</td>
          <td class="formulario_ex2"><?php echo $ndocumento;?></td>
        </tr>
        <tr>
          <td class="formulario_geral">Aluno:</td>
          <td class="formulario_ex2"><?php echo $nomealuno;?></td>
        </tr>
        <tr>
          <td class="formulario_geral">Periodo:</td>
          <td class="formulario_ex2"><?php echo $periodo;?></td>
        </tr>
        <tr>
          <td class="formulario_geral">Data emiss&atilde;o:</td>
          <td class="formulario_ex2"><?php echo date('d/m/Y',$dataemissao);?></td>
        </tr>
        <tr>
          <td class="formulario_geral">1&ordm; Vencimento:</td>
          <td class="formulario_ex2">
            <select name="data_vencimento" class="caixa">
                <option value="0"><?php echo date('d/m/Y',$dataemissao);?></option>
            </select></td>
        </tr>
        <tr>
          <td class="formulario_geral"><p>Plano:</p></td>
          <td class="formulario_ex2">
          <?php
           if($parcela==0)
            {
          ?>
            <select name="plano" class="caixa">
              <option value="1">&Uacute;nica</option>
              <option value="2">2 Parcelas</option>
            </select>
         <?php
            }
           else
            { echo $parcela."<input  type=\"hidden\" name=\"plano\" value=\"$parcela\">"; }
         ?></td>
        </tr>
        <tr>
          <td class="formulario_geral">Valor total:</td>
          <td class="formulario_ex2">R$ <?php echo $valor_total;?>,00</td>
        </tr>
        <tr>
          <td colspan="2" class="formulario_cor"><div align="center">
            <input  type="hidden" name="ndocumento" value="<?php echo $ndocumento;?>">
            <input  type="hidden" name="nomealuno" value="<?php echo $nomealuno;?>">
            <input  type="hidden" name="periodo" value="<?php echo $periodo;?>">
            <input  type="hidden" name="dataemissao" value="<?php echo $dataemissao;?>">
            <input  type="hidden" name="valor_total" value="<?php echo $valor_total;?>">
            <input type="submit" value="Visualizar">
          </div></td>
          </tr>
          </table>
        </form>
<?php
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
