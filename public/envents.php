<?php

include 'modal.php';
$pdo = new PDO(DSN, USER, PASS);
$pdo2 = new PDO(DSN, USER, PASS);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
/*********************Insert comment*********************/


$query2 = "SELECT * FROM comment JOIN idea ON idea.id = comment.idea_id";
$statement2 = $pdo2->query($query2);
$commentJoin = $statement2->fetchAll(PDO::FETCH_ASSOC);
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
$query = "SELECT * FROM idea WHERE category = 'Evènements entre Wilders'";
$res = $pdo->query($query);
$ideas = $res->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ***************Start the html page **************-->

<body>

<header>
    <?php include 'header.php'; ?>
</header>
<div class="container">
    <div class="row">
        <?php
        foreach ($ideas as $key => $idea) {

            ?>
            <div class="card <?= $idea['color'] ?>" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> <?= $idea['title']; ?> </h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $idea['lastname'] . ' ' . $idea['firstname']; ?></h6>
                    <h6 class="card-subtitle"> <?= $idea['category']; ?></h6>
                    <p><?= $idea['content']; ?></p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#id<?= $idea['id'] ?>">
                        Ajouter un commentaire
                    </button>
                    <p>
                        <a data-toggle="collapse" href="#collapse<?= $idea['id'] ?>" role="button" aria-expanded="false"
                           aria-controls="collapseExample">
                            Voir les commentaires
                        </a>
                    <div class="collapse" id="collapse<?= $idea['id'] ?>">
                        <div class="card card-body">
                            <?php foreach ($commentJoin as $key => $comment) {
                                if ($idea['id'] == $comment['idea_id']) {
                                    echo $comment['comment'];
                                }
                            } ?>
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
                                    <button type="submit" class="btn btn-success">Publier votre commentaire</button>
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
<?php include 'footer.php'; ?>
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







