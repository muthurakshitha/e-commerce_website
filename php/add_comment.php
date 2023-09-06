<?php
  $commentsXml = simplexml_load_file('comments.xml');

  $newComment = $commentsXml->addChild('comment');
  $newComment->addAttribute('id', count($commentsXml->comment) + 1);
  $newComment->addChild('product', $_POST['item']);
  $newComment->addChild('user', $_POST['user']);
  $newComment->addChild('text', $_POST['text']);
  $newComment->addChild('rating', $_POST['rating']);

  $commentsXml->asXML('comments.xml');

  header('Location: product.php');
?>

