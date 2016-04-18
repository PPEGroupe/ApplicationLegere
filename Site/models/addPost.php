<?php
require 'ClassesLoader.php';
require 'generateRandomString.php';

if (!empty($_POST))
{
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['phoneNumber']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['zipCode']))
    {
        $error[] = 'Veuillez renseigner tous les champs obligatoires.';
    }
    else
    {
        $firstname   = trim($_POST['firstname']);
        $lastname    = trim($_POST['lastname']);
        $email       = trim($_POST['email']);
        $phoneNumber = trim($_POST['phoneNumber']);
        $address     = trim($_POST['address']);
        $city        = trim($_POST['city']);
        $zipCode     = trim($_POST['zipCode']);

        $regexEmail 	  = '#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i';
        $regexPhoneNumber = '/^(0|\+33)[-. ]?[1-9]([-. ]?[0-9]{2}){4}$/';

        if (preg_match($regexEmail, $email) == 0 || strlen($email) < 8)
        {
            $error[] = 'L\'email est invalide.';
        }

        if (preg_match($regexPhoneNumber, $phoneNumber) == 0)
        {
            $error[] = 'Le numéro de téléphone est invalide.';
        }

        // Si les tests précédant sont valides.
        if (!isset($error))
        {
            if (empty($_FILES['cv']['name']))
            {
                $error[] = 'Veuillez sélectionner votre CV.';
            }
            else
            {
                $extensions = array('.pdf', '.PDF');
                $folder = '../documents/';
                // Si le répertoire qui doit contenir les fichiers uploadés n'existe pas, il est créé.
                if (!file_exists($folder))
                {
                    mkdir($folder);
                }

                // Récupère l'extension des fichiers à uploader.
                $cvExtension     = strrchr($_FILES['cv']['name'], '.');
                $letterExtension = strrchr($_FILES['letter']['name'], '.');

                // La fonction GetString génère une chaine de caractères aléatoire.
                $cvFile     = GetString(). $cvExtension;
                $letterFile = null;
                
                if ($letterExtension != '')
                {
                    $letterFile = GetString(). $letterExtension;
                }
                
                if(!in_array($cvExtension, $extensions))
                {
                    $error[] = 'Le format du CV n\'est pas correct.
                                Veuillez sélectionner un fichier PDF.';
                    
                    if(!empty($_FILES['letter']['name']) && !in_array($letterExtension, $extensions))
                    {
                        $error[] = 'Le format de la lettre de motivation n\'est pas correct.
                                    Veuillez sélectionner un fichier PDF.';
                    }
                }
                else if(!empty($_FILES['letter']['name']) && !in_array($letterExtension, $extensions))
                {
                    $error[] = 'Le format de la lettre de motivation n\'est pas correct.
                                Veuillez sélectionner un fichier PDF.';
                }
                else
                {
                    // Si le fichier est déplacé du répertoire temporaire dans le répertoire qui contient les fichiers uploadés.
                    if (!move_uploaded_file($_FILES['cv']['tmp_name'], $folder . $cvFile))
                    {
                        $error[] = 'Echec de l\'upload du CV.';
                    }

                    // Idem pour la lettre de motivation si un fichier à été sélectionné.
                    if (!empty($_FILES['letter']['name']) && !move_uploaded_file($_FILES['letter']['tmp_name'], $folder . $letterFile)) 
                    {
                        $error[] = 'Echec de l\'upload de la lettre de motivation.';
                    }
                }
            }
        }
    }

    // Si les tests précédant sont valides.
    if (!isset($error))
    {
        if (isset($_SESSION['webUser']))
        {
            $webUser = $_SESSION['webUser'];
        }
        else
        {
            $webUser = new WebUser();
            $webUser->Initialize($_POST);
        }
        
        $postManager = new PostManager($db);
        
        // Crée et remplie la candidature pour l'ajouter en BDD
        $post = new Post();
        $post->setCV($cvFile);
        $post->setDatePost(date('Y-m-d'));
        $post->setLetter($letterFile);
        $post->setIdWebUser($webUser->Identifier());
        $post->setIdOffer($_POST['idOffer']);
        
        $postManager->Add($post);

        echo json_encode('success');
    }
    else
    {
        echo json_encode($error);
    }
}