<?php

namespace app\middlewares;

use Flight;

class SuperAdminMiddleware
{
  public function before()
  {
    if (!auth()->loggedin() || auth()->get()->is_super_admin != 1) {
      sezzion()->tempset('error', 'You are not authorized to access this page, please login as a super admin.');
      Flight::redirect("/login");
      return false;
    }
    return true;
  }
}
