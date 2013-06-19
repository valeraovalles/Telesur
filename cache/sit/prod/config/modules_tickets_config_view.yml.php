<?php
// auto-generated by sfViewConfigHandler
// date: 2013/06/11 14:17:20
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Sit', false, false);

  $response->addStylesheet('general.css', '', array ());
  $response->addStylesheet('menu.css', '', array ());
  $response->addStylesheet('crud.css', '', array ());
  $response->addStylesheet('tcal.css', '', array ());
  $response->addStylesheet('sit.css', '', array ());
  $response->addStylesheet('gips.css', '', array ());
  $response->addJavascript('jquery.js', '', array ());
  $response->addJavascript('menu.js', '', array ());
  $response->addJavascript('funciones.js', '', array ());
  $response->addJavascript('tcal.js', '', array ());
  $response->addJavascript('ajax.js', '', array ());
  $response->addJavascript('ajax_refresh.js', '', array ());
  $response->addJavascript('gips.js', '', array ());


