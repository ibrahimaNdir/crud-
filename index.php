<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('bd/ConnexionBD.php');

$sql = 'SELECT * FROM `etudiant`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integr ity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
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
                <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                    $_SESSION['message'] = "";
                }
                ?>
                <h1>Liste des Etudiant</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Nom </th>
                        <th>Prenom</th>
                        <th>Classes</th>
                        <th>Action</th> 
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur la variable result
                        foreach ($result as $produit) {
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?= $produit['nom'] ?></td>
                                <td><?= $produit['prenom'] ?></td>
                                <td><?= $produit['classes'] ?></td>
                                <td><a href="./bd/detailarticle.php?id=<?= $produit['id'] ?>">Voir</a> <a href="./bd/editarticle.php?id=<?= $produit['id'] ?>">Modifier</a><a href="./bd/deletearticle.php?id=<?= $produit['id'] ?>"><ion-icon name="trash-outline"></ion-icon></a></td> 
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="./bd/addarticle.php" class="btn btn-dark">Ajouter un etudiant</a><br>
                
            
            </section>
        </div>
    </main>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>

</html>