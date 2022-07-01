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
    public function selUserProfile(&$param) {
      $sql = "SELECT iuser, email, nm, cmt, mainimg,
              (SELECT COUNT(ifeed) AS feedCnt
              FROM t_feed
              WHERE iuser = ?) AS feedCnt
              FROM t_user
              WHERE iuser = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(1, $param["iuser"]);
      $stmt->bindValue(2, $param["iuser"]);
      // ? 문자는 순차적으로 들어간다 bindValue를 사용하는 방법과 execute에 array로 집어넣는 방법 둘다 있다.
      // $stmt->execute([$param["iuser"],$param["iuser"]]);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
  }
    
}