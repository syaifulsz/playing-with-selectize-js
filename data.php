<?php

header('Content-Type: application/json');
header('HTTP/1.1 200 OK');

$locationCsv = array_map('str_getcsv', file('data/location.csv'));

unset($locationCsv[0]);

$locationData = [];
$locationDataByDistrict = [];

foreach ($locationCsv as $loc) {
	$locationData[$loc[1]]['name'] = $loc[0];
	$locationData[$loc[1]]['slug'] = $loc[1];

	if (@$loc[3]) {
		$locationData[$loc[1]]['district'][$loc[3]]['name'] = $loc[2];
		$locationData[$loc[1]]['district'][$loc[3]]['slug'] = $loc[3];
	}
}

foreach ($locationCsv as $loc) {
	$locationDataByDistrict[$loc[3]]['name'] = $loc[2];
	$locationDataByDistrict[$loc[3]]['slug'] = $loc[3];

	if (@$loc[1]) {
		$locationDataByDistrict[$loc[3]]['state'][$loc[1]]['name'] = $loc[0];
		$locationDataByDistrict[$loc[3]]['state'][$loc[1]]['slug'] = $loc[1];
	}

	// if (@$loc[3]) {
	// 	$locationDataByDistrict[$loc[1]]['district'][$loc[3]]['name'] = $loc[2];
	// 	$locationDataByDistrict[$loc[1]]['district'][$loc[3]]['slug'] = $loc[3];
	// }
}

$output = $locationData;
if (@$_GET['action'] == 'all') {
	$output = $locationDataByDistrict;
}

echo json_encode($output);