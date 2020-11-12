<?php
if(isset($_GET['sid']) && preg_match('/^STEAM_[01]:[01]:\d+$/', $_GET['sid'])){ //checking for input and validating
	$sid = $_GET['sid'];
	$arr = explode(':', $sid); 
	$profile = ($arr[2] * 2) + 0x0110000100000000 + $arr[1]; //formula: W=Z*2+V+Y
	$custom = ''; //default (Custom url is not set by user)
    $h = get_headers('https://steamcommunity.com/profiles/'.$profile, 1);
    if(isset($h['Location'])){
		$c = is_array($h['Location']) ? array_pop($h['Location']) : $h['Location']; //setting custom url if url redirects
		$custom = basename($c);
	}
	$json = array(
		"steamid" => $sid,
		"profile" => $profile,
		"custom" => $custom
	);
	echo json_encode($json);
}
?>