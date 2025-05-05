<?php

use Razherana\ConfigReader\ConfigurableElement;

require_once __DIR__ . '/../vendor/autoload.php';

class ConfigReaderTest extends ConfigurableElement
{
  public function config_file(): string
  {
    return __DIR__ . '/config';
  }
}

echo (new ConfigReaderTest())->read_config('test') . "\n";
var_dump((new ConfigReaderTest())->read_config('test2'));
