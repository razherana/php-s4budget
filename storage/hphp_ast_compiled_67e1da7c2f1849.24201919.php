<?php extract(Piewpiew\view\View::$view_vars['test']->get_data()); ?><?php $___vars___->add_template('t_prevision', '
  <tr>
    <td>
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Designation</th>
            <th>Prevision</th>
            <th>Realisation</th>
            <th>Ecart</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions1 as $prevision): ?>
            <tr>
              <td><?= $prevision->designation ?> Ar</td>
              <td><?= $prevision->prevision ?> Ar</td>
              <td><?= $prevision->realisation ?> Ar</td>
              <td><?= $prevision->prevision - $prevision->realisation ?> Ar</td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td><b>Totals : </b></td>
            <td><b><?= $totalPrevision1 ?> Ar</b></td>
            <td><b><?= $totalRealisation1 ?> Ar</b></td>
            <td><b><?= $totalPrevision1 - $totalRealisation1 ?> Ar</b></td>
          </tr>
        </tbody>
      </table>
    </td>
    <td>
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Designation</th>
            <th>Prevision</th>
            <th>Realisation</th>
            <th>Ecart</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions2 as $prevision): ?>
            <tr>
              <td><?= $prevision->designation ?> Ar</td>
              <td><?= $prevision->prevision ?> Ar</td>
              <td><?= $prevision->realisation ?> Ar</td>
              <td><?= $prevision->prevision - $prevision->realisation ?> Ar</td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td><b>Totals : </b></td>
            <td><b><?= $totalPrevision2 ?> Ar</b></td>
            <td><b><?= $totalRealisation2 ?> Ar</b></td>
            <td><b><?= $totalPrevision2 - $totalRealisation2 ?> Ar</b></td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>
', ) ?>

<?php $___vars___->add_template('t_type', '
  <tr class="spacer">
    <td style="height: 1em;"></td>
  </tr>

  <!-- Types -->
  <tr class="categorie">
    <td data-open-id="a<?= $id ?>"><i class="far fa-arrow-alt-circle-down arrow"></i> Type : <?= $designation ?></td>
  </tr>

  <tr class="categorie-data">
    <td data-opened-id="a<?= $id ?>">
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Depense</th>
            <th>Recette</th>
          </tr>
        </thead>

        <tbody>
          <tr class="spacer">
            <td style="height: 1em;"></td>
          </tr>
          <tr class="addnew" data-addPrevision data-type-id="<?= $id ?>" onkeypress="this.click()" tabindex="1">
            <td colspan="2">Nouvelle Prevision/Realisation<i class="fa fa-plus ms-1"></i></td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>
', ) ?>

<?php $___vars___->add_template('t_categorie', '
  <tr class="spacer">
    <td style="height: 1em;"></td>
  </tr>
  <tr class="categorie">
    <td colspan="5" data-open-id="<?= $id ?>"><i class="far fa-arrow-alt-circle-down arrow"></i> Categorie : <?= $designation ?></td>
  </tr>
  <tr class="categorie-data">
    <td colspan="5" data-opened-id="<?= $id ?>">
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Types</th>
          </tr>
        </thead>
        <tbody>
          <!-- Add types here -->

          <?php foreach($types as $type): ?>
            <?php $___vars___->use_template(\'t_type\', $type); ?>
          <?php endforeach; ?>

          <!-- Button -->
          <tr class="spacer">
            <td style="height: 1em;"></td>
          </tr>
          <tr class="addnew" data-addType data-category-id="<?= $id ?>" onkeypress="this.click()" tabindex="1">
            <td>Nouveau Type<i class="fa fa-plus ms-1"></i></td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>

', ) ?>