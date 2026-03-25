<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<?php
include "conexao/conexao.php";
$sql="SELECT micurso FROM tb_quinsem_alunos;";
$selecao= mysql_query($sql);  // PESQUISA - SELECT
$linhas= mysql_num_rows($selecao); // CONTA RESULTADOS
if($linhas)
  {
    for($i=1; $i<=12; $i++)
      {
        $j = 0;
        $minicurso[$i] = 0;
        while($j < $linhas)
          {
            $micurso = mysql_result($selecao, $j, 0);
            if( $micurso == $i)
              {
                $minicurso[$i]+= 1;
              }
            $j+= 1;
          }
      }
  }
?>
<html>
<head>
<title>V Semana de Engenharia Civil</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<table width="750" border="0" cellpadding="2" cellspacing="0" class="formulario_geral">
  <tr>
    <td width="350" class="formulario_cor" align="center" >Minicursos</td>
    <td width="150" class="formulario_cor" align="center" >Vagas preenchidas</td>
    <td width="125" class="formulario_cor" align="center" >Vagas restante</td>
    <td width="125" class="formulario_cor" align="center" >Total de Vagas</td>
  </tr>
  <tr  bgcolor="#EFEFEF">
    <td>01- Montagem de Telhados</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[1];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 20-$minicurso[1];?></font></td>
    <td align="center">20</td>
  </tr>
  <tr>
    <td>02- Calculadora Hp para Iniciantes</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[2];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 20-$minicurso[2];?></font></td>
    <td align="center">20</td>
  </tr>
  <tr bgcolor="#EFEFEF">
    <td>03- A Confirmar</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[3];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 0-$minicurso[3];?></font></td>
    <td align="center">0</td>
  </tr>
  <tr>
    <td>04- Técnicas de Apresentação de trabalhos</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[4];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 20-$minicurso[4];?></font></td>
    <td align="center">20</td>
  </tr>
  <tr  bgcolor="#EFEFEF">
    <td>05- Planilha Eletrônica (MS Excel)</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[5];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 20-$minicurso[5];?></font></td>
    <td align="center">20</td>
  </tr>
  <tr>
    <td>06- A Confirmar</td>
    <td align="center"><font color="#0000ff"><?php echo $minicurso[6];?></font></td>
    <td align="center"><font color="#ff0000"><?php echo 16-$minicurso[6];?></font></td>
    <td align="center">16</td>
  </tr>
</table>
<form>
<input type="button" value="Imprimir" onclick="self.print()">
</form>
</body>
</html>
