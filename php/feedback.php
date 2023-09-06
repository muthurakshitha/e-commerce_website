<?php
// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Load the XML file
$xml = simplexml_load_file('feedbacks.xml');

// Create a new feedback element
$feedback = $xml->addChild('feedback');

// Add the form data as child elements
$feedback->addChild('name', $name);
$feedback->addChild('email', $email);
$feedback->addChild('message', $message);

// Save the XML file
$xml->asXML('feedbacks.xml');

// Redirect back to the form page with a success message
header('Location: feed.php?success=1');
