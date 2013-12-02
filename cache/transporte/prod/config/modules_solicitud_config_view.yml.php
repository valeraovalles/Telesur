<?php
// auto-generated by sfViewConfigHandler
// date: 2013/12/02 17:17:03
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
  $response->addMeta('title', 'Transporte', false, false);

  $response->addStylesheet('general.css', '', array ());
  $response->addStylesheet('menu.css', '', array ());
  $response->addStylesheet('crud.css', '', array ());
  $response->addStylesheet('tcal.css', '', array ());
  $response->addStylesheet('transporte.css', '', array ());
  $response->addJavascript('jquery.js', '', array ());
  $response->addJavascript('menu.js', '', array ());
  $response->addJavascript('funciones.js', '', array ());
  $response->addJavascript('tcal.js', '', array ());
  $response->addJavascript('ajax.js', '', array ());


