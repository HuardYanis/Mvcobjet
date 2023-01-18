<?php

namespace Yanis\MvcObjet\Controllers;

use Yanis\MvcObjet\Models\Services\DirecteurService;

class DirecteurController

{
    private $directeurService;
    private $twig;

    public function __construct($twig)  { 
        $this->twig = $twig;
        $this->directeurService = new DirecteurService();
    }

    public function listeDirecteurs() {

        // $liste = $this->actorService->listeActeurs();
        
      
        // require_once __DIR__. '/../views/viewlisteActeurs.php';
        $lesdirecteur = $this->directeurService->listeDirecteurs();
        // return $liste;
        echo $this->twig->render('directeurs.html.twig', ["directeurs" => $lesdirecteur]); 
       

    }
    public function getOneDirecteur($a) {
        $directeur = $this->directeurService->getOneDirecteur($a);

        echo $this->twig->render('onedirecteur.html.twig', ["directeur" => $directeur]);

    
        
    }


}

?>