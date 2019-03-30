<?php
require '../connec.php';
$pdo = new PDO(DSN, USER, PASS);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
/*********************Insert comment*********************/

/*
$data['title']= 'un titre6';
$data['lastname']= 'un prénom6';
$data['firstname'] = 'un nom6';
$data['content']= 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sesse cillum dolore eu fugiat nulla pariatur.';
$data['category']= 'La vie à la Wild';
$data['color']= 'blue';


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

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['comment'])) {
        $errors['comment'] = 'Merci de rentrer votre commentaire';
    }
    if (empty($errors)) {

        $query = "INSERT INTO comment (idea_id, comment)
          VALUES (:idea_id, :comment)";
        $statement = $pdo->prepare($query);

        $statement->bindValue(':idea_id', $_POST['idea_id'], PDO::PARAM_STR);
        $statement->bindValue(':comment', $_POST['comment'], PDO::PARAM_STR);
        $statement->execute();
        header('Location:ideas.php');
    }
}
/******************** Show the ideas ********************/
$query = "SELECT * FROM idea";
$res = $pdo->query($query);
$ideas = $res->fetchAll(PDO::FETCH_ASSOC);

$query2 = "SELECT comment FROM comment c INNER JOIN idea i ON c.idea_id = i.id WHERE c.idea_id = i.id";
$res = $pdo->query($query2);
$comment =$res->fetchAll(PDO::FETCH_ASSOC);
var_dump($comment);
?>

<!-- ***************Start the html page **************-->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<h1>Hello, world!</h1>
<header>
    <?php include 'header.php'; ?>
</header>
<div class="container-fluid">
    <div class="row">
        <?php
        foreach ($ideas as $key => $idea) {

            ?>
            <div class="card <?= $idea['color'] ?>" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> <?= $idea['title']; ?> </h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $idea['lastname'] . ' '
                        . $idea['firstname']; ?></h6>
                    <h6 class="card-subtitle"> <?= $idea['category']; ?></h6>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#id<?= $idea['id'] ?>">
                        Ajouter un commentaire
                    </button>
                    <p>
                        <a data-toggle="collapse" href="#collapse<?= $idea['id'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Voir les commentaires
                        </a>
                    <div class="collapse" id="collapse<?= $idea['id'] ?>">
                        <div class="card card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </div>
                    </div>
                    </p>
                </div>
            </div>
            <!-- Modal -->
            <form method="post" action="ideas.php">
                <div class="form-group">
                    <div class="modal fade" id="id<?= $idea['id'] ?>" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un commentaire</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <textarea name="comment" id="comment"
                                              placeholder="Ajouter votre commentaire ici"></textarea>
                                    <input name="idea_id" type="hidden" value="<?= $idea['id'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer
                                    </button>
                                    <button type="submit" class="btn btn-primary">Publier votre commentaire</button>
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
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>







