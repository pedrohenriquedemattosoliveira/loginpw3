<?php
class Contato{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $pdo;

    public function getNome(){
        return $this->nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    function __construct(){
        $dns    = "mysql:dbname=contato;host=localhost";
        $dbUser = "root";
        $dbPass = "";
        
        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deletar($id){
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function atualizar($id, $nome, $email, $senha){
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    
    function chkUser($email){
        // Primeiro passo crio uma query (consulta sql) e armazeno na variavel $sql
        $sql = "SELECT * FROM usuarios WHERE email = :e";
       
        // Segundo passo, passo os dados para o método prepare da classe PDO
        $stmt = $this->pdo->prepare($sql);
       
        // Terceiro passo, passo os dados para o método bindValue do pdo
        $stmt->bindValue(':e', $email);
       
        // Quarto passo, executo a query
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    function chkUserPass($email, $senha){
        $sql  = "SELECT * FROM usuarios WHERE email = :e AND senha = :s";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":e", $email);
        $stmt->bindValue(":s", $senha);

        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetch();
        }else{
            return array();
        }
    }

    function insertUser($nome, $email, $senha){
        // Primeiro passo crio uma query (consulta sql) e armazeno na variavel $sql
        $sql = "INSERT INTO usuarios set nome = :n, email = :e, senha = :s";

        // Segundo passo, passo os dados para o método prepare da classe PDO
        $stmt = $this->pdo->prepare($sql);
    
        // Terceiro passo, passo os dados para o método bindValue do pdo
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
    
        // Quarto passo, executo a query
        return $stmt->execute();
    }
    public function getAll(){
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}
?>