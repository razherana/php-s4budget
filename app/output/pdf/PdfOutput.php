<?php

declare(strict_types=1);

namespace app\output\pdf;

use app\libs\FPDF;

class PdfOutput extends FPDF
{
  private $resultatParMois;
  private $departement;
  private $annee, $mois, $budgetInitial, $budgetFinal;

  public function __construct($departement, $resultatParMois, $annee, $mois, $budgetInitial, $budgetFinal)
  {
    parent::__construct();
    $this->departement = $departement;
    $this->resultatParMois = $resultatParMois;
    $this->annee = $annee;
    $this->mois = $mois;
    $this->budgetInitial = $budgetInitial;
    $this->budgetFinal = $budgetFinal;
  }

  function Header()
  {
    $this->SetFont('Arial', 'B', 14);
    $this->Cell(190, 10, "RAPPORT du departement {$this->departement} POUR L'ANNEE {$this->annee}", 0, 1, 'C');
    $this->Ln(5);
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, 'Fait a Antananarivo, le ' . date('d/m/Y'), 0, 0, 'C');
  }

  function TitleDetails()
  {
    $this->SetFont('Arial', 'B', 12);
    $this->Cell(0, 10, 'Budget Initial : ' . $this->budgetInitial);
    $this->Ln();
    $this->Cell(0, 10, 'Budget Final : ' . $this->budgetFinal);
    $this->Ln();
    $this->Ln();
  }

  function CreateTables()
  {
    foreach ($this->mois as $mois) {
      $this->CreateTable($mois);
    }
  }

  function CreateTable($mois)
  {
    $colWidths = [50, 40, 40, 40];

    $this->SetFont('Arial', 'B', 12);
    $this->Cell(array_sum($colWidths), 10, formatMois($mois) . ' ' . $this->annee, 1, 1, 'C');

    $this->SetFont('Arial', 'U', 10);
    $this->Cell($colWidths[0], 10, '', 1, 0, 'C'); // Cellule vide
    $this->Cell($colWidths[1], 10, 'Realisation', 1, 0, 'C');
    $this->Cell($colWidths[2], 10, 'Prevision', 1, 0, 'C');
    $this->Cell($colWidths[3], 10, 'Ecart', 1, 1, 'C');

    // Contenu du tableau
    $this->SetFont('Arial', '', 10);
    $data = [
      ['Depense', $this->resultatParMois[$mois]['totalRealisation1'], $this->resultatParMois[$mois]['totalPrevision1'], $this->resultatParMois[$mois]['totalEcart1']],
      ['Recette', $this->resultatParMois[$mois]['totalRealisation2'], $this->resultatParMois[$mois]['totalPrevision2'], $this->resultatParMois[$mois]['totalEcart2']],
      ['Total', $this->resultatParMois[$mois]['totalRealisation'], $this->resultatParMois[$mois]['totalPrevision'], $this->resultatParMois[$mois]['totalEcart']],
      ['Budget Initial', $this->resultatParMois[$mois]['budgetInitial'], '', ''],
      ['Budget Final', $this->resultatParMois[$mois]['budgetFinal'], '', '']
    ];

    foreach ($data as $row) {
      $this->Cell($colWidths[0], 10, $row[0], 1, 0, 'L');
      for ($i = 1; $i < 4; $i++) {
        $this->Cell($colWidths[$i], 10, $row[$i] !== '' ? $row[$i] : '', 1, 0, 'C');
      }
      $this->Ln();
    }
    $this->Ln();
  }
}
