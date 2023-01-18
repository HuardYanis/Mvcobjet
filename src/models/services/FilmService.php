<?php

namespace Yanis\MvcObjet\Models\Services;

use Yanis\MvcObjet\Models\Daos\FilmDao;
use Yanis\MvcObjet\Models\Daos\GenreDao;
use Yanis\MvcObjet\Models\Daos\ActorDao;
use Yanis\MvcObjet\Models\Daos\DirecteurDao;

class FilmService {

    private $filmDao;
    private $genreDao;
    private $actorDao;
    private $directeurDao;

    public function __construct() {
            $this->filmDao = new FilmDao();
            $this->genreDao = new GenreDao();
            $this->actorDao = new ActorDao();
            $this->directeurDao = new DirecteurDao();
    }

        

    public function listeFilms() {
        $liste = $this->filmDao->findAll();
        return $liste;
    
    }   
    
    public function getOneFilm($a) {
        $film = $this->filmDao->findOne($a);
        $actors = $this->actorDao->findByFilm($a);
      
        foreach ( $actors as $actor ) {
            $film->addActor($actor);
        }

        $genre = $this->genreDao->findByFilm($a);
        $film->setGenre($genre);

        $directeur = $this->directeurDao->findByFilm($a);
        $film->setDirecteur($directeur);


        return $film;

        
    }

    public function addFilm() {
        $acteurs = $this->actorDao->findAll();
        $directeurs = $this->directeurDao->findAll();
        $genre = $this->genreDao->findAll();

        $tab =[$acteurs, $directeurs, $genre];
        return $tab;


    }

    public function recordFilm($req, $file) {
        // echo "<pre>";
        $tab_acteur = $req['acteurs'];
        // print_r($file[0]);
        $film= $this->filmDao->createObjectFromFields($req);
        $film->setGenre($req['genre']);
        $film->setDirecteur($req['directeur']);
        $film->setDuration($req['duree']);
        $film->setCoverImage($file['file']['name']);
        $film->setDate($req['date']);
        $film->setTitle($req['title']);
        $film->setDescription($req['description']);





        

        // $film->addActor($req['actor']);

        $this->filmDao->create($film,$tab_acteur);

        
    }


} // fabrication de l'objet movie. 
    //     $movie = $this->movieDao->findById($id);  // recherche dans movieDao ( $id = id du movie )
    //     $actors = $this->actorDao->findByMovie($id); // recherche des acteurs pour 1 film 
    //     foreach ($actors as $actor) {
    //         // fonction dans la classe Movie sans Entities
    //         $movie->addActor($actor);  // fonction ajoute 1 acteur à l'objet movie (voire classe/entité Movie)
    //     }

    //     $genre = $this->genreDao->findByMovie($id); // recherche du genre . creatin de l'objet genre
    //     $movie->setGenre($genre);
    //     $director = $this->directorDao->findByMovie($id);
    //     $movie->setDirector($director);

    //    /* $comments = $this->commentDao->findByMovie($id);*/
    //     return $movie;

?>
