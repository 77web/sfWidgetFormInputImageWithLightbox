<?php

class sfWidgetFormInputImageWithLightbox extends sfWidgetFormInputFileEditable
{

  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->addOption('is_image', true);
    $this->addOption('image_width', 92);
    $this->addOption('lightbox_rel', 'lightbox');
    $this->addOption('lightbox_class', 'lightbox');
    $this->addOption('lightbox_js', array('/js/lightbox/lightbox.js'));
    $this->addOption('lightbox_css', array('/js/lightbox/lightbox.css'));
    $this->addOption('auto_response', false);
  }

  protected function getFileAsTag($attributes)
  {
    return false !== $this->getOption('file_src') ? $this->renderContentTag('a', $this->renderTag('img', array_merge(array('width'=>$this->getOption('image_width'),'src' => $this->getOption('file_src'))), $attributes), array_merge(array('rel'=>$this->getOption('lightbox_rel'), 'class'=>$this->getOption('lightbox_class'), 'href'=>$this->getOption('file_src')), $attributes)) : '';
  }
  
  public function render($name, $value='', $attributes=array(), $errors=array())
  {
    if(false !== $this->getOption('auto_response'))
    {
      foreach($this->getOption('lightbox_js') as $js)
      {
        sfContext::getInstance()->getResponse()->addJavascript($js);
      }
      foreach($this->getOption('lightbox_css') as $css)
      {
        sfContext::getInstance()->getResponse()->addStylesheet($css);
      }
    }
    return parent::render($name, $value, $attributes, $errors);
  }
}