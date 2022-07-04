<?php
namespace application\models;
use PDO;
//$pdo -> lastInsertId();

class UserModel extends Model {
    public function insUser(&$param) {
        $sql = "INSERT INTO t_user
                ( email, pw, nm ) 
                VALUES 
                ( :email, :pw, :nm )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $param["email"]);
        $stmt->bindValue(":pw", $param["pw"]);
        $stmt->bindValue(":nm", $param["nm"]);
        $stmt->execute();
        return $stmt->rowCount();

    }
    public function selUser(&$param) {
        $sql = "SELECT * FROM t_user
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $param["email"]);        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /* ---------------- FAV --------------- */
    public function selUserProfile(&$param) {
      $feediuser = $param["feediuser"];
      $loginiuser = $param["loginiuser"];
      $sql = "SELECT iuser, email, nm, cmt, mainimg,
              (SELECT COUNT(ifeed) FROM t_feed WHERE iuser = {$feediuser}) AS feedcnt,
              (SELECT COUNT(fromiuser) FROM t_user_follow WHERE fromiuser = {$feediuser} AND toiuser = {$loginiuser}) AS youme,
              (SELECT COUNT(toiuser) FROM t_user_follow WHERE fromiuser = {$loginiuser} AND toiuser = {$feediuser}) AS meyou
              FROM t_user
              WHERE iuser = {$feediuser}";
      $stmt = $this->pdo->prepare($sql);

      // ? 문자는 순차적으로 들어간다 bindValue를 사용하는 방법과 execute에 array로 집어넣는 방법 둘다 있다.
      // $stmt->execute([$param["iuser"],$param["iuser"]]);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
  }
  

    /* ---------------- Follow --------------- */

    public function insFollow(&$param){
      $sql = "INSERT INTO t_user_follow (fromiuser, toiuser) VALUES (:loginiuser,:feediuser)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":feediuser", $param["feediuser"]);
      $stmt->bindValue(":loginiuser", $param["loginiuser"]);    
      $stmt->execute();
    }
    public function delFollow(&$param){
      $sql = "DELETE FROM t_user_follow WHERE fromiuser=:loginiuser AND toiuser=:feediuser;";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":feediuser", $param["feediuser"]);
      $stmt->bindValue(":loginiuser", $param["loginiuser"]);   
      $stmt->execute();
    }

}