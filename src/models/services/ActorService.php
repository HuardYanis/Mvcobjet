<?php

namespace Yanis\MvcObjet\Models\Services;

use Yanis\MvcObjet\Models\Daos\ActorDao;
use Yanis\MvcObjet\Models\Daos\FilmDao;

class ActorService {

    private $actorDao;
    private $filmDao;

    public function __construct() {
            $this->actorDao = new ActorDao();
            $this->filmDao = new FilmDao();
    

        }

    public function listeActeurs() {
        $liste = $this->actorDao->findAll();
        return $liste;
    
    }   
    
    public function getOneActor($a) {
        $acteur = $this->actorDao->findOne($a);
        $films =  $this->filmDao->findByActor($a);

        foreach ( $films as $film ) {
            $acteur->addFilm($film);
        }

        return $acteur;
    }

    public function recordActor($req) {
        $acteur = $this->actorDao->createObjectFromFields($req);
        $this->actorDao->addActor($acteur);
    }



}



?>