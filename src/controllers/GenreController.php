<?php
namespace Yanis\MvcObjet\Controllers;
use Yanis\MvcObjet\Models\Services\GenreService;

class GenreController {

        private $genreService;
        private $twig;


    
        public function __construct($twig)  { 
            $this->twig = $twig;
            $this->genreService = new GenreService();
        }
    
        public function listeGenres() {
    
            $liste = $this->genreService->listeGenres();
            echo $this->twig->render('genres.html.twig', ["genres" => $liste]); 
            
    
        }
        public function getOneGenre($a) {
            $genre = $this->genreService->getOneGenre($a);
            echo $this->twig->render('onegenre.html.twig', ["genre" => $genre]); 
            
        }
    
    
    
}



?>