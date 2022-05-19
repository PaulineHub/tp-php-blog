<?php
    /* define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "blog"); */

    define("SERVER", "localhost");
    define("USERNAME", "e2194480");
    define("PASSWORD", "4pNXFyXLkwnPMwq3N1Z0");
    define("DBNAME", "e2194480");

    function connectDB()
    {
        //se connecter à la base de données
        $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);
        if(!$c)
            trigger_error("Erreur de connexion : " . mysqli_connect_error());
        //s'assurer que la connection traite du UTF8
        mysqli_query($c, "SET NAMES 'utf8'");
        return $c;
    }

    $connexion = connectDB();

    function obtenir_articles()
    {
        global $connexion;
        $requete = "SELECT article.id, titre, texte, usager.nom AS usagerNom FROM article JOIN usager ON usager.id = article.idUsager ORDER BY article.id DESC";
        //exécuter la requête avec mysqli 
        $resultats = mysqli_query($connexion, $requete);
        //retourner le résultat
        return $resultats;
    }

    function recherche_articles($rech)
    {
        global $connexion;
        $requete = "SELECT article.id, titre, texte, usager.nom AS usagerNom FROM article JOIN usager ON usager.id = article.idUsager WHERE titre LIKE ? OR texte LIKE ?";
        //préparer la requête 
        if($reqPrep = mysqli_prepare($connexion, $requete))
        {
            //lier les paramètres
            mysqli_stmt_bind_param($reqPrep, "ss", $rech, $rech);
            //exécuter la requête 
            mysqli_stmt_execute($reqPrep);
            $resultats = mysqli_stmt_get_result($reqPrep);
            //retourner les resultats, sinon afficher l'erreur
            if(mysqli_affected_rows($connexion) > 0)
                return $resultats;
            else 
                die("Aucun résultat pour cette recherche.");
        }
    }

    function authentifie_utilisateur($username, $motDePasse)
    {
        global $connexion;
        $requete = "SELECT motDePasse from usager WHERE nom=?";
        //préparer la requête 
        if($reqPrep = mysqli_prepare($connexion, $requete))
        {
            //faire le lien entre les paramètres de la fonction ($username) et les paramètres de la requête (les ?)
            mysqli_stmt_bind_param($reqPrep, "s", $username);
            //exécuter la requête
            mysqli_stmt_execute($reqPrep);
            //obtenir les résultats
            $resultats = mysqli_stmt_get_result($reqPrep);
            //si l'usager existe dans la DB, verifier le mot de passe
            if(mysqli_num_rows($resultats) > 0)
            {
                $rangee = mysqli_fetch_assoc($resultats);
                $motDePasseEncrypte = $rangee["motDePasse"];
                if(password_verify($motDePasse, $motDePasseEncrypte))
                    return true;
                else    
                    return false;
            }    
            else
                return false;
        }
    }

    function obtenir_id_usager($username)
    {
        global $connexion;
        $requete = "SELECT id from usager WHERE nom='$username'";
        //obtenir les résultats
        $resultats = mysqli_query($connexion, $requete);
        $rangee = mysqli_fetch_assoc($resultats);
        $id = $rangee["id"];
        //retourner le résultat (id de l'usager)
        return $id; 
    }

    function obtenir_article($id)
    {
        global $connexion;
        $requete = "SELECT id, titre, texte FROM article WHERE id=$id";
        //exécuter la requête avec mysqli 
        $resultats = mysqli_query($connexion, $requete);
        //retourner resultat
        return $resultats;
    }

    function ajoute_article($titre, $texte, $idUsager)
    {
        global $connexion;
        $requete = "INSERT INTO article(titre, texte, idUsager) VALUES (?, ?, $idUsager)";
        //préparer la requête 
        if($reqPrep = mysqli_prepare($connexion, $requete))
        {
            //lier les paramètres
            mysqli_stmt_bind_param($reqPrep, "ss", $titre, $texte);
            //exécuter la requête 
            mysqli_stmt_execute($reqPrep);
            //si l'insertion a fonctionné, retourner vrai, sinon afficher l'erreur
            if(mysqli_affected_rows($connexion) > 0)
                return true;
            else 
                die("Erreur lors de l'insertion.");
        }
    }

    function verifier_auteur_article($idArticle, $usager)
    {
        global $connexion;
        $requete = "SELECT article.id, nom FROM article JOIN usager ON usager.id = article.idUsager WHERE article.id=$idArticle AND nom='$usager'";
        //exécuter la requête avec mysqli 
        $resultats = mysqli_query($connexion, $requete);
        //si l'usager existe dans la DB, retourner vrai, sinon retourner faux
        if(mysqli_num_rows($resultats) > 0)
            return true;
        else
            return false;
    }

    function modifie_article($id, $titre, $texte)
    {
        global $connexion;
        $requete = "UPDATE article SET titre=?, texte=? WHERE id=$id";
        //préparer la requête 
        $reqPrep = mysqli_prepare($connexion, $requete);
        //si la requête est valide
        if($reqPrep)
        {       
            //faire le lien entre les paramètres de la fonction ($titre, $texte) et les paramètres de la requête (les ?)
            mysqli_stmt_bind_param($reqPrep, "ss", $titre, $texte);
            //exécuter la requête
            $resultats = mysqli_stmt_execute($reqPrep);
            //retourner le résultat (vrai ou faux)
            return $resultats;
        }
    }

    function supprime_article($idArticle)
    {
        global $connexion;
        $requete = "DELETE FROM article WHERE id=$idArticle";
        //appel de mysqli_query 
        $resultat = mysqli_query($connexion, $requete);
        //si la requete retourne un objet
        if($resultat)
        {
            //si la suppression a affecte au moins une ligne, retourner vrai
            if(mysqli_affected_rows($connexion) > 0)
                return true;
            else
                return false;
        }
        //si la requete retourne faux, retourner faux
        else 
            return false;
    }
    

    ?>