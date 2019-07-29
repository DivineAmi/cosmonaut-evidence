<?php

  spl_autoload_register('autoLoaderClasses');

  function autoLoaderClasses($className) {
    $dirPath = "classes/";
    $fileExt = ".class.php";
    $fullPath = $dirPath . $className . $fileExt;

    if(!file_exists($fullPath)) {
      return false;
    }

    include $fullPath;
  }

?>
