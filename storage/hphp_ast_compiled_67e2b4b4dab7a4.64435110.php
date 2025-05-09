<?php extract(Piewpiew\view\View::$view_vars['pages.departement.departement']->get_data()); ?><?php $___vars___->join('pages/dashboard', ['title' => 'Departement - ' . $departement->name] + compact('departements', 'isDepartement') + ['containertitle' => 'Departement - ' . $departement->name]); ?>

<?php $___vars___->start_block("head"); ?>
  <link rel="stylesheet" href="<?= route('assets/page/css/departement.css') ?>">
  <script src="<?= route('assets/page/js/departement.js') ?>"></script>

  <style>
    .swiper {
      width: 100%;
      margin: 20px auto;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  </style>

  <link rel="stylesheet" href="<?= route('assets/swiperjs/swiper-bundle.min.css') ?>">
<?php $___vars___->end_block(); ?>

<?php $___vars___->start_block("moreHeaders"); ?>
  <a href="<?= route('departements/' . $departement->id . '/exportpdf') ?><?= add_annee() ?>" class="btn btn-outline-primary rounded-pill d-flex justify-content-center align-items-center">
    Export PDF <i class="ms-2 fas fa-file-export"></i>
  </a>
<?php $___vars___->end_block(); ?>

<?php $___vars___->start_block("content"); ?>
  <div class="ncontainer budget" style="min-height: fit-content !important;">
    <div class="d-flex w-100 px-3 justify-content-between align-items-center">
      <h3 class="announcer">Budget Initial : </h3>
      <form action="<?= route('departements/' . $departement->id . '/budget') ?><?= add_annee() ?>" method="post" class="d-flex">
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
          <a href="<?= route("budgets/{$budgetModel->id}/lock") ?><?= add_annee() ?>" class="btn btn-primary ms-2">
            <?php if($closedBudget): ?>
              <i class="fas fa-lock"></i>
            <?php else: ?>
              <i class="fas fa-lock-open"></i>
            <?php endif; ?>
          </a>
        <?php endif; ?>
      </form>
    </div>
  </div>

  <div class="ncontainer-table" style="min-height: fit-content !important;">

    <div class="row px-3 mb-4">
      <label for="annee" class="search-label">Periode : </label>

      <div class="search-bar">
        <form method="get" style="display: contents;">
          <i class="far fa-calendar-plus search-icon translate-middle"></i>
          <input type="text" name="annee" class="search-input rounded-pill" placeholder="2020, 2021, ..."
            value="<?= $annee ?? '' ?>">
          <button type="submit" class="btn btn-primary rounded-pill">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
    </div>

    <?php if(empty($annee)): ?>
      <h3 class="px-5">Veuillez selectionner une Annee pour voir les Informations Budgetaires.</h3>
    <?php endif; ?>
  </div>
  <?php if(!empty($annee)): ?>
    <?php $___vars___->include_block('pages/departement/components/_periode', compact('categories', 'mois', 'annee')); ?>
  <?php endif; ?>

  <div class="ncontainer budget" style="min-height: fit-content !important;">
    <div class="d-flex w-100 px-3 justify-content-between align-items-center">
      <h3 class="announcer">Budget Final : </h3>
      <input class="m-0 input-budget" value="<?= !$closedBudget ? "Attente de confirmation..." : $budgetFinal ?>" readonly>
    </div>
  </div>

  <!-- data-addPrevision -->

  <?php $___vars___->include_block('pages/departement/components/_forms', compact('departement', 'categorie_models', 'categories_json', 'types_json')); ?>

  <script src="<?= route('assets/html2pdf/html2pdf.min.js') ?>"></script>
  <script src="<?= route('assets/jsPDF/jspdf.umd.min.js') ?>"></script>
<?php $___vars___->end_block(); ?><?php $___vars___->use_join(); ?>