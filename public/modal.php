<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>I.d Box</title>
</head>

<?php
require '../connec.php';
include '../src/functions.php';
$errors = [];
$pdo = new PDO(DSN, USER, PASS);
$pdo2 = new PDO(DSN, USER, PASS);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $couleurs= ['green','blue','pink'];
    $nbrcouleurs = count($couleurs) -1;
    $rand = rand(0, $nbrcouleurs);
    $lacouleur = $couleurs[$rand];
    $data = cleanInput($_POST);

    if (empty($data["firstname"])) {
        $errors["firstname"] = "Entrez votre nom";
    }
    if (empty($data["title"])) {
        $errors["title"] = "Entrez un titre";
    }
    if (empty($data["lastname"])) {
        $errors["lastname"] = "Entrez votre nom";
    }
    if (empty($data["content"])) {
        $errors["content"] = "Veuillez entrer votre idée";
    }
echo $data["content"];
    if (empty($errors)) {

        $query = "INSERT INTO idea (title, lastname, firstname, content, category, color)
      VALUES (:title, :lastname, :firstname, :content, :category, :color)";
        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $statement->bindValue(':category', $data['category'], PDO::PARAM_STR);
        $statement->bindValue(':color', $lacouleur, PDO::PARAM_STR);
        $statement->execute();

        $query2 = "SELECT * FROM comment JOIN idea ON idea.id = comment.idea_id";
        $statement2 = $pdo2->query($query2);
        $commentJoin = $statement2->fetchAll(PDO::FETCH_ASSOC);

        header('location:ideas.php');
    }

}
?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">La boite à idée</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <span class="error">* <?php if (isset($errors["firstname"])){echo $errors["firstname"];}?></span>
                        <input type="text" class="form-control" id="firstname" placeholder="John" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <span class="error">* <?php if (isset($errors["lastname"])){echo $errors["lastname"];}?></span>
                        <input type="text" class="form-control" id="lastname" placeholder="Dupont" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="categorie">Choisi ta catégorie</label>
                        <select class="form-control" id="categorie" name="category">
                            <option>La vie à la Wild</option>
                            <option>Evènements entre Wilders</option>
                            <option>Sujet de veille</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <span class="error">* <?php if (isset($errors["title"])){echo $errors["title"];}?></span>
                        <input type="text" class="form-control" id="title" placeholder="Trouvez une idée de titre ;)" name="title">
                    </div>
                    <div class="form-group">
                        <label for="content">Post-it tes idées ici</label>
                        <span class="error">* <?php if (isset($errors["content"])){echo $errors["content"];}?></span>
                        <textarea class="form-control" id="content" rows="3" name="content" placeholder="Propose ton idée"></textarea>
                    </div>
                    <button type="submit" class="btn btn-idea">Soumettre l'idée</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>