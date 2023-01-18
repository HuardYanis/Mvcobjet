<?php

namespace Yanis\MvcObjet\Models\Daos;

use Yanis\MvcObjet\Models\Entities\Actor;

class ActorDao extends BaseDao
{
   
    public function findAll(){
        $stmt = $this->db->prepare("SELECT * FROM actor ");
        $res = $stmt->execute();
        if ($res) {
            $actors = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $actors[] = $this->createObjectFromFields($row);
            }
            return $actors;
        } else {
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

   
   
    public function createObjectFromFields($fields)
    {
       
        $acteur = new Actor();

        $acteur->setId($fields['id']) 
              ->setFirstName($fields['first_name']) 
              ->setLastName($fields['last_name']);         

        return $acteur;
    }

    public function findOne($id) {
        $stmt = $this->db->prepare("SELECT * FROM actor WHERE id =?");
        $stmt->execute([$id]);
        $a = $stmt->fetch();
        
        return $this->createObjectFromFields($a);
    }



    public function addActor(Actor $acteur) {
        $stmt = $this->db->prepare("INSERT INTO actor ( first_name, last_name) VALUES (?,?)");
        $stmt->execute([$acteur->getFirstName(), $acteur->getLastName()]);

    }

    public function findByFilm($id) {
        $stmt = $this->db->prepare("SELECT actor.* FROM actor, film, relation WHERE actor.id = relation.id_actor AND relation.id = film.id AND film.id = ? ");
        $stmt->execute([$id]);
        $a = $stmt->fetchAll();
        $tab=[];
        foreach ($a as $b) {
            $tab[] = $this->createObjectFromFields($b);
        }
       
        return $tab;

    }

}
