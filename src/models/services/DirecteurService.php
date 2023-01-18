<?php

namespace Yanis\MvcObjet\Models\Services;

use Yanis\MvcObjet\Models\Daos\DirecteurDao;

class DirecteurService {

    private $directeurDao;

    public function __construct() {
            $this->directeurDao = new DirecteurDao();

        }

    public function listeDirecteurs() {
        $liste = $this->directeurDao->findAll();
        return $liste;
    
    }   
    
    public function getOneDirecteur($a) {
        $directeur = $this->directeurDao->findOne($a);
        return $directeur;
    }
}



?>