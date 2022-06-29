<?php

namespace application\models;

use PDO;

class FeedModel extends Model
{
    public function insFeed(&$param)
    {
        $sql = "INSERT INTO t_feed
        (location, ctnt, iuser)
        VALUES
        (:location, :ctnt, :iuser)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":location", $param["location"]);
        $stmt->bindValue(":ctnt", $param["ctnt"]);
        $stmt->bindValue(":iuser", $param["iuser"]);
        $stmt->execute();
        return intval($this->pdo->lastInsertId());
    }

    public function insFeedImg(&$param){
      $sql = "INSERT INTO t_feed_img
        (ifeed, img)
        VALUES
        (:ifeed, :img)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":ifeed", $param["ifeed"]);
        $stmt->bindValue(":img", $param["img"]);
        $stmt->execute();
        // 디비에서 영향을 미친 레코드 수
        return $stmt->rowCount();
    }
    public function selFeedList(&$param){
      $sql = "SELECT A.ifeed, A.location, A.ctnt, A.iuser, A.regdt
              , C.nm AS writer, C.mainimg
              , IFNULL(E.cnt,0) AS favCnt
              , IF(E.ifeed IS NULL, 0 ,1) AS isFav
              FROM t_feed A
              INNER JOIN t_user C
              ON A.iuser = C.iuser
                LEFT JOIN (
                  SELECT ifeed, COUNT(ifeed) AS cnt, iuser
                  FROM t_feed_fav
                  GROUP BY ifeed
                ) E
              ON A.ifeed = E.ifeed
              -- inner join은 서로 공통으로 있는것만 띄우기
              -- left join은 왼쪽에 있는것은 무조건 띄워주고 
              -- 오른쪽은 공통으로 있는것만 띄우기
                LEFT JOIN (
                  SELECT ifeed
                  FROM t_feed_fav
                  WHERE iuser = :iuser
                ) D
              ON A.ifeed = D.ifeed
              ORDER BY A.ifeed DESC
              LIMIT :startIdx, :feedItemCnt";
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(":iuser", $param["iuser"]);
      $stmt->bindValue(":startIdx", $param["startIdx"]);
      $stmt->bindValue(":feedItemCnt", _FEED_ITEM_CNT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}