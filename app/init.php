<?php

require_once 'D:/search/elasticsearch/elasticsearch/vendor/autoload.php';

use Elasticsearch\ClientBuilder;

    

$client = ClientBuilder::create()->build();
	
$params = [
    'index' => 'music1',
    'type' => 'song1',
    'body' => [
        'query' => [
            'match' => [
                'suggest' => "เขตเศรษฐกิจพิเศษ"
            ]
        ]
    ]
];



$params1 = [
    'index' => 'music1',
    'type' => 'song1',
    'body' => [
	'_source'=>'suggest',
	'suggest' => [
		'song-suggest'=> [
		
			'prefix'=>'เขต',
			'completion'=>[
				'field'=>'suggest']
			]
		]

    ]
];


$response = $client->search($params1);
foreach ($response['suggest']['song-suggest'][0]['options'] as $value) {
    $result[]=$value['text'];
	//echo "<br>";
}
//echo json_encode ($result);
//print_r($response['suggest']['song-suggest'][0]['options'][1]['text']);

print_r($result)


	
	
	
	
	
	?>