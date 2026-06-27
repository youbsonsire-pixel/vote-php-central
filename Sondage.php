<?php

/**
 * Classe Sondage — Plateforme de vote en ligne
 * Rôle   : Initialisation du projet (structure de base)
 */
class Sondage
{
    private string $titre;
    private array  $options = [];
    private array  $votes   = [];

    public function __construct(string $titre)
    {
        $this->titre = $titre;
    }

    /**
     * Ajoute une option au sondage.
     */
    public function ajouterOption(string $option): void
    {
        if (!in_array($option, $this->options, true)) {
            $this->options[]        = $option;
            $this->votes[$option]   = 0;
        }
    }

    /**
     * Enregistre un vote pour une option existante.
     */
    public function voter(string $option): bool
    {
        if (!array_key_exists($option, $this->votes)) {
            return false;
        }
        $this->votes[$option]++;
        return true;
    }

    public function getOptions(): array  { return $this->options; }
    public function getVotes(): array    { return $this->votes;   }
    public function getTitre(): string   { return $this->titre;   }
}
