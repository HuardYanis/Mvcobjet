<?php

namespace Yanis\MvcObjet\Models\Daos;

use Yanis\MvcObjet\Models\Entities\Genre;

class GenreDao extends BaseDao
{
   
    public function findAll(){
        $stmt = $this->db->prepare("SELECT * FROM genre ");
        $res = $stmt->execute();
        if ($res) {
            $genres = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $genres[] = $this->createObjectFromFields($row);
            }
            return $genres;
        } else {
            throw new \PDOException($stmt->errorInfo()[2]);
        }
    }

   
   
    public function createObjectFromFields($fields)
    {
       
        $genre = new Genre();

        $genre->setId($fields['id'])
              ->setName($fields['name']);         

        return $genre;
    }

    public function findOne($id) {
        $stmt = $this->db->prepare("SELECT * FROM genre WHERE id =?");
        $stmt->execute([$id]);
        $a = $stmt->fetch();
        $genre = new Genre();
        $genre->setId($a['id'])->setName($a['name']);
        return $genre;
    }
    public function findByFilm($id) {
        $stmt = $this->db->prepare("SELECT genre.* FROM genre, film  WHERE genre.id = film.id_genre AND film.id =?");
        $stmt->execute([$id]);
        $a = $stmt->fetch();
        return $a;

    }
}
