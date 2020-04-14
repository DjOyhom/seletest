<?php

require_once('vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

$selenium_server = "http://selenium-node-chrome-devbox-drupal-test-cicd.paas.red.uy/";
$test_url = "http://drupal-devbox-drupal-test-test.paas.red.uy/";

echo "---------------------------";
echo "Creando Driver de navegador";
echo "---------------------------";

$web_driver = RemoteWebDriver::create(
  $selenium_server,
  \Facebook\WebDriver\Remote\DesiredCapabilities::chrome()
  , 120000
);

echo "---------------------------";
echo "Obteniendo datos de URL";
echo "---------------------------";

$web_driver->get($test_url);

echo "---------------------------";
echo "Obteniendo elementos HTML";
echo "---------------------------";

$element_username = $web_driver->findElement(WebDriverBy::id("edit-name"));
$element_pass = $web_driver->findElement(WebDriverBy::id("edit-pass"));
$element_submit = $web_driver->findElement(WebDriverBy::id("edit-submit"));

echo "---------------------------";
echo "Rellenando datos del formulario";
echo "---------------------------";

if($element_username && $element_pass) {
  $element_username->sendKeys("admin");
  $element_pass->sendKeys("admin");

  $element_submit->submit();
}

echo "---------------------------";
echo "Haciendo print de titulo obtenido";
echo "---------------------------";

print $web_driver->getTitle();

echo "---------------------------";
echo "Terminando";
echo "---------------------------";

$web_driver->quit();
