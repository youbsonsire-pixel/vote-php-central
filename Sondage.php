<?php

/**
 * Classe Sondage — Plateforme de vote en ligne
 * Auteur  : Contributeur A
 * Branche : feature/resultats
 * Ajout   : afficherResultats()
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

    public function ajouterOption(string $option): void
    {
        if (!in_array($option, $this->options, true)) {
            $this->options[]      = $option;
            $this->votes[$option] = 0;
        }
    }

    public function voter(string $option): bool
    {
        if (!array_key_exists($option, $this->votes)) {
            return false;
        }
        $this->votes[$option]++;
        return true;
    }

    /**
     * Affiche les résultats du sondage avec pourcentages et barres visuelles.
     * Contribution du Contributeur A — branche feature/resultats
     */
    public function afficherResultats(): void
    {
        $total = array_sum($this->votes);

        echo "\n=== Résultats : {$this->titre} ===\n";

        if ($total === 0) {
            echo "  Aucun vote enregistré.\n";
            return;
        }

        foreach ($this->votes as $option => $nb) {
            $pct   = round(($nb / $total) * 100, 1);
            $barre = str_repeat('█', (int)($pct / 5));
            printf("  %-20s │ %-20s %5.1f%% (%d vote%s)\n",
                $option, $barre, $pct, $nb, $nb > 1 ? 's' : '');
        }

        echo "  Total : {$total} vote" . ($total > 1 ? 's' : '') . "\n\n";
    }

    public function getOptions(): array { return $this->options; }
    public function getVotes(): array   { return $this->votes;   }
    public function getTitre(): string  { return $this->titre;   }
}
