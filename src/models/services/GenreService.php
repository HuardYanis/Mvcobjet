<?php

namespace Yanis\MvcObjet\Models\Services;

use Yanis\MvcObjet\Models\Daos\GenreDao;

class GenreService {

    private $genreDao;

    public function __construct() {
            $this->genreDao = new GenreDao();

        }

    public function listeGenres() {
        $liste = $this->genreDao->findAll();
        return $liste;
    }   
    
    public function getOneGenre($a) {
        $genre = $this->genreDao->findOne($a);
        return $genre;
    }
}



?>