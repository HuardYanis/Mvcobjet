<?php
namespace Yanis\MvcObjet\Controllers;
use Yanis\MvcObjet\Models\Services\FilmService;

class FilmController {

        private $filmService;
        private $twig;
        


    
        public function __construct($twig)  { 
            $this->twig = $twig;
            $this->filmService = new FilmService();
        }
    
        public function listeFilms() {
    
            $liste = $this->filmService->listeFilms();
            echo $this->twig->render('films.html.twig', ["films" => $liste]); 
            
    
        }
        public function getOneFilm($a) {
            $film = $this->filmService->getOneFilm($a);

            echo $this->twig->render('onefilm.html.twig', ["film" => $film]); 
            
        }

        public function addFilm() {
            $info = $this->filmService->addFilm();
            $acteur = $info[0];
            $directeur= $info[1];
            $genre= $info[2];
            echo $this->twig->render('addfilm.html.twig', ["acteur" => $acteur, "directeur" => $directeur, "genre" => $genre]);
        }

        public function recordFilm($req, $file) {
             $this->filmService->recordFilm($req, $file);
           
        }
    
    
    
}



?>