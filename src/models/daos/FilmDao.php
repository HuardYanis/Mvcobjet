<?php

namespace Yanis\MvcObjet\Models\Daos;

use Yanis\MvcObjet\Models\Entities\Film;
use Yanis\MvcObjet\Models\Daos\ActorDao;


class FilmDao extends BaseDao
{
   
    public function findAll(){
        $stmt = $this->db->prepare("SELECT * FROM film ");
        $res = $stmt->execute();
        if ($res) {
            $films = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $films[] = $this->createObjectFromFields($row);
            }
            return $films;
        } else {
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

   
   
    public function createObjectFromFields($fields)
    {
       
        $film = new Film();

        $film->setId($fields['id'])
              ->setTitle($fields['title']) 
              ->setDescription($fields['description'])
              ->setDuration($fields['duration'])
              ->setDate($fields['date'])
              ->setCoverImage($fields['coverImage']);


         

        return $film;
    }

    public function findOne($id) {
        $stmt = $this->db->prepare("SELECT * FROM film WHERE id =?");
        $stmt->execute([$id]);
        $a = $stmt->fetch();
        return $this->createObjectFromFields($a);

    }

    public function findByActor($id){
        $stmt = $this->db->prepare("SELECT film.* FROM film , actor , relation WHERE film.id= relation.id AND relation.id_actor= actor.id AND actor.id = ?");
        $stmt->execute([$id]);
        $a = $stmt->fetchAll();
        $tab=[];
        foreach ($a as $b) {
            $tab[] = $this->createObjectFromFields($b);
        }
       
        return $tab;

    }

    public function create(Film $film, $tab) {

        try{
            $this->db->beginTransaction();//transaction

            $stmt = $this->db->prepare("INSERT INTO film ( title, description, duration, date ,coverImage,id_realisateur,id_genre) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([$film->getTitle(), $film->getDescription(), $film->getDuration(), $film->getDate(), "../img/".$film->getCoverImage(), $film->getDirecteur(), $film->getGenre()]);
            $id= $this->db->lastInsertId();
            for ($i=0; $i< count($tab); $i++) {
              
            
            $stmt2 = $this->db->prepare("INSERT INTO relation (id , id_actor) VALUES(?,?)");
            $stmt2->execute([$id,$tab[$i]]);
            $this->db->commit();
            }
        }   catch(Exception $e){
            $this->db->rollBack();
            die($e->getMessage());
        }

        




        
    
    }




}
