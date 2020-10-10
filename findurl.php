<h2>Find Steam Profile URL</h2>
<form><input name="sid" type="text" placeholder="SteamID"/><input type="submit" value="Find"/></form>
<?php
$regex = '/^STEAM_[01]:[01]:\d+$/';
if(isset($_GET['sid']) && preg_match($regex, $_GET['sid'])){ //checking for input and validating
	$sid = $_GET['sid'];
	$arr = explode(':', $sid); 
	$w = ($arr[2] * 2) + 0x0110000100000000 + $arr[1]; //formula: W=Z*2+V+Y
	
	echo 'SteamID: '.$sid.'<br>';
	$url = 'https://steamcommunity.com/profiles/'.$w;
	echo 'Profile URL: '.$url.'<br>';
	$custom = 'Not set by user'; //default (Custom url is not set by user)
    $h = get_headers($url, 1);
    if(isset($h['Location'])){
		$custom = is_array($h['Location']) ? array_pop($h['Location']) : $h['Location']; //setting custom url if url redirects
	}
	echo 'Custom URL: '.$custom;
}
?>