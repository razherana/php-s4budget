<?php extract(Piewpiew\view\View::$view_vars['pages.users.list']->get_data()); ?><?php $___vars___->join('pages/dashboard', ['title' => 'Manager d\'Utilisateurs'] + compact('departements') + ['containertitle' => 'Manager d\'Utilisateurs']); ?>

<?php $___vars___->start_block("head"); ?>
  <link rel="stylesheet" href="<?= route('assets/page/css/departement.css') ?>">
<?php $___vars___->end_block(); ?>

<?php $___vars___->start_block("content"); ?>
  <div class="ncontainer budget">
    <form action="<?= route('users/manage') ?>" method="post" class="border p-5 py-3 col-md-9 mx-auto" style="border-radius: .5em;">
      <h2 class="mb-3">Information du nouvel utilisateur</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Nom de l'utilisateur</label>
        <input
          type="text"
          class="form-control"
          name="name"
          id="name"
          aria-describedby="helpId"
          placeholder="Nom de l'utilisateur" />
        <small id="helpId" class="form-text text-muted">Nom de l'utilisateur</small>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email de l'utilisateur</label>
        <input
          type="email"
          class="form-control"
          name="email"
          id="email"
          aria-describedby="helpId"
          placeholder="Email de l'utilisateur" />
        <small id="helpId" class="form-text text-muted">Email de l'utilisateur</small>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe de l'utilisateur</label>
        <input
          type="password"
          class="form-control"
          name="password"
          id="password"
          aria-describedby="helpId"
          placeholder="Mot de passe de l'utilisateur" />
        <small id="helpId" class="form-text text-muted">Mot de passe de l'utilisateur</small>
      </div>

      <div class="mb-3">
        <label for="departement" class="form-label">Departement de l'utilisateur</label>
        <select
          class="form-select"
          name="departement"
          id="departement">
          <option selected disabled>-- Selectionner un departement --</option>
          <?php foreach($departementModels as $departement): ?>
            <option value="<?= $departement->id ?>"><?= $departement->name ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="is_super_admin" class="form-label">Est super admin ?</label>
        <select
          class="form-select"
          name="is_super_admin"
          id="is_super_admin">
          <option selected disabled>-- Selectionner --</option>
          <option value="1">Oui</option>
          <option value="0">Non</option>
        </select>
      </div>

      <div>
        <button class="btn btn-outline-primary">Creer</button>
      </div>
    </form>
  </div>

  <div class="ncontainer-table" style="max-height: 500px; overflow-y: auto">
    <div class="table-responsive-md px-3">
      <table class="ntable w-100">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Departement</th>
            <th>Super Admin</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>

            <tr>
              <td><?= $user->id ?></td>
              <td><?= $user->name ?></td>
              <td><?= $user->email ?></td>
              <td><?= $user->is_super_admin == 1 ? 'SuperAdmin' : $user->departement->name ?></td>
              <td><?= $user->is_super_admin == 1 ? 'Oui' : 'Non' ?></td>
              <td>
                <a href="<?= route('users/edit', ['id' => $user->id]) ?>" class="btn btn-outline-primary">Modifier</a>
                <a href="<?= route('users/delete', ['id' => $user->id]) ?>" class="btn btn-outline-danger">Supprimer</a>
              </td>
            </tr>

            <tr class="spacer">
              <td style="height: 1em;"></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php $___vars___->end_block(); ?><?php $___vars___->use_join(); ?>