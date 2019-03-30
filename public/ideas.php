<?php
require '../connec.php';
$pdo = new PDO(DSN, USER, PASS);



/*
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

*/

$query = "SELECT * FROM idea";
$res = $pdo->query($query);
$ideas = $res->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <header>
        <?php include 'header.php';?>

    </header>

    <div class="container-fluid">

        <?php
        foreach ( $ideas as $key=>$idea) {

            //echo $key;
            echo $idea['id'];
            echo $idea['title'];
            echo $idea['lastname'];
            echo $idea['firstname'];
            echo $idea['content'];
            echo $idea['category'];
            echo $idea['color'];
            ?>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id<?= $idea['id']?>">
                Ajouter un commentaire
            </button>

            <!-- Modal -->
            <form>
            <div class="form-group">
            <div class="modal fade" id="id<?= $idea['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un commentaire</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <textarea placeholder="Ajouter votre commentaire ici"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary">Publier votre commentaire</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </form>




            <?php
        }
        ?>



    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


<?php
/*
$query = "INSERT INTO comment (title, lastname, firstname, content, category, color)
          VALUES (:title, :lastname, :firstname, :content, :category, :color)";
$statement = $pdo->prepare($query);

$statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
$statement->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
$statement->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
$statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
$statement->bindValue(':category', $data['category'], PDO::PARAM_STR);
$statement->bindValue(':color', $data['color'], PDO::PARAM_STR);
$statement->execute();

var_dump($students);*/



