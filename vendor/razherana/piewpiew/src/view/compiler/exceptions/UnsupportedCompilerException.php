<?php

namespace Piewpiew\view\compiler\exceptions;

class UnsupportedCompilerException extends CompilerException
{
  public function __construct($compiler = null, $view = null)
  {
    if ($view === null)
      $view = "view";
    else
      $view = "view : " . $view;

    parent::__construct("This compiler is unsupported for this operation or the $view doesn't exist : " . $compiler::class, $compiler);
  }
}
