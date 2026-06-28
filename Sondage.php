<?php

/**
 * Classe Sondage — Plateforme de vote en ligne
 * Branche : feature/export
 * Ajout   : exporterCSV() + exporterJSON()
 */
class Sondage
{
    private string $titre;
    private array  $options = [];
    private array  $votes   = [];
    private bool   $cloture = false;

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
        if ($total === 0) { echo "  Aucun vote enregistré.\n"; return; }
        foreach ($this->votes as $option => $nb) {
            $pct   = round(($nb / $total) * 100, 1);
            $barre = str_repeat('█', (int)($pct / 5));
            printf("  %-20s │ %-20s %5.1f%% (%d vote%s)\n",
                $option, $barre, $pct, $nb, $nb > 1 ? 's' : '');
        }
        echo "  Total : {$total} vote" . ($total > 1 ? 's' : '') . "\n\n";
    }

    public function cloturerSondage(): void
    {
        if ($this->cloture) { echo "Déjà clôturé.\n"; return; }
        $this->cloture = true;
        echo "Sondage \"{$this->titre}\" clôturé.\n";
    }

    public function estCloture(): bool { return $this->cloture; }

    /**
     * Exporte les résultats au format CSV.
     * branche feature/export
     *
     * @param string $fichier  Chemin du fichier de sortie (ex: "resultats.csv")
     * @return void
     */
    public function exporterCSV(string $fichier): void
    {
        $total  = array_sum($this->votes);
        $handle = fopen($fichier, 'w');

        if ($handle === false) {
            throw new RuntimeException("Impossible d'ouvrir le fichier : {$fichier}");
        }

        // En-tête
        fputcsv($handle, ['Option', 'Votes', 'Pourcentage']);

        foreach ($this->votes as $option => $nb) {
            $pct = $total > 0 ? round(($nb / $total) * 100, 2) : 0;
            fputcsv($handle, [$option, $nb, $pct . '%']);
        }

        // Ligne de total
        fputcsv($handle, ['TOTAL', $total, '100%']);
        fclose($handle);

        echo "Résultats exportés en CSV → {$fichier}\n";
    }

    /**
     * Exporte les résultats au format JSON.
     * branche feature/export
     *
     * @param string $fichier  Chemin du fichier de sortie (ex: "resultats.json")
     * @return void
     */
    public function exporterJSON(string $fichier): void
    {
        $total   = array_sum($this->votes);
        $données = [
            'titre'    => $this->titre,
            'cloture'  => $this->cloture,
            'total'    => $total,
            'resultats' => [],
        ];

        foreach ($this->votes as $option => $nb) {
            $données['resultats'][] = [
                'option'       => $option,
                'votes'        => $nb,
                'pourcentage'  => $total > 0 ? round(($nb / $total) * 100, 2) : 0,
            ];
        }

        $json = json_encode($données, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        if (file_put_contents($fichier, $json) === false) {
            throw new RuntimeException("Impossible d'écrire dans : {$fichier}");
        }

        echo "Résultats exportés en JSON → {$fichier}\n";
    }

    public function getOptions(): array { return $this->options; }
    public function getVotes(): array   { return $this->votes;   }
    public function getTitre(): string  { return $this->titre;   }
}
