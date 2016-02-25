<?php
// search, and store all matching occurences in $matches

$tab = [];

$json = ["success"=>"false","postalCodes"=>$tab];

if (!empty($_GET['cp'])){
	//strlen($_GET['cp'])==5 && 
	if (ctype_digit($_GET['cp'])){

		$file = 'cp.txt';
		$searchfor = $_GET['cp'];


// get the file contents, assuming the file to be readable (and exist)
		$contents = file_get_contents($file);
// escape special characters in the query
		$pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
		$pattern = "/^.*$pattern.*\$/m";
		if(preg_match_all($pattern, $contents, $matches)){
			foreach ($matches[0] as $key => $value) {
				$temp = explode("\t", $value);
				$tab[$key] =["placeName"=>$temp[1],"adminName2"=>$temp[2],"adminName1"=>$temp[3],"countryCode"=>$temp[4]];
				//$tab[$key] =["placeName"=>$temp[2],"adminName2"=>$temp[5],"adminName1"=>$temp[3],"countryCode"=>$temp[0]];
			}
			$json = ["success"=>"true","postalCodes"=>$tab];

		}
		else{
			$json = ["success"=>"false","postalCodes"=>$tab];

		}
// the following line prevents the browser from parsing this as HTML.
	}
}

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);

?>