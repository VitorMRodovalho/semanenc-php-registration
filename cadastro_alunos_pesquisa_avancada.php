<?php
//PAGINA RESTRITA - SOMENTE USUARIO
$restrita="usuario";
include "validacoes/validacao.php";
verifica_validacao_php($restrita);
// FIM RESTRICAO
?>
<html>
<head>
<title>V semana - avancada</title>
<link href="estilocss/engcivil.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript">
function opcoes(combo)
  {
    var endereco = combo.value;
    if (endereco != "#")
       {
       php = "cadastro_alunos_pesquisa_avancada_acao.php?acao=busca&";
       novapagina = window.open(php+endereco,"centro");
       }
  }
</script>
</head>
<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false">
<form name="form">
<table border="0" class="formulario_geral">
    <tr>
      <td class="formulario_cor"> <div align="center">busca por:</div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">
       <select name="minicurso" onChange="opcoes(this);" class="caixa">
          <option value="#">----------- Minicurso -----------</option>
          <option value="opcao=minicurso&pesquisa=1">01 Cad Topografia</option>
          <option value="opcao=minicurso&pesquisa=2">02 P Calc HP</option>
          <option value="opcao=minicurso&pesquisa=3">03 Lajes Pré-mold</option>
          <option value="opcao=minicurso&pesquisa=4">04 Pavimentação</option>
          <option value="opcao=minicurso&pesquisa=5">05 Impermeabilizantes</option>
          <option value="opcao=minicurso&pesquisa=6">06 Seg do Trabalho</option>
          <option value="opcao=minicurso&pesquisa=7">07 Dosagem de Concreto</option>
          <option value="opcao=minicurso&pesquisa=8">08 Pisos Industriais</option>
          <option value="opcao=minicurso&pesquisa=9">09 Alvenaria Estrutural</option>
          <option value="opcao=minicurso&pesquisa=10">10 Materiais Alternativos</option>
       </select>
       </td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">
      <select name="periodo" onChange="opcoes(this);" class="caixa">
          <option value="#">------------- Período ------------</option>
          <option value="opcao=periodo&pesquisa=1º período" >1º período</option>
          <option value="opcao=periodo&pesquisa=2º período">2º período</option>
          <option value="opcao=periodo&pesquisa=3º período">3º período</option>
          <option value="opcao=periodo&pesquisa=4º período">4º período</option>
          <option value="opcao=periodo&pesquisa=5º período">5º período</option>
          <option value="opcao=periodo&pesquisa=6º período">6º período</option>
          <option value="opcao=periodo&pesquisa=7º período">7º período</option>
          <option value="opcao=periodo&pesquisa=8º período">8º período</option>
          <option value="opcao=periodo&pesquisa=9º período">9º período</option>
          <option value="opcao=periodo&pesquisa=10º período">10º período</option>
          <option value="opcao=periodo&pesquisa=1º ano">1º ano</option>
          <option value="opcao=periodo&pesquisa=2º ano">2º ano</option>
          <option value="opcao=periodo&pesquisa=3º ano">3º ano</option>
          <option value="opcao=periodo&pesquisa=4º ano">4º ano</option>
          <option value="opcao=periodo&pesquisa=5º ano">5º ano</option>
        </select>
      </td>
</table>
</form>
</html>
