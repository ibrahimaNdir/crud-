<?php

session_start();

if (isset($_POST["valider"])) {

    include_once 'ConnexionBD.php';



    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $classes = htmlspecialchars($_POST['classes']);
    











    $insertimage = $db->prepare('INSERT INTO etudiant(nom,prenom,classes) VALUES (?,?,?)');
    $insertimage->execute(array($nom, $prenom, $classes));
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    input {
        width: 400px;
        height: 35px;
        background: #f9fafb;
        border: 1px solid black;
        color: black;
        padding-left: 10px;
        font-size: 15px;
        margin-top: 15px;
        font-family: sans-serif;
        letter-spacing: 1px;
        border-radius: 7px;
        display: block;
    }

    button {
        margin-top: 20px;
        width: 400px;
        height: 40px;
        background-color: black;
        cursor: pointer;
        border: none;
        color: white;
        margin-top: 30px;
        list-style: none;
        border-radius: 10px;
    }

    select {
        width: 400px;
        height: 35px;
        background: #f9fafb;
        border: 1px solid black;
        color: black;
        padding-left: 10px;
        font-size: 15px;
        margin-top: 15px;
        font-family: sans-serif;
        letter-spacing: 1px;
        border-radius: 7px;
        display: block;
    }
</style>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prenom:</label>
        <input type="text" name="prenom" required><br>

        <label for="classes">Classes:</label>
        <input type="text" name="classes" required><br>

        <br>

      

        <button type="submit" name="valider">Envoie</button><br><br>
        <a href="../index.php" class="btn btn-dark">Voir Liste</a>
    </form>













</body>

</html>