<?php

namespace Controller;
use Doctrine\DBAL\Query\QueryBuilder;
class IndexController{
  public function indexAction(){
    include("search.php");
  }
  public function searchAction(){
    //se connecter à la bdd
    header('Content-Type: application/json');
    $config = new \Doctrine\DBAL\Configuration();
    $connectionParams = array(
        'url' => 'mysql://root:root@127.0.0.1/supinternet_moviesearch?charset=utf8mb4',
    );
    $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);



      if(isset($_POST['title'])){

          $title = strip_tags($_POST['title']);
          $title = htmlentities($title);
          $title = trim($title);


          $stmt = $conn->prepare('SELECT * FROM film_director INNER JOIN artist AS a
                            ON artist_id = a.id INNER JOIN film AS f
                            ON film_director.film_id = f.id WHERE f.title LIKE :title');
          $stmt->bindParam('title', $title);
      }

      else{
          $stmt = $conn->prepare('SELECT * FROM film_director INNER JOIN artist AS a
                            ON artist_id = a.id INNER JOIN film AS f
                            ON film_director.film_id = f.id WHERE 1');
      }

      $stmt->execute();
      $films = $stmt->fetchAll();
      return json_encode(["films" => $films]);





  }

}
