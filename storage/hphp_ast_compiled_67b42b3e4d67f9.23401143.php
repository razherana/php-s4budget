<?php extract(Piewpiew\view\View::$view_vars['user/login']->get_data()); ?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Company Name - Please Login</title>

  <link rel="stylesheet" href="<?= route("assets/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?= route("assets/css/spa.css") ?>">
  <link rel="stylesheet" href="<?= route("assets/libs/fa/css/all.min.css") ?>">

  <style>
    body {
      background-color: #f8f9fa;
      /* Light background similar to your theme */
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .login-card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .login-header h2 {
      margin-bottom: 5px;
      font-weight: bold;
    }

    .login-header p {
      color: #6c757d;
      font-size: 14px;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-primary {
      border-radius: 10px;
    }

    .form-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    .form-control {
      padding-left: 40px;
    }

    .login-btn {
      background-color: var(--main-color);
    }

    .login-btn:hover {
      background-color: var(--main-color-medium-shade);
    }

    #toggle-password {
      transition: all 0.3s;

    }

    #toggle-password:hover {
      cursor: pointer;
      scale: 1.1;
      rotate: 15deg;
    }
  </style>
</head>

<body>
  <img src="<?= route("assets/img/background.png") ?>" class="background" alt="">

  <div class="login-card">
    <div class="login-header">
      <h2>Login</h2>
      <p>Enter your credentials to access your account</p>
    </div>
    <form method="post" action="<?= route("") ?>">
      <div class="mb-3 position-relative">
        <i class="fa-solid fa-envelope form-icon"></i>
        <input type="email" name="admin_name" class="form-control" placeholder="Email" required>
      </div>
      <div class="mb-3 position-relative">
        <i class="fa-solid fa-lock form-icon" id="toggle-password"></i>
        <input type="password" id="password" name="admin_password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-dark w-100 login-btn">Login</button>

      <div class="mt-3 text-center">
        No Account? <a href="#">Register</a> Here
      </div>
    </form>
  </div>
  <script src="<?= route("assets/js/bootstrap.bundle.min.js") ?>"></script>
  <script>
    const password = document.getElementById("password");
    const togglePassword = document.getElementById("toggle-password");

    let state = 0;
    const states = {
      0: "fa-lock",
      1: "fa-lock-open"
    };

    togglePassword.addEventListener("click", () => {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      togglePassword.classList.remove(states[state]);
      state = (state + 1) % 2;
      togglePassword.classList.add(states[state]);
    });
  </script>
</body>

</html>