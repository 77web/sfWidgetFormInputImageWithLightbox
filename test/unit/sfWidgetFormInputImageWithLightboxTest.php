<?php

include_once dirname(__FILE__).'/../../bootstrap/unit.php';

$t = new lime_test(7, new lime_output_color());

//------------------------------------------------------------

$file_src = 'http://www.77-web.com/style2/images/h2_web.gif';
$lightbox_class = 'myLightbox';
$lightbox_rel = 'my_lightbox';
$lightbox_js = array('lightbox-v1.js');
$lightbox_css = array('lightbox.css');
$width = '300';

$options = array('file_src'=>$file_src, 'lightbox_class'=>$lightbox_class, 'lightbox_rel'=>$lightbox_rel, 'lightbox_js'=>$lightbox_js, 'lightbox_css'=>$lightbox_css, 'image_width'=>$width);
$w = new sfWidgetFormInputImageWithLightbox($options);

//------------------------------------------------------------
$t->diag('sfWidgetFormInputImageWithLightbox');

$t->diag('->__construct()');
foreach($options as $key => $v)
{
  $t->is($w->getOption($key), $v, '__construct() sets "'.$key.'" option');
}

$t->diag('->render(foo)');
$t->diag('output: '.$w->render('foo'));
$t->isnt($w->render('foo'), '<a rel="'.$lightbox_rel.'" class="'.$lightbox_class.'"><img src="'.$file_src.'" width="'.$width.'" /></a><br /><input type="file" name="foo" value="" id="foo" /><br /><input type="checkbox" name="foo_delete" id="foo_delete" /> <label for="foo_delete">remove the current file</label>');

