<?php extract(Piewpiew\view\View::$view_vars['components/errorsuccess']->get_data()); ?><?php if(!empty($error = sezzion()->tempget('error'))): ?>
  <div
    class="alert alert-danger alert-dismissible fade show mt-3 col-md-9 mx-auto"
    role="alert">
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"></button>
    <strong>Error</strong> <?= $error ?>
  </div>
<?php endif; ?>

<?php if(!empty($success = sezzion()->tempget('success'))): ?>
  <div
    class="alert alert-success alert-dismissible fade show mt-3 col-md-9 mx-auto"
    role="alert">
    <button
      type="button"
      class="btn-close"
      data-bs-dismiss="alert"
      aria-label="Close"></button>
    <strong>Success</strong> <?= $success ?>
  </div>
<?php endif; ?>