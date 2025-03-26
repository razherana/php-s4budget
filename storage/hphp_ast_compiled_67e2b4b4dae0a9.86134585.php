<?php extract(Piewpiew\view\View::$view_vars['pages/departement/components/_periode']->get_data()); ?><?php $___vars___->add_template('t_prevision', '
  <tr>
    <td>
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Designation</th>
            <th>Prevision</th>
            <th>Realisation</th>
            <th>Ecart</th>
            <th>Date</th>
            <th>Etat</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions1[$mois] as $p): ?>
            <tr class="spacer">
              <td style="height: .75em;"></td>
            </tr>

            <?php if(empty($p)): ?>
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>

              <?php continue ; ?>
            <?php endif; ?>

            <tr style="font-size: 13px;" class="<?= $p[\'realisation\'] <= $p[\'prevision\'] ? \'plusplus\' : \'moinsmoins\' ?>">
              <td><?= $p[\'designation\'] ?></td>
              <td><?= format($p[\'prevision\']) ?> Ar</td>
              <td><?= format($p[\'realisation\']) ?> Ar</td>
              <td><?= format($p[\'realisation\'] - $p[\'prevision\']) ?> Ar</td>
              <td><?= $p[\'date\'] ?></td>
              <td>
                <?php if(auth()->get()->is_super_admin): ?>
                  <a href="<?= route("previsions/{$p[\'id\']}/lock") ?><?= add_annee() ?>" class="btn btn-outline-dark">
                    <?php if($p[\'locked\']): ?>
                      <i class="fas fa-lock"></i>
                    <?php else: ?>
                      <i class="fas fa-lock-open"></i>
                    <?php endif; ?>
                  </a>
                <?php else: ?>
                  <a href="#" class="btn btn-dark">
                    <?php if($p[\'locked\']): ?>
                      <i class="fas fa-lock"></i>
                    <?php else: ?>
                      <i class="fas fa-lock-open"></i>
                    <?php endif; ?>
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr class="spacer">
            <td style="height: .75em;"></td>
          </tr>
          <tr style="font-size: 13px;" class="<?= $totalRealisation1[$mois] <= $totalPrevision1[$mois] ? \'plusplus\' : \'moinsmoins\' ?>">
            <td><b>Totals : </b></td>
            <td><b><?= format($totalPrevision1[$mois]) ?> Ar</b></td>
            <td><b><?= format($totalRealisation1[$mois]) ?> Ar</b></td>
            <td><b><?= format($totalRealisation1[$mois] - $totalPrevision1[$mois]) ?> Ar</b></td>
            <td>-</td>
            <td>-</td>
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
            <th>Date</th>
            <th>Etat</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions2[$mois] as $p): ?>
            <tr class="spacer">
              <td style="height: .75em;"></td>
            </tr>

            <?php if(empty($p)): ?>
              <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>

              <?php continue ; ?>
            <?php endif; ?>

            <tr style="font-size: 13px;" class="<?= $p[\'realisation\'] >= $p[\'prevision\'] ? \'plusplus\' : \'moinsmoins\' ?>">
              <td><?= $p[\'designation\'] ?></td>
              <td><?= format($p[\'prevision\']) ?> Ar</td>
              <td><?= format($p[\'realisation\']) ?> Ar</td>
              <td><?= format($p[\'prevision\'] - $p[\'realisation\']) ?> Ar</td>
              <td><?= $p[\'date\'] ?></td>
              <td>
                <?php if(auth()->get()->is_super_admin): ?>
                  <a href="<?= route("previsions/{$p[\'id\']}/lock") ?><?= add_annee() ?>" class="btn btn-outline-dark">
                    <?php if($p[\'locked\']): ?>
                      <i class="fas fa-lock"></i>
                    <?php else: ?>
                      <i class="fas fa-lock-open"></i>
                    <?php endif; ?>
                  </a>
                <?php else: ?>
                  <a href="#" class="btn btn-dark">
                    <?php if($p[\'locked\']): ?>
                      <i class="fas fa-lock"></i>
                    <?php else: ?>
                      <i class="fas fa-lock-open"></i>
                    <?php endif; ?>
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>

          <tr class="spacer">
            <td style="height: .75em;"></td>
          </tr>
          <tr style="font-size: 13px;" class="<?= $totalRealisation2[$mois] >= $totalPrevision2[$mois] ? \'plusplus\' : \'moinsmoins\' ?>">
            <td><b>Totals : </b></td>
            <td><b><?= format($totalPrevision2[$mois]) ?> Ar</b></td>
            <td><b><?= format($totalRealisation2[$mois]) ?> Ar</b></td>
            <td><b><?= format($totalPrevision2[$mois] - $totalRealisation2[$mois]) ?> Ar</b></td>
            <td>-</td>
            <td>-</td>
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
    <td data-open-id="a<?= $mois ?><?= $id ?>"><i class="far fa-arrow-alt-circle-down arrow"></i> Type : <?= $designation ?></td>
  </tr>

  <tr class="categorie-data">
    <td data-opened-id="a<?= $mois ?><?= $id ?>">
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Depense</th>
            <th>Recette</th>
          </tr>
        </thead>

        <tbody>

          <?php $___vars___->use_template(\'t_prevision\', $previsions + compact(\'mois\')); ?>

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
    <td colspan="5" data-open-id="<?= $mois ?>-<?= $id ?>"><i class="far fa-arrow-alt-circle-down arrow"></i> Categorie : <?= $designation ?></td>
  </tr>
  <tr class="categorie-data">
    <td colspan="5" data-opened-id="<?= $mois ?>-<?= $id ?>">
      <table class="ntable-inner-1">
        <thead>
          <tr>
            <th>Types</th>
          </tr>
        </thead>
        <tbody>
          <!-- Add types here -->

          <?php foreach($types as $type): ?>
            <?php $___vars___->use_template(\'t_type\', $type + compact(\'mois\')); ?>
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

<?php if(!empty($mois)): ?>
  <div class="swiper">
    <div class="swiper-wrapper">

      <?php foreach($mois as $mois_): ?>
        <div class="swiper-slide">

          <div class="ncontainer-table" style="height: fit-content !important; overflow-y: auto" id="toPDF">
            <div class="d-flex mb-3">
              <h1 class="text-center"><?= formatMois($mois_) ?> <?= $annee ?></h1>
              <div class="ms-auto px-3 py-2 d-flex gap-1">
                <kbd class="d-flex justify-content-center align-items-center bg-dark">
                  <i class="fas fa-arrow-left" style="color: white;"></i>
                </kbd>
                <kbd class="d-flex justify-content-center align-items-center bg-dark">
                  <i class="fas fa-arrow-right" style="color: white;"></i>
                </kbd>
              </div>
            </div>
            <div
              class="table-responsive-md px-3">
              <table class="ntable w-100">
                <thead>
                  <tr>
                    <th>Categories</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- Add categories here -->
                  <?php foreach($categories as $categorie): ?>
                    <?php $___vars___->use_template('t_categorie', $categorie + ['mois' => $mois_]); ?>
                  <?php endforeach; ?>

                  <!-- Add new -->
                  <tr class="spacer">
                    <td style="height: 1em;"></td>
                  </tr>
                  <tr class="addnew" id="addCategorie" onkeypress="this.click()" tabindex="1">
                    <td>Nouvelle Categorie<i class="fa fa-plus ms-1"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

  </div>

  <script src="<?= route('assets/swiperjs/swiper-bundle.min.js') ?>"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 0,

        centeredSlides: true,

        coverflowEffect: {
          rotate: 30,
          slideShadows: false,
        },

        keyboard: {
          enabled: true,
        },


      });
    });
  </script>
<?php else: ?>
  <div class="ncontainer-table" style="height: fit-content !important; overflow-y: auto;" id="toPDF">
    <h1 class="mb-3 px-3">Aucune information pour l'Annee <?= $annee ?>.</h1>
  </div>
<?php endif; ?>