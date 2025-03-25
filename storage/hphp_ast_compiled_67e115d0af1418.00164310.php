<?php extract(Piewpiew\view\View::$view_vars['pages.departement.form']->get_data()); ?><?php $___vars___->join('pages/dashboard', ['title' => 'Create a Departement'] + compact('departements') + ['containertitle' => 'Create a Departement']); ?>

<?php $___vars___->start_block("head"); ?>
  <link rel="stylesheet" href="<?= route('assets/page/css/departement.css') ?>">
<?php $___vars___->end_block(); ?>

<?php $___vars___->start_block("content"); ?>
  <div class="ncontainer budget">
    <form action="<?= route('departements/create') ?>" method="post" class="border p-5 py-3 col-md-9 mx-auto" style="border-radius: .5em;">
      <h2 class="mb-3">Information du nouveau departement</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Nom du Departement</label>
        <input
          type="text"
          class="form-control"
          name="name"
          id="name"
          aria-describedby="helpId"
          placeholder="Informatique, Finance, etc..." />
        <small id="helpId" class="form-text text-muted">Nom du Departement</small>
      </div>

      <div class="mb-3">
        <label for="icon" class="form-label">Icon</label>
        <select
          class="form-select"
          name="icon"
          id="icon">
          <option selected>-- Select one or write in the input below --</option>
          <option value="fa fa-briefcase">Briefcase</option>
          <option value="fa fa-money-bill">Money Bill</option>
          <option value="fa fa-chart-line">Chart Line</option>
          <option value="fa fa-chart-pie">Chart Pie</option>
          <option value="fa fa-chart-bar">Chart Bar</option>
          <option value="fa fa-chart-area">Chart Area</option>
          <option value="fa fa-balance-scale">Balance Scale</option>
          <option value="fa fa-balance-scale-right">Balance Scale Right</option>
          <option value="fa fa-balance-scale-left">Balance Scale Left</option>
          <option value="fa fa-user-tie">User Tie</option>
          <option value="fa fa-user-secret">User Secret</option>
          <option value="fa fa-user-shield">User Shield</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="icon-custom" class="form-label">Icon (Custom), leave empty if not needed...</label>
        <input type="text" class="form-control" id="icon-custom" name="icon-custom" placeholder="fa fa-icon">
      </div>

      <div>
        <button class="btn btn-outline-primary">Creer</button>
      </div>
    </form>
  </div>
<?php $___vars___->end_block(); ?><?php $___vars___->use_join(); ?>