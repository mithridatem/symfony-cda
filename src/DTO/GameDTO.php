<?php

namespace App\DTO;


readonly class GameDTO
{
    public function __construct(

        public string $titre,
        public string $categorie,
        public string $console
    )
    {
       $this->titre = $titre;
       $this->categorie = $categorie;
       $this->console = $console;
    }
}
