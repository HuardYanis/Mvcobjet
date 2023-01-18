<?php

namespace Yanis\MvcObjet\Models\Daos;

use Yanis\MvcObjet\Models\Entities\Directeur;

class DirecteurDao extends BaseDao
{
   
    public function findAll(){
        $stmt = $this->db->prepare("SELECT * FROM realisateur ");
        $res = $stmt->execute();
        if ($res) {
            $directeurs = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $directeurs[] = $this->createObjectFromFields($row);
            }
            return $directeurs;
        } else {
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

   
   
    public function createObjectFromFields($fields)
    {
       
        $acteur = new Directeur();

        $acteur->setId($fields['id'])
              ->setFirstName($fields['first_name']) 
              ->setLastName($fields['last_name']);         

        return $acteur;
    }

    public function findOne($id) {
        $stmt = $this->db->prepare("SELECT * FROM realisateur WHERE id =?");
        $stmt->execute([$id]);
        $a = $stmt->fetch();

        return $this->createObjectFromFields($a);

    }
    public function findByFilm($a) {
        $stmt = $this->db->prepare("SELECT realisateur.* FROM realisateur, film  WHERE realisateur.id= film.id_realisateur and film.id=?");
        $stmt->execute([$a]);
        $a = $stmt->fetch();
        return $a;
    }
}
