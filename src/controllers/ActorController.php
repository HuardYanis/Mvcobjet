<?php

namespace Yanis\MvcObjet\Controllers;

use Yanis\MvcObjet\Models\Services\ActorService;

class ActorController

{
    private $actorService;
    private $twig;

    public function __construct($twig)  { 
        $this->twig = $twig;
        $this->actorService = new ActorService();
    }

    public function listeActeurs() {

        // $liste = $this->actorService->listeActeurs();
        
      
        // require_once __DIR__. '/../views/viewlisteActeurs.php';
        $lesacteurs = $this->actorService->listeActeurs();
        // return $liste;
        echo $this->twig->render('actors.html.twig', ["acteurs" => $lesacteurs]); 
       

    }
    public function getOneActor($a) {
        $acteur = $this->actorService->getOneActor($a);

        echo $this->twig->render('oneactor.html.twig', ["acteur" => $acteur]);

    
        
    }

    public function addActor() {
        echo $this->twig->render('addactor.html.twig');
    }

    public function recordActor($req) {
        $this->actorService->recordActor($req);
        
    }


}

?>