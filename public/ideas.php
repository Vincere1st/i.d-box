<?php
require '../connec.php';
$pdo = new PDO(DSN, USER, PASS);

$data['title']= 'un titre de test';
$data['lastname']= 'un nom de test';
$data['firstname']= 'un prénom de test';
$data['content']= 'un  contenu de test';
$data['category']= 'une catégorie de test';
$data['color']= 'une couleur de test';

$query = "INSERT INTO idea (title, lastname, firstname, content, category, color)
          VALUES (:title, :lastname, :firstname, :content, :category, :color)";
$statement = $pdo->prepare($query);

$statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
$statement->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
$statement->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
$statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
$statement->bindValue(':category', $data['category'], PDO::PARAM_STR);
$statement->bindValue(':color', $data['color'], PDO::PARAM_STR);
$statement->execute();




/*
$query = "SELECT * FROM idea WHERE ";
$res = $pdo->query($query);
$students = $res->fetchAll(PDO::FETCH_ASSOC);

var_dump($students);*/

