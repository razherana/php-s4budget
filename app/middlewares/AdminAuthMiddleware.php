<?php

namespace app\middlewares;

use Flight;

class AdminAuthMiddleware
{
  public function before()
  {
    if (!auth("admin")->loggedin()) {
      Flight::redirect("/admin/login");
      return false;
    }
    return true;
  }
}
