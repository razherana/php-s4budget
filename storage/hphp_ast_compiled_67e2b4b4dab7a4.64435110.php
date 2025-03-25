<?php extract(Piewpiew\view\View::$view_vars['pages.departement.departement']->get_data()); ?><?php $___vars___->join('pages/dashboard', ['title' => 'Departement - ' . $departement->name] + compact('departements') + ['containertitle' => 'Departement - ' . $departement->name]); ?>

<?php $___vars___->start_block("head"); ?>
  <link rel="stylesheet" href="<?= route('assets/page/css/departement.css') ?>">
  <script src="<?= route('assets/page/js/departement.js') ?>"></script>
<?php $___vars___->end_block(); ?>

<?php $___vars___->start_block("moreHeaders"); ?>
  <button class="btn btn-primary rounded-pill" onclick="generatePDF()">Export PDF <i class="fas fa-file-export"></i></button>
<?php $___vars___->end_block(); ?>

<?php $___vars___->add_template('t_prevision', '
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
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions1 as $p): ?>
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
              </tr>

              <?php continue ; ?>
            <?php endif; ?>

            <tr style="font-size: 13px;" class="<?= $p[\'realisation\'] <= $p[\'prevision\'] ? \'plusplus\' : \'moinsmoins\' ?>">
              <td><?= $p[\'designation\'] ?></td>
              <td><?= format($p[\'prevision\']) ?> Ar</td>
              <td><?= format($p[\'realisation\']) ?> Ar</td>
              <td><?= format($p[\'realisation\'] - $p[\'prevision\']) ?> Ar</td>
              <td><?= $p[\'date\'] ?></td>
            </tr>
          <?php endforeach; ?>

          <tr class="spacer">
            <td style="height: .75em;"></td>
          </tr>
          <tr style="font-size: 13px;" class="<?= $totalRealisation1 <= $totalPrevision1 ? \'plusplus\' : \'moinsmoins\' ?>">
            <td><b>Totals : </b></td>
            <td><b><?= format($totalPrevision1) ?> Ar</b></td>
            <td><b><?= format($totalRealisation1) ?> Ar</b></td>
            <td><b><?= format($totalRealisation1 - $totalPrevision1) ?> Ar</b></td>
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
          </tr>
        </thead>
        <tbody>
          <?php foreach($previsions2 as $p): ?>
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
              </tr>

              <?php continue ; ?>
            <?php endif; ?>

            <tr style="font-size: 13px;" class="<?= $p[\'realisation\'] >= $p[\'prevision\'] ? \'plusplus\' : \'moinsmoins\' ?>">
              <td><?= $p[\'designation\'] ?></td>
              <td><?= format($p[\'prevision\']) ?> Ar</td>
              <td><?= format($p[\'realisation\']) ?> Ar</td>
              <td><?= format($p[\'prevision\'] - $p[\'realisation\']) ?> Ar</td>
              <td><?= $p[\'date\'] ?></td>
            </tr>
          <?php endforeach; ?>

          <tr class="spacer">
            <td style="height: .75em;"></td>
          </tr>
          <tr style="font-size: 13px;" class="<?= $totalRealisation2 >= $totalPrevision2 ? \'plusplus\' : \'moinsmoins\' ?>">
            <td><b>Totals : </b></td>
            <td><b><?= format($totalPrevision2) ?> Ar</b></td>
            <td><b><?= format($totalRealisation2) ?> Ar</b></td>
            <td><b><?= format($totalPrevision2 - $totalRealisation2) ?> Ar</b></td>
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

          <?php $___vars___->use_template(\'t_prevision\', $previsions); ?>

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

<?php $___vars___->start_block("content"); ?>
  <div class="ncontainer budget" style="min-height: fit-content !important;">
    <div class="d-flex w-100 px-3 justify-content-between align-items-center">
      <h3 class="announcer">Budget Initial : </h3>
      <form action="<?= route('departements/' . $departement->id . '/budget') ?>" method="post" class="d-flex">
        <input type="hidden" name="id_departement" value="<?= $departement->id ?>">
        <input class="m-0 input-budget" <?php if ($hasBudget) { ?> value="<?= $budget ?>" <?php } ?> placeholder="<?= $budget ?>" name="solde"
          <?php if ($closedBudget) { ?>
          readonly
          <?php } ?> />

        <?php if(!$closedBudget): ?>
          <button type="submit" class="btn btn-primary ms-2">
            <i class="fa fa-pen"></i>
          </button>
        <?php endif; ?>

        <?php if(auth()->get()->is_super_admin && $hasBudget): ?>
          <a href="<?= route("budgets/{$budgetModel->id}/lock") ?>" class="btn btn-primary ms-2">
            <?php if($closedBudget): ?>
              <i class="fas fa-lock-open"></i>
            <?php else: ?>
              <i class="fas fa-lock"></i>
            <?php endif; ?>
          </a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <div class="ncontainer-table" style="max-height: 500px; overflow-y: auto" id="toPDF">
    <div class="row px-3 mb-4">
      <div class="search-bar">
        <i class="fa fa-search search-icon translate-middle"></i>
        <input type="text" class="search-input rounded-pill" placeholder="Search here...">
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
            <?php $___vars___->use_template('t_categorie', $categorie); ?>
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

  <?php $___vars___->include_block('pages/departement/components/_periode', ); ?>

  <div class="ncontainer budget" style="min-height: fit-content !important;">
    <div class="d-flex w-100 px-3 justify-content-between align-items-center">
      <h3 class="announcer">Budget Final : </h3>
      <input class="m-0 input-budget" value="<?= !$closedBudget ? "Attente de confirmation..." : $budgetFinal ?>" readonly>
    </div>
  </div>

  <!-- data-addPrevision -->

  <div id="addPrevisionForm" class="hidden">
    <form action="<?= route('departements/previsions') ?>" method="post" class="p-5 bg-light col-md-7 mx-auto border rounded-4">
      <input type="hidden" id="id_type" name="id_type" value="">
      <div class="d-flex mb-3 align-items-center">
        <h1 class="m-0">Creer une Prevision</h1>
        <i class="far fa-window-close ms-auto close" onclick="document.getElementById('addPrevisionForm').classList.toggle('hidden')"></i>
      </div>
      <div class="mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input
          type="text"
          class="form-control"
          name="designation"
          id="designation"
          aria-describedby="nameHelpId"
          placeholder="Achat de 50kg Riz, Vente de 300 Pains, ..."
          required />
        <small id="nameHelpId" class="form-text text-muted">Designation de la nouvelle prevision</small>
      </div>
      <div class="mb-3">
        <label for="realisation" class="form-label">Realisation</label>
        <input
          type="number"
          class="form-control"
          name="realisation"
          id="realisation"
          aria-describedby="realisationHelpId"
          step="0.01"
          placeholder="50000, 30000, ..."
          required />
        <small id="realisationHelpId" class="form-text text-muted">Realisation de la nouvelle Prevision</small>
      </div>

      <div class="mb-3">
        <label for="prevision" class="form-label">Prevision</label>
        <input
          type="number"
          class="form-control"
          name="prevision"
          id="prevision"
          aria-describedby="previsionHelpId"
          placeholder="50000, 30000, ..." />
        <small id="previsionHelpId" class="form-text text-muted">Prevision</small>
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <select
          class="form-select"
          name="type"
          id="type">
          <option selected disabled>-- Select one --</option>
          <option value="0">Depense</option>
          <option value="1">Recette</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input
          type="date"
          class="form-control"
          name="date"
          id="date"
          aria-describedby="dateHelpId"
          required
          value="<?= date('Y-m-d') ?>" />
        <small id="dateHelpId" class="form-text text-muted">Date de la nouvelle prevision</small>
      </div>

      <div>
        <button type="submit" class="btn btn-outline-primary">Creer</button>
      </div>
    </form>
  </div>

  <div id="addTypeForm" class="hidden">
    <form action="<?= route('departements/types') ?>" method="post" class="p-5 bg-light col-md-7 mx-auto border rounded-4">
      <input type="hidden" id="id_categorie" name="id_categorie" value="">
      <div class="d-flex mb-3 align-items-center">
        <h1 class="m-0">Creer un type</h1>
        <i class="far fa-window-close ms-auto close" onclick="document.getElementById('addTypeForm').classList.toggle('hidden')"></i>
      </div>
      <div class="mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input
          type="text"
          class="form-control"
          name="designation"
          id="designation"
          aria-describedby="nameHelpId"
          placeholder="Riz, Ciment, Brique, ..." />
        <small id="nameHelpId" class="form-text text-muted">Designation du nouveau type</small>
      </div>
      <div>
        <button type="submit" class="btn btn-outline-primary">Creer</button>
      </div>
    </form>
  </div>

  <div id="addCategorieForm" class="hidden">
    <form action="<?= route('departements/categories') ?>" method="post" class="p-5 bg-light col-md-7 mx-auto border rounded-4">
      <input type="hidden" name="id_departement" value="<?= $departement->id ?>">
      <div class="d-flex mb-3 align-items-center">
        <h1 class="m-0">Creer une categorie</h1>
        <i class="far fa-window-close ms-auto close" onclick="document.getElementById('addCategorieForm').classList.toggle('hidden')"></i>
      </div>
      <div class="mb-3">
        <label for="designation" class="form-label">Designation</label>
        <input
          type="text"
          class="form-control"
          name="designation"
          id="designation"
          aria-describedby="nameHelpId"
          placeholder="Infrastructure, Nourriture, ..." />
        <small id="nameHelpId" class="form-text text-muted">Designation de la nouvelle categorie</small>
      </div>
      <div>
        <button type="submit" class="btn btn-outline-primary">Creer</button>
      </div>
    </form>
  </div>

  <script src="<?= route('assets/html2pdf/html2pdf.min.js') ?>"></script>
  <script src="<?= route('assets/jsPDF/jspdf.umd.min.js') ?>"></script>

  <script>
    const {
      jsPDF
    } = window.jspdf;

    function generatePDF() {
      const element = document.getElementById('toPDF');

      html2canvas(element, {
        scale: 2, // Higher quality
        logging: true, // Helpful for debugging
        useCORS: true // For external images
      }).then(canvas => {
        const doc = new jsPDF('p', 'mm', 'a4');
        const imgData = canvas.toDataURL('image/png');

        // Calculate dimensions to fit PDF page
        const pageWidth = doc.internal.pageSize.getWidth();
        const pageHeight = doc.internal.pageSize.getHeight();
        const ratio = canvas.width / canvas.height;
        let imgWidth = pageWidth;
        let imgHeight = imgWidth / ratio;

        // If content is taller than page, adjust
        if (imgHeight > pageHeight) {
          imgHeight = pageHeight;
          imgWidth = imgHeight * ratio;
        }

        doc.addImage(imgData, 'PNG',
          (pageWidth - imgWidth) / 2, // Center horizontally
          (pageHeight - imgHeight) / 2, // Center vertically
          imgWidth,
          imgHeight
        );

        doc.save('document.pdf');
      }).catch(err => {
        console.error('Error generating PDF:', err);
      });
    }
  </script>
<?php $___vars___->end_block(); ?><?php $___vars___->use_join(); ?>