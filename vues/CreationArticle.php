<header>
    <h1>Le Blog</h1>
    <section></section>
</header>
<main>
    <article>
        <h2>Création d'un article</h2>
        <span>
            <?php 
            if(isset($donnees["messageErreur"]))
                echo "<p>" . $donnees["messageErreur"] . "</p>";
        ?>
        </span>
        <form method="POST" action="index.php">
            <div>
                <label for="titre">Titre</label><br>
                <input type="text" name="titre" id="titre" class="inputTitre" value="<?php echo isset($_REQUEST["titre"])? $_REQUEST["titre"] : '' ?>">
            </div>
            <div>
                <textarea name="texte" id="texte" type="text"><?php echo isset($_REQUEST["texte"])? $_REQUEST["texte"] : '' ?></textarea>
            </div>
            <input type="hidden" name="commande" value="CreeArticle"/><br>
            <button type="submit">Valider</button>
        </form>
    </article>
    <div>
        <a href="index.php">Retourner à l'accueil</a>
    </div>
</main>

