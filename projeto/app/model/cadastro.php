<?php

 class Cadastro 
 {
    public static function selecionaTodos()
    {
        $con = Connection::getConn();
        $sql = "SELECT * FROM cadastro ORDER BY id DESC";
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject('Cadastro')) {
            $resultado[] = $row;
        }

        return $resultado;
    }

    public static function insert($dadosPost) 
    {

     if($dadosPost == null) {
        throw new Exception("Preencha todos os campos");
        return false;   

       } if ($dadosPost['nome'] && $dadosPost['quantidade'] && $dadosPost['preco'] && $dadosPost['codBarra'] !== null ) {
        
        $con = Connection::getConn();
       
        $sql = $con->prepare('INSERT INTO cadastro (nome, quantidade, preco, codBarra) VALUES (:n, :q, :p, :c)');
        $sql->bindValue(':n', $dadosPost['nome']);
        $sql->bindValue(':q', $dadosPost['quantidade']);
        $sql->bindValue(':p', $dadosPost['preco']);
        $sql->bindValue(':c', $dadosPost['codBarra']);
        $res = $sql->execute();

        return true;

       } else {
       
        echo '<script>alert("Falha ao enserir os dados");</script>';
        return true; 
       }

     
    }
 }

?>