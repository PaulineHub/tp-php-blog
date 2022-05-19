<header>
    <nav>
        <?php
        if(isset($_SESSION["usager"]))
        {
            echo "<div>
                    <a href='index.php?commande=CreationArticle'>Créer un article</a>
                </div>";
        }
        ?>
        <div>
            <a href=<?php echo isset($_SESSION["usager"]) ? "index.php?commande=Deconnexion" : "index.php?commande=Authentification"?>>
                <?php echo isset($_SESSION["usager"]) ? "Déconnexion" : "Connexion"?>
            </a>
        </div>
    </nav>
    <h1>Le Blog</h1>
    <section>
        <?php 
            if(isset($donnees["messageErreur"]))
                echo "<span>" . $donnees["messageErreur"] . "</span>";
            if(isset($donnees["message"]))
                echo "<span class='message'>" . $donnees["message"] . "</span>";
        ?>
        <form class="search-container" method="GET" action="index.php">
            <input type="text" placeholder="Recherche..." name="recherche">
            <input type="hidden" name="commande" value="RechercheArticle"/>
            <button type="submit">Rechercher</button>
        </form>
        
    </section>
</header>
<main>
    <?php
        $articles = $donnees["articles"];
        while($rangee = mysqli_fetch_assoc($articles))
        {
            echo "<article>";
            echo "<h2>" . htmlspecialchars($rangee["titre"]) . "</h2>";
            if(isset($_SESSION["usager"]) && ($_SESSION["usager"] == $rangee["usagerNom"])){
                echo "<br>";
                echo "<a href='index.php?commande=ModificationArticle&idArticle={$rangee["id"]}'>Modifier cet article</a>";
                echo "<br>";
                echo "<a href='index.php?commande=SuppressionArticle&idArticle={$rangee["id"]}'>Supprimer cet article</a>";
            }
            echo "<div>" . htmlspecialchars($rangee["texte"]) . "</div>";
            echo "<div>{$rangee["usagerNom"]}</div>";
            echo "</article>";
        }
    ?>
    <div>
        <a href="index.php">Retourner à l'accueil</a>
    </div>
</main>

