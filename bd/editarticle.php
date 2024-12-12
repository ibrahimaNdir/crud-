<?php
// On démarre une session
session_start();

if ($_POST) {
    if (
        isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['classes']) && !empty($_POST['classes'])
       
    ) {
        // On inclut la connexion à la base
        require_once('ConnexionBD.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $classes = strip_tags($_POST['classes']);
       

        $sql = 'UPDATE `etudiant` SET `nom`=:nom,`prenom`=:prenom,`classes`=:classes WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':classes', $classes, PDO::PARAM_STR);
       

        $query->execute();

        $_SESSION['message'] = "Etudiant  modifié";


        header('Location: ../index.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('ConnexionBD.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `etudiant` WHERE `id` = :id;';

    // On prépare la requête

    $query = $db->prepare($sql);
    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if (!$produit) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Etudiant</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <h1>Modifier Etudiant</h1>
                <form method="post">

                    <div class="form-group">
                        <label for="produit">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?= $produit['nom'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Prenom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" value="<?= $produit['prenom'] ?>">
                    </div>


                    <div class="form-group">
                        <label for="prix">Classes</label>
                        <input type="text" id="classes" name="classes" class="form-control" value="<?= $produit['classes'] ?>">

                    </div>

                    
                    <input type="hidden" value="<?= $produit['id'] ?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>

</html>