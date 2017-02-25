<?php
$query = $_REQUEST['query'];
require_once 'D:/search/elasticsearch/elasticsearch/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

 
 
 //echo "req is".$query;
//$query="เขต";
$client = ClientBuilder::create()->build();
	

$params1 = [
    'index' => 'music1',
    'type' => 'song1',
    'body' => [
	'_source'=>'suggest',
	'suggest' => [
		'song-suggest'=> [
		
			'prefix'=>"$query",
			'completion'=>[
				'field'=>'suggest']
			]
		]

    ]
];


$response = $client->search($params1);
foreach ($response['suggest']['song-suggest'][0]['options'] as $value) {
    $result[]=$value['text'];
	
}
//echo json_encode ($result);
//print_r($response['suggest']['song-suggest'][0]['options'][1]['text']);

echo json_encode($result);


	
	
	
	
	
	?>