<?php extract(Piewpiew\view\View::$view_vars['admin/dashboard/main']->get_data()); ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Dashboard</title>
  <link rel="stylesheet" href="<?= route("assets/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?= route("assets/css/spa.css") ?>">
  <link rel="stylesheet" href="<?= route("assets/libs/fa/css/all.min.css") ?>">
</head>

<body>
  <img src="<?= route("assets/img/background.png") ?>" class="background" alt="">

  <div class="navbar">
    <span>Dashboard</span>

    <div class="right-side">
      <a href="<?= route("admin/logout") ?>" class="btn btn-outline-dark">Logout</a>
    </div>

  </div>

  <div class="sidebar">
    <div class="toggle" id="sidebar-toggle">
      <i class="fa-solid fa-angle-right"></i>
    </div>

    <div class="logo-container">
      <div class="logo">
        <div class="img">
          <img src="<?= route("assets/img/logo.jpg") ?>">
        </div>
        <div class="logo-texts">
          <h3>Admin Dashboard</h3>
          <p><?= auth("admin")->get()->admin_name ?></p>
        </div>
      </div>
      <hr>
    </div>

    <div class="accordion accordion-flush">
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-1">
          <button class="accordion-button bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#flush-c1" aria-expanded="true" aria-controls="flush-c1">
            main menu
          </button>
        </h2>
        <div id="flush-c1" class="accordion-collapse collapse show" aria-labelledby="flush-1">
          <div class="accordion-body">
            <nav class="nav justify-content-center flex-column">
              <a class="nav-link active" spa-link href="home" aria-current="page">
                <i class="fa-solid fa-house"></i>
                Home
              </a>
              <a class="nav-link" href="<?= route("admin/login") ?>">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                Re-Login
              </a>
            </nav>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-2">
          <button class="accordion-button bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#flush-c2" aria-expanded="true" aria-controls="flush-c2">
            shipments
          </button>
        </h2>
        <div id="flush-c2" class="accordion-collapse collapse show" aria-labelledby="flush-2">
          <div class="accordion-body">
            <nav class="nav justify-content-center flex-column">
              <a class="nav-link" href="list" spa-link>
                <i class="fa-solid fa-list-ul"></i>
                List
              </a>
              <a class="nav-link" href="shipmentReview" spa-link>
                <i class="fa-solid fa-chart-simple"></i>
                Statistics
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="containerall">
    <div id="loading" class="hidden">
      <div class="loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div id="content" class="p-3">
    </div>
  </div>

  <script>
    async function Navigate(page) {
      const container = document.getElementById("content");
      const loading = document.getElementById("loading");

      loading.classList.remove("hidden");
      fetch("<?= route("admin") ?>/api/spa/" + page)
        .then(response => response.text())
        .then(html => {
          loading.classList.add("hidden");
          container.innerHTML = html;
        })
        .catch(error => {
          console.error("Error fetching page: ", error);
        });
    }

    document.querySelectorAll("a[spa-link]").forEach(link => {
      link.addEventListener("click", function(event) {
        event.preventDefault();

        document.querySelectorAll("a[spa-link]").forEach(link => {
          link.classList.remove("active");
        });

        this.classList.add("active");

        let page = this.getAttribute("href");
        history.pushState({}, '', "<?= route("admin") ?>/" + page);
        Navigate(page);
      });
    });

    Navigate("<?= $page ?? "home" ?>");
    document.querySelectorAll(`a[spa-link]`).forEach(e => e.classList.remove("active"));
    document.querySelector(`a[spa-link][href="<?= $page ?? "home" ?>"`).classList.add("active");

    const sideBarToggle = document.getElementById('sidebar-toggle');
    const sideBar = document.querySelector('.sidebar');
    sideBarToggle.addEventListener('click', () => {
      sideBar.classList.toggle('hidden');
    });
  </script>

  <script>
    const handleScreenSizeChange = () => {
      const element = document.querySelector(".sidebar");

      if (window.matchMedia("(max-width: 767px)").matches)
        element.classList.add("hidden");
    }

    handleScreenSizeChange();
    window.addEventListener("resize", handleScreenSizeChange);
  </script>

  <script src="<?= route("assets/js/bootstrap.bundle.min.js") ?>"></script>

  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
</body>

</html>