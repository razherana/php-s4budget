<?php

declare(strict_types=1);

namespace app\controllers;

use flight\Engine;

class PdfController
{
    /** @var Engine */
    protected Engine $app;

    /**
     * Constructor
     */
    public function __construct(Engine $app)
    {
        $this->app = $app;
    }
// require('fpdf.php');

class PDF extends FPDF
{
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, 'GESTION FINANCIERE BY HERANA , FENO ET DIARY', 0, 1, 'C');
        $this->Ln(5);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Fait a Antananarivo, le ' . date('d/m/Y'), 0, 0, 'C');
    }

    function CreateTable()
    {
        
        $colWidths = [50, 40, 40, 40];

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(array_sum($colWidths), 10, 'Janvier 2025', 1, 1, 'C');

        $this->SetFont('Arial', 'U', 10); 
        $this->Cell($colWidths[0], 10, '', 1, 0, 'C'); // Cellule vide
        $this->Cell($colWidths[1], 10, 'Realisation', 1, 0, 'C');
        $this->Cell($colWidths[2], 10, 'Prevision', 1, 0, 'C');
        $this->Cell($colWidths[3], 10, 'Ecart', 1, 1, 'C');

        // Contenu du tableau
        $this->SetFont('Arial', '', 10);
        $data = [
            ['Depense', 1230, 1231, 12],
            ['Recette', 123, 21321, 1231],
            ['Total', 12213, 12312, 12332],
            ['Budget Initial', 12312123, '', ''],
            ['Budget Final', 111231231, '', '']
        ];

        foreach ($data as $row) {
            $this->Cell($colWidths[0], 10, $row[0], 1, 0, 'L');
            for ($i = 1; $i < 4; $i++) {
                $this->Cell($colWidths[$i], 10, $row[$i] !== '' ? $row[$i] : '', 1, 0, 'C');
            }
            $this->Ln();
        }
    }

}
// Instanciation du PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->CreateTable();
$pdf->Output('D', 'rapport.pdf'); // Téléchargement

}
