<?php
require_once 'includes/auth.php';
require_once 'classes/Destination.php';

requireLogin();

$destination = new Destination();
$destinations = $destination->getByUserId($_SESSION['user_id']);

// Set headers for XML download
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="dreamtrip_destinations_' . date('Y-m-d') . '.xml"');

// Create XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$root = $xml->createElement('destinations');
$root->setAttribute('exported_by', htmlspecialchars($_SESSION['username']));
$root->setAttribute('export_date', date('Y-m-d H:i:s'));
$xml->appendChild($root);

foreach ($destinations as $dest) {
    $destination_element = $xml->createElement('destination');
    $destination_element->setAttribute('id', $dest['id']);
    
    $destination_element->appendChild($xml->createElement('name', htmlspecialchars($dest['name'])));
    $destination_element->appendChild($xml->createElement('country', htmlspecialchars($dest['country'])));
    $destination_element->appendChild($xml->createElement('type', htmlspecialchars($dest['type'])));
    $destination_element->appendChild($xml->createElement('status', htmlspecialchars($dest['status'])));
    $destination_element->appendChild($xml->createElement('notes', htmlspecialchars($dest['notes'])));
    $destination_element->appendChild($xml->createElement('created_at', $dest['created_at']));
    $destination_element->appendChild($xml->createElement('updated_at', $dest['updated_at']));
    
    $root->appendChild($destination_element);
}

echo $xml->saveXML();
?>
