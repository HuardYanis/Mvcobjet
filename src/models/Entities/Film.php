<?php

namespace Yanis\MvcObjet\Models\Entities;

class Film
{
    private $id;
    private $title;
    private $description;
    private $duration;
    private $date;
    private $coverImage;
    private $genre;
    private $directeur;
    private $acteurs;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setId(int $id = NUll)
    {
        $this->id = $id;
        return $this;
    }
    public function setTitle($title) 
    {
         $this->title = $title;
          return $this; 
    }

    public function getTitle()
        {
            return $this->title;
        }
    
    public function setDescription($description)
        {
            $this->description = $description;
            return $this;
        }
    
    public function getDescription()
        {
            return $this->description;
        }
    public function setDuration($duration)
        {
            $this->duration = $duration;
            return $this;
        }
    
    public function getDuration()
        {
            return $this->duration;
        }
    
    public function setDate($date)
        {
            $this->date = $date;
            return $this;
        }

    public function getDate()
        {
            return $this->date;
        }
    
    public function setCoverImage($coverImage)
        {
            $this->coverImage = $coverImage;
            return $this;
        }
    public function getCoverImage()
        {
            return $this->coverImage;
        }
    public function setGenre($genre)
        {
            $this->genre = $genre;
            return $this;
        }
    public function getGenre()
        {
            return $this->genre;
        }
    public function setDirecteur($directeur)
        {
            $this->directeur = $directeur;
            return $this;
        }
    public function getDirecteur()
        {
            return $this->directeur;
        }

    public function addActor(Actor $actor): void
        {
             if (is_array($this->acteurs)){
                 foreach ($this->acteurs as $a) {
           
                    
                    
                     if ($a->getId() == $actor->getId()) {
                         return;
                     }
                 } 
             }
    
            
            $this->acteurs[] = $actor;
        }

    public function getActor()
        {
            return $this->acteurs;
        }
    

    
    


    


}
