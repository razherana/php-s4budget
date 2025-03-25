<?php extract(Piewpiew\view\View::$view_vars['tests.division']->get_data()); ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nested Table Example</title>
  <link rel="stylesheet" href="<?= route('assets/bs5.3/css/bootstrap.min.css') ?>">
  <style>
    .nested-table {
      width: 100%;
    }

    th,
    td {
      padding: .5em 1em;
    }

    .nested-table th,
    .nested-table td {
      border: 1px solid #dee2e6;
    }

    .nested {
      padding: 0 !important;
    }

    .nested-collapse {
      text-align: center;
      background-color: #dee2e6 !important;
      cursor: pointer;
      font-weight: bold;
    }

    .nested-collapse:hover {
      background-color: #babcbe !important;
    }

    .nested {
      display: none;
    }

    @keyframes grow {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .nested.show {
      display: table-cell !important;
      animation: .3s grow forwards;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Column 1</th>
          <th>Column 2</th>
          <th>Column 3</th>
          <th>Column 4</th>
          <th>Column 5</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="5" class="nested-collapse" onclick="document.querySelector('.nested').classList.toggle('show')">
            Collapse
          </td>
        </tr>
        <tr>
          <td colspan="5" class="nested">
            <table class="nested-table">
              <thead>
                <tr>
                  <th colspan="2" style="text-align: center;">Depense</th>
                  <th colspan="2" style="text-align: center;">Recette</th>
                </tr>
                <tr>
                  <th>Depense 1</th>
                  <th>Depense 2</th>
                  <th>Recette 1</th>
                  <th>Recette 2</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Data 3</td>
                  <td>Data 4</td>
                  <td>Data 5</td>
                  <td>Data 6</td>
                </tr>
                <tr>
                  <td>Data 7</td>
                  <td>Data 8</td>
                  <td>Data 9</td>
                  <td>Data 10</td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="5" class="nested-collapse" onclick="document.querySelector('.nested').classList.toggle('show')">
            Collapse 2
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="<?= route('assets/bs5.3/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>