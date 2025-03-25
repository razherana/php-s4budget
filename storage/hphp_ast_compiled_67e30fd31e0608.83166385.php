<?php extract(Piewpiew\view\View::$view_vars['tests.resultat-pdf']->get_data()); ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultat pour <?= $annee ?></title>
</head>

<body>
  <h1>Resultat pour <?= $annee ?></h1>

  <div>Budget Initial : <?= $budgetInitial ?></div>
  <div>Budget Initial : <?= $budgetFinal ?></div>

  <?php foreach($mois as $mois_): ?>
    <div style="margin-bottom: 1em;">
      <table border="1">
        <thead>
          <tr>
            <th></th>
            <th colspan="3"><?= $annee ?>/<?= $mois_ ?></th>
          </tr>
          <tr>
            <th></th>
            <th>Realisation</th>
            <th>Prevision</th>
            <th>Ecart</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><b>Depense</b></td>
            <td><?= $resultatParMois[$mois_]['totalRealisation1'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalPrevision1'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalEcart1'] ?></td>
          </tr>

          <tr>
            <td><b>Recette</b></td>
            <td><?= $resultatParMois[$mois_]['totalRealisation2'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalPrevision2'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalEcart2'] ?></td>
          </tr>

          <tr>
            <td><b>Total</b></td>
            <td><?= $resultatParMois[$mois_]['totalRealisation'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalPrevision'] ?></td>
            <td><?= $resultatParMois[$mois_]['totalEcart'] ?></td>
          </tr>

          <tr>
            <td><b>Budget Initial</b></td>
            <td colspan="3"><?= $resultatParMois[$mois_]['budgetInitial'] ?></td>
          </tr>

          <tr>
            <td><b>Budget Final</b></td>
            <td colspan="3"><?= $resultatParMois[$mois_]['budgetFinal'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
</body>

</html>