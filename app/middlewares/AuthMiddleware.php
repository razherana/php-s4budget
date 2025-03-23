<?php

namespace app\middlewares;

use Flight;

class AuthMiddleware
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
