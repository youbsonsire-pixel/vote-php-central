<?php

/**
 * Classe Sondage — Plateforme de vote en ligne
 * Auteur  : Contributeur B
 * Branche : feature/cloture
 * Ajout   : cloturerSondage() + estCloture()
 */
class Sondage
{
    private string $titre;
    private array  $options   = [];
    private array  $votes     = [];
    private bool   $cloture   = false;   // ← ajout Contributeur B

    public function __construct(string $titre)
    {
        $this->titre = $titre;
    }

    public function ajouterOption(string $option): void
    {
        if ($this->cloture) {
            throw new RuntimeException("Sondage clôturé : impossible d'ajouter une option.");
        }
        if (!in_array($option, $this->options, true)) {
            $this->options[]      = $option;
            $this->votes[$option] = 0;
        }
    }

    public function voter(string $option): bool
    {
        if ($this->cloture) {
            throw new RuntimeException("Sondage clôturé : les votes ne sont plus acceptés.");
        }
        if (!array_key_exists($option, $this->votes)) {
            return false;
        }
        $this->votes[$option]++;
        return true;
    }

    public function afficherResultats(): void
    {
        $total = array_sum($this->votes);

        echo "\n=== Résultats : {$this->titre} ===\n";
        if ($this->cloture) {
            echo "  [SONDAGE CLÔTURÉ — résultats définitifs]\n";
        }

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

    /**
     * Clôture définitivement le sondage.
     * Contribution du Contributeur B — branche feature/cloture
     */
    public function cloturerSondage(): void
    {
        if ($this->cloture) {
            echo "Le sondage \"{$this->titre}\" est déjà clôturé.\n";
            return;
        }
        $this->cloture = true;
        echo "Sondage \"{$this->titre}\" clôturé avec succès. Aucun vote supplémentaire ne sera accepté.\n";
    }

    /**
     * Indique si le sondage est clôturé.
     * Contribution du Contributeur B — branche feature/cloture
     */
    public function estCloture(): bool
    {
        return $this->cloture;
    }

    public function getOptions(): array { return $this->options; }
    public function getVotes(): array   { return $this->votes;   }
    public function getTitre(): string  { return $this->titre;   }
}
