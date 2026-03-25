<?php
session_start();// inicia sessao

//VALIDA LOGIN
if(isset($_POST['oculto']))
  {
    $_POST['oculto']();
  }
function valida_validacao_php()
 {
    include "../conexao/conexao.php"; // CONECTA E SELECIONA O BANCO DE DADOS
	
	if(isset($_POST['usuario']) && isset($_POST['senha']))
     {
       $user=$_POST['usuario'];
       $pass=$_POST['senha'];
     }
	 else
	 {
	  echo "ERRO";
	 }
	 $conta_pass=strlen($pass);  // CONTA A QUANTIDADE DE CARACTERES	
    
	 if(($conta_pass >=6) && !empty($user) && !empty($pass))
	    {
		 $sql ="SELECT id_usuarios, usuarios, senha, statos from tb_quinsem_usuarios where usuarios='$user' and senha='$pass';";
	     $query = mysql_query($sql) or die ("<b>Erro de Query</b>"); // FAZ A PESQUISA
		 $linhas= mysql_num_rows($query);
		  if($linhas==1)
		    {
              $id=mysql_result($query, 0, 0);
			  $usuario=mysql_result($query, 0, 1);
			  $senha=mysql_result($query, 0, 2);
			     $cripto_senha= substr(crypt($senha,substr($usuario, 0, 2)), 2);
                  //  CRIPTOGRAFA EM CRYPT A SENHA COM O SALT DAS DUAS PRIMEIRAS LETRAS DO USUARIO
			  $statos=mysql_result($query, 0, 3);
			  $unixtime=strtotime('now');
			  
			  $sql2="INSERT INTO tb_quinsem_logado (user_logado, pass_logado, statos_logado, unixtime, id_user) VALUES ('$usuario','$cripto_senha','$statos','$unixtime','$id')";
              $incluir=mysql_query($sql2) or die('erro ao incluir');
			  
			  if($statos=="mestre")
			    {

                   setcookie("id", session_id(), 0, '/'); // CRIA COOKIE'S
                   setcookie("usuario", $usuario, 0, '/');
				   setcookie("senha", $cripto_senha, 0, '/');

				   header("LOCATION: ../mestre_cadastro.php");
				}
			  else
			    {	      
                   setcookie("id", session_id(), 0, '/'); // CRIA COOKIE'S
			       setcookie("usuario", $usuario, 0, '/');
			       setcookie("senha", $cripto_senha, 0, '/');

                   
				   header("LOCATION: ../index2.php");
			     } 
	        }
	      else
	        {
	          header("LOCATION: ../erro.php");
	        }
         }
	   else
	     {
		   header("LOCATION: ../erro.php");
		 }
 }
//VERIFICA LOGIN
function verifica_validacao_php($restrita=0)
 {
    include "conexao/conexao.php";

	 if(!empty($_COOKIE['usuario']) && !empty($_COOKIE['senha']) && !empty($_COOKIE['id']))
	   {
         $usuario_cookie = $_COOKIE['usuario'];
         $senha_cookie = $_COOKIE['senha'];
         $id_cookie = $_COOKIE['id'];

         $id_agora = session_id();

         $tempo_valido=30;// tempo de permanencia na caso inativo
         $unixtime_valido=strtotime('NOW')-(60*$tempo_valido);//Tempo atual mnos tempo valido,resultado e o ultimo tempo que é valido p user online
		 $sql="DELETE FROM tb_quinsem_logado WHERE unixtime < '$unixtime_valido';";
         $deleta=mysql_query($sql);//Deleta todos os tempos estourados
		 $sql2="SELECT pass_logado, statos_logado, unixtime, id_user FROM tb_quinsem_logado
                 WHERE user_logado='$usuario_cookie' ORDER BY unixtime DESC";
	     $selecao=mysql_query($sql2);
	     $linhas=mysql_num_rows($selecao);
		 if($linhas <= 0)
		   {
		    header("LOCATION: erro.php");
		   }
	         $pass=mysql_result($selecao,0,0);
		     $statos=mysql_result($selecao,0,1);
		     $unixtime=mysql_result($selecao,0,2);
		     $id=mysql_result($selecao,0,3);		 
		   

	        if (($restrita==$statos) && $pass==$senha_cookie && $id_cookie==$id_agora)
			  {
		        $unixtime=strtotime('now');
				$sql3= "UPDATE tb_quinsem_logado SET unixtime='$unixtime' WHERE user_logado='$usuario_cookie'";
				$update= mysql_query($sql3);
				return $statos;
		      }
	        else
			  {
	           header("LOCATION: erro.php");
		      }
	   }		  
    else  
       {
          header("LOCATION: erro.php");
	   }
 }	  
?>
