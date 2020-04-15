<?php

require_once('../vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

$selenium_server = "http://selenium-node-chrome-devbox-drupal-test-cicd.paas.red.uy/wd/hub";
$test_url = "http://drupal-devbox-drupal-test-test.paas.red.uy/user/login";


echo "---------------------------";
echo "Creando Driver de navegador";
echo "---------------------------";

try {
    $web_driver = RemoteWebDriver::create(
        $selenium_server,
        \Facebook\WebDriver\Remote\DesiredCapabilities::chrome()
        , 120000);
} catch(Exception $e) {
  echo 'Error creando el WebDriver --- \n' .$e->getMessage();
}

echo "---------------------------";
echo "Obteniendo datos de URL";
echo "---------------------------";

try {
    $web_driver->get($test_url);
} catch(Exception $e) {
  echo 'Error obteniendo datos de la url --- \n' .$e->getMessage();
}

echo "---------------------------";
echo "Obteniendo elementos HTML";
echo "---------------------------";

try {
    $element_username = $web_driver->findElement(WebDriverBy::id("edit-name"));
    $element_pass = $web_driver->findElement(WebDriverBy::id("edit-pass"));
    $element_submit = $web_driver->findElement(WebDriverBy::id("edit-submit"));
} catch(Exception $e) {
  echo 'Error obteniendo elementos del html --- \n' .$e->getMessage();
}

echo "---------------------------";
echo "Rellenando datos del formulario";
echo "---------------------------";

try {
    if ($element_username && $element_pass) {
        $element_username->sendKeys("admin");
        $element_pass->sendKeys("admin");

        $element_submit->submit();
    }
} catch(Exception $e) {
  echo 'Error rellenando el formulario de login --- \n' .$e->getMessage();
}

echo "---------------------------";
echo "Haciendo print de titulo obtenido";
echo "---------------------------";

try {
    print $web_driver->getTitle();
} catch(Exception $e) {
  echo 'Error obteniendo el titulo --- \n' .$e->getMessage();
}

echo "---------------------------";
echo "Terminando";
echo "---------------------------";

$web_driver->quit();
