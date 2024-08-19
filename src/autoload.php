<?php

function UseClasses($classe)
{
  try {
    if(str_contains($classe, "src")){
      $classe = str_replace('src', '', $classe);
      $classe = str_replace('\\', '/', $classe);
      require_once __DIR__. $classe . ".php";
    }
    else {
      throw new Error("The class $classe is not found!");
    }
  } catch (Error $e) {
    echo "Error: " . $e->getMessage();
  }
}

spl_autoload_register('UseClasses');