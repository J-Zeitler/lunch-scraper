<?php
libxml_use_internal_errors(true);

function get_inner_html($node) {
  $innerHTML= '';
  $children = $node->childNodes;
  foreach ($children as $child) {
      $innerHTML .= $child->ownerDocument->saveXML( $child );
  }
  return $innerHTML;
}

function scrape($url, $elementId) {
  $res = file_get_contents($url);
  if ($elementId) {
    $DOM = new DOMDocument();
    $DOM->loadHTML($res);
    $el = "";
    $el = $DOM->getElementById($elementId);
    return get_inner_html($el);
  }
  return $res;
}

require('db.php');
$cmenu = scrape("http://visualiseringscenter.se/lunch", 'node-content');
saveScrape('C', $cmenu);
