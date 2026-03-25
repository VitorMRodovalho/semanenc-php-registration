<?php
$s=date("w");//semana em num
$semana=array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");//semana em pt
$dia=date("d");// dia com 2 dig
$m=date("n");//mes em num
$mes=array(1=>"Janeiro","Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");//mes em pt, coleque 1 pt no array "0"
$ano=date("Y");// mes com 4 dig

echo "<b><tt><font size='2' color='#ffffff' face='Verdana, Arial, Helvetica, sans-serif'>$semana[$s], $dia de $mes[$m] de $ano</font></tt></b>";
?>
