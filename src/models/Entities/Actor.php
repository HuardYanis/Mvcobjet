<?php

namespace Yanis\MvcObjet\Models\Entities;

class Actor
{
    private $id;
    private $firstName;
    private $lastName;
    private $films;
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function setId(int $id=NULL)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function addFilm(Film $film): void
    {
         if (is_array($this->films)){
             foreach ($this->films as $a) {
       
                
                
                 if ($a->getId() == $film->getId()) {
                     return;
                 }
             } 
         }

        
        $this->films[] = $film;
    }

public function getFilm()
    {
        return $this->films;
    }

}
