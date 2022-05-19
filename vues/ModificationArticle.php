<?php
$article = $donnees["article"];
$rangee = mysqli_fetch_assoc($article);
$titre = htmlspecialchars($rangee["titre"]);
$texte = htmlspecialchars($rangee["texte"]);
$id = $rangee["id"];
?>

<header>
    <h1>Le Blog</h1>
    <section></section>
</header>
<main>
    <article>
        <h2>Modification d'un article</h2>
        <span>
            <?php 
            if(isset($donnees["messageErreur"]))
                echo "<p>" . $donnees["messageErreur"] . "</p>";
        ?>
        </span>
        <form method="POST" action="index.php">
            <div>
                <label for="titre">Titre</label><br>
                <input type="text" name="titre" id="titre" class="inputTitre" value="<?= $titre ?>">
            </div>
            <div>
                <textarea name="texte" id="texte"><?= $texte ?></textarea>
            </div>
            <input type="hidden" name="idArticle" value="<?= $id ?>"/><br>
            <input type="hidden" name="commande" value="ModifieArticle"/><br>
            <button type="submit">Valider</button>
        </form>
    </article>
    <div>
        <a href="index.php">Retourner à l'accueil</a>
    </div>
</main>


