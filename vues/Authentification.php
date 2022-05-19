<header>
    <h1>Le Blog</h1>
    <section></section>
</header>
<main>
    <article>
        <h2>Authentification</h2>
        <form method="POST" action="index.php">
            <div>
                <label for="userName">Nom</label><br>
                <input type="text" name="userName" id="userName">
            </div>
            <div>
                <label for="password">Mot de passe</label><br>
                <input type="password" name="password" id="password">
            </div>
            <input type="hidden" name="commande" value="AuthentifieUtilisateur"/>
            <button type="submit" name="btnLogin">Valider</button>
        </form>
        <?php 
            if(isset($donnees["messageErreur"]))
                echo "<span>" . $donnees["messageErreur"] . "</span>";
        ?>
    </article>
    <div>
        <a href="index.php">Retourner à l'accueil</a>
    </div>
</main>

