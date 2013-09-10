<?php
header('Content-type: application/json; charset=utf-8');
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include_once 'Config.php';
include_once CLASSES.'Response.class.php';
include_once CLASSES.'PoisDataset.class.php';
include_once CLASSES.'Util.class.php';
include_once CLASSES.'Database.class.php';
define('KEY', '5CA9F618-1747-4EAE-ACB6-BB2D57522BE6');


// Connect to the API
$url = "http://build.uitdatabank.be/api/events/search?key=" . KEY . "&regio=Gent";

// Download and parse a bunch of XML
$xml = file_get_contents($url);
$dom = new DOMDocument;
$dom->loadXML($xml);

$pois = array();
foreach ($dom->getElementsByTagName('item') as $item) {
    $poi = array();
    $poi['id'] = $item->getAttribute('id');
    $poi['title'] = $item->getAttribute('title');
    $poi['description'] = $item->getAttribute('shortdescription');
    $poi['category'] = explode(';',$item->getAttribute('heading'));
    // Define location
    $poi['location'] = array();
    // Define LocationPoint
    $poi['location']['point'] = array();
    $poi['location']['point']['term'] = "centroid";
    $poi['location']['point']['pos'] = array();
    $poi['location']['point']['pos']['srsName'] = "http://www.opengis.net/def/crs/EPSG/0/4326";
    $poi['location']['point']['pos']['posList'] = "48.8275910 2.27699460";
    // Define LocationAddress
    $poi['location']['address'] = array();
    $poi['location']['address']['value'] = "";
    $poi['location']['address']['postal'] = "";
    $poi['location']['address']['city'] = ""; 
    
    $poi['attribute'] = array();
    $pois[] = $poi;
}

$dataset = array();
$dataset['id'] = "http://www.uitdatabank.be";
$objDateTime = new DateTime('NOW');
$ctime = $objDateTime->format(DateTime::ISO8601); // ISO8601 formated datetime
$dataset['updated'] = $ctime;
$dataset['created'] = $ctime;
$dataset['lang'] = "nl-NL";
$dataset['author'] = array();
$dataset['author']['id'] = "http://www.gent.be";
$dataset['author']['value'] = "Gent";
$dataset['license'] = "";
$dataset['link'] = "";
$dataset['updatefrequency'] = "";
$dataset['poi'] = $pois;

$complete['dataset'] = $dataset;
$poisDataset = Response::createFromArray(DatasetTypes::Poi, $complete);
Util::printJsonObj(new Response($poisDataset));



/*
if(USE_DATABASE) {
	// open db connection
	Database::connect();
	
	$poisDataset = Response::createFromDb(DatasetTypes::Poi, DATASET_ID);
	Util::printJsonObj(new Response($poisDataset));
	
	Database::disconnect();
}
else {
	$handle = fopen(DATASET_FILE, "r");
	$json = fread($handle, filesize(DATASET_FILE));
	fclose($handle);
	
	// TODO: should type check the source file
	$assocArray = json_decode($json, true);
	
	$poisDataset = Response::createFromArray(DatasetTypes::Poi, $assocArray);
	Util::printJsonObj(new Response($poisDataset));
}
*/




?>