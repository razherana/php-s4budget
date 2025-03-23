<?php

namespace app\middlewares;

use Flight;

class UserAuthMiddleware
{
  public function before()
  {
    if (!auth()->loggedin()) {
      Flight::redirect("/login");
      return false;
    }
    return true;
  }
}
