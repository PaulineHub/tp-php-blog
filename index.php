<?php
    //réception du paramètre commande, qui peut arriver en GET ou en POST 
    if(isset($_REQUEST["commande"]))
    {
        $commande = $_REQUEST["commande"];
    }
    else
    {
        //assigner une commande par défaut (page d'accueil)
        $commande = "Accueil";
    }
    //inclure le modele
    require_once("modele.php");
    //création du tableau $donnees qui sera utilisé aussi dans les vues
    $donnees = array();
    //=========================================
    //structure décisionnelle du contrôleur
    switch($commande)
    {
        /* Accueil ==================== */
        case "Accueil":
            session_start();
            //obtenir le modele dont j'ai besoin (les articles triés par id DESC)
            $donnees["titre"] = "Accueil";
            $donnees["articles"] = obtenir_articles();
            //afficher la ou les vues qu'on veut afficher
            require_once("vues/Entete.php");
            require_once("vues/Accueil.php");
            require_once("vues/PiedDePage.php");
            break;

        /* Recherche ==================== */
        case "RechercheArticle":
            session_start();
            if(isset($_REQUEST["recherche"]))
            {     
                 //rechercher tous les enregistrements qui contiennent ces caractères
                 if($_REQUEST["recherche"] != "")
                 {
                    $recherche = "%" . $_REQUEST["recherche"] . "%";
                    //obtenir le modele dont j'ai besoin (les articles cherchés)
                    $donnees["titre"] = "Accueil";
                    $donnees["articles"] = recherche_articles($recherche);
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/Accueil.php");
                    require_once("vues/PiedDePage.php");  
                }
                // si champ vide, afficher message d'erreur en page d'accueil
                else 
                {
                    $donnees["messageErreur"] = "Champ vide";
                    $donnees["titre"] = "Accueil";
                    $donnees["articles"] = obtenir_articles();
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/Accueil.php");
                    require_once("vues/PiedDePage.php");
                }
            }
            break;

        /* Authentification / Deconnexion ==================== */
        case "Authentification":
            //afficher la page d'authentification
            $donnees["titre"] = "Authentification";
            //afficher la ou les vues qu'on veut afficher
            require_once("vues/Entete.php");
            require_once("vues/Authentification.php");
            require_once("vues/PiedDePage.php");
            break;

        case "AuthentifieUtilisateur":
            session_start();
            if(isset($_REQUEST["btnLogin"]))
            {
                //si champs remplis, comparer identifiants avec la DB
                if(!empty($_REQUEST["userName"]) && !empty($_REQUEST["password"]))
                {
                    $test = authentifie_utilisateur($_REQUEST["userName"], $_REQUEST["password"]);
                    //si la combinaison est valide, enregistrer le nom de l'usager dans une variable SESSION et rediriger vers la page accueil
                    if($test)
                    {
                        $_SESSION["usager"] = $_REQUEST["userName"];
                        header("Location: index.php");
                        die();
                    }
                    //si l'usager n'existe pas dans la DB, afficher message d'erreur dans la page d'authentification
                    else 
                    {
                        $donnees["messageErreur"] = "Mauvaise combinaison nom d'utilisateur.ice / mot de passe.";
                        $donnees["titre"] = "Authentification";
                        //afficher la ou les vues qu'on veut afficher
                        require_once("vues/Entete.php");
                        require_once("vues/Authentification.php");
                        require_once("vues/PiedDePage.php");
                    } 
                }
                // si un des champs est vide, affiche message d'erreur dans la page d'authentification
                else 
                {
                    $donnees["messageErreur"] = "Veuillez remplir les champs";
                    $donnees["titre"] = "Authentification";
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/Authentification.php");
                    require_once("vues/PiedDePage.php");
                }  
            }
            break;

        case "Deconnexion":
            //initialiser la session
            session_start();
            //detruire les variables de la session
            $_SESSION = array();
            //effacer le cookie de session
            if (ini_get("session.use_cookies")) 
            {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            //detruire la session
            session_destroy();
            //retourner a la page d'accueil
            header("Location: index.php");
            die();
            break;

        /* Creation article ==================== */
        case "CreationArticle":
            session_start();
            //si l'usager est connecté, afficher la page de création d'articles
            if(isset($_SESSION["usager"]))
            {
                $donnees["titre"] = "Creation Article";
                //afficher la ou les vues qu'on veut afficher
                require_once("vues/Entete.php");
                require_once("vues/CreationArticle.php");
                require_once("vues/PiedDePage.php");
            }
            //si usager non connecté, rediriger vers page d'accueil
            else
            {
                header("Location: index.php");
                die();
            }               
            break;

        case "CreeArticle":
            session_start();
            //si on reçoit une requête d'un usager connecté et qu'on vient du formulaire de création
            if(isset($_SESSION["usager"]) && isset($_REQUEST["titre"]) && isset($_REQUEST["texte"]))
            {
                $nomUsager = $_SESSION["usager"];
                $titre = trim($_REQUEST["titre"]);
                $texte = trim($_REQUEST["texte"]);
                //si les champs sont remplis, on traite le formulaire
                if(!empty($titre) && !empty($texte))
                {
                    //on obtient l'id de l'auteur.ice
                    $idUsager = obtenir_id_usager($nomUsager);
                    //ajouter l'article à la DB
                    $test = ajoute_article($titre, $texte, $idUsager);
                    //si l'ajout réussi, rediriger vers la page d'accueil
                    if($test)
                    {
                        header("Location: index.php");
                        die();
                    }
                    //message erreur sur la page Création si l'ajout échoue    
                    else 
                    {
                        $donnees["messageErreur"] = "Erreur lors de la creation.";
                        $donnees["titre"] = "Création article";
                        //afficher la ou les vues qu'on veut afficher
                        require_once("vues/Entete.php");
                        require_once("vues/CreationArticle.php");
                        require_once("vues/PiedDePage.php");
                    }
                }
                //si un des champs est vide, afficher message d'erreur sur la page Création 
                else
                {
                    $donnees["messageErreur"] = "Il faut entrer des valeurs dans tous les champs.";
                    $donnees["titre"] = "Création Article";
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/CreationArticle.php");
                    require_once("vues/PiedDePage.php");
                }
            }
            break;

        /* Modification article ==================== */
        case "ModificationArticle":
            session_start();
            //si on recoit une requete d'un usager connecté
            if(isset($_SESSION["usager"]) && isset($_REQUEST["idArticle"]) && is_numeric($_REQUEST["idArticle"]))
            {
                $idArticle = $_REQUEST["idArticle"];
                $nomUsager = $_SESSION["usager"];
                //vérifier que l'usager est bien l'auteur.ice de l'article
                $testUsager = verifier_auteur_article($idArticle, $nomUsager);
                //si oui, afficher la page de modification avec l'article à modifier
                if($testUsager)
                {
                    $donnees["titre"] = "Modification";
                    $donnees["article"] = obtenir_article($idArticle);
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/ModificationArticle.php");
                    require_once("vues/PiedDePage.php");
                }
                //si non, renvoyer à la page d'accueil
                else
                {
                    header("Location: index.php");
                    die();
                }       
            }
            break;

        case "ModifieArticle":
            //vérifier qu'on arrive du formulaire de modification 
            if(isset($_REQUEST["idArticle"]) && is_numeric($_REQUEST["idArticle"]) && isset($_REQUEST["titre"]) && isset($_REQUEST["texte"]))
            {
                $idArticle = $_REQUEST["idArticle"];
                //si les champs sont remplis
                if(!empty($_REQUEST["titre"]) && !empty($_REQUEST["texte"]))
                {   
                    $titre = $_REQUEST["titre"];
                    $texte = $_REQUEST["texte"];
                    //éditer l'article
                    $test = modifie_article($idArticle, $titre, $texte);
                    //si la modification de la DB réussie, retourner à la page d'accueil
                    if($test)
                    {
                        header("Location: index.php");
                        die();
                    }    
                    //message d'erreur si la modification échoue    
                    else 
                    {
                        $donnees["messageErreur"] = "Erreur lors de la modification.";
                        $donnees["titre"] = "Modification";
                        $donnees["article"] = obtenir_article($idArticle);
                        //afficher la ou les vues qu'on veut afficher
                        require_once("vues/Entete.php");
                        require_once("vues/ModificationArticle.php");
                        require_once("vues/PiedDePage.php");
                    }
                }
                //message erreur si un des champs est vide
                else
                {
                    $donnees["messageErreur"] = "Il faut entrer des valeurs dans tous les champs.";
                    $donnees["titre"] = "Modification";
                    $donnees["article"] = obtenir_article($idArticle);
                    //afficher la ou les vues qu'on veut afficher
                    require_once("vues/Entete.php");
                    require_once("vues/ModificationArticle.php");
                    require_once("vues/PiedDePage.php");
                }
            }
            break;

        /* Suppression article ==================== */
        case "SuppressionArticle":
            session_start();
            //si la demande vient bien d'un usager connecté, avec l'id de l'article à supprimer
            if(isset($_SESSION["usager"]) && isset($_REQUEST["idArticle"]) && is_numeric($_REQUEST["idArticle"]))
            {
                $idArticle = $_REQUEST["idArticle"];
                $nomUsager = $_SESSION["usager"];
                //vérifier que l'usager est bien l'auteur.ice de l'article,
                $testUsager = verifier_auteur_article($idArticle, $nomUsager);
                //si oui, supprimer l'article
                if($testUsager)
                {
                    $testSupprime = supprime_article($idArticle);
                    //si suppression réussie, affiche message réussite, sinon message d'erreur
                    if($testSupprime)
                    {
                        $donnees["message"] = "Suppression réussie !";
                        $donnees["titre"] = "Accueil";
                        $donnees["articles"] = obtenir_articles();
                        //afficher la ou les vues qu'on veut afficher
                        require_once("vues/Entete.php");
                        require_once("vues/Accueil.php");
                        require_once("vues/PiedDePage.php");
                    }
                    else 
                    {
                        $donnees["messageErreur"] = "Erreur lors de la suppression.";
                        $donnees["titre"] = "Accueil";
                        $donnees["articles"] = obtenir_articles();
                        //afficher la ou les vues qu'on veut afficher
                        require_once("vues/Entete.php");
                        require_once("vues/Accueil.php");
                        require_once("vues/PiedDePage.php");
                    }
                }
                //l'usager n'est pas l'auteur.ice, renvoyer à l'accueil
                else
                    header("Location: index.php");
                    die();
            }

        /* Par defaut ==================== */
        default:
            //action non traitée, commande invalide -- redirection
            header("Location: index.php");
            die();
    }

?>