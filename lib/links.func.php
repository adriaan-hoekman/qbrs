<?php

function get_useful_links($dbc) {
	$sql = "SELECT * FROM UsefulLink";
	$query = $dbc -> query($sql);

	return $query;
}

function set_useful_links($dbc, $new_links) {
	foreach ($new_links as $link) {
		$link_id = $link['LinkID'];
		$link_desc = $link['Description'];
		$link_url = $link['Url'];
		$sql = "INSERT INTO UsefulLink (LinkID, Description, Url)
						VALUES ('$link_id', '$link_desc', '$link_url')
						ON DUPLICATE KEY UPDATE
						Description='$link_desc', Url='$link_url'";
	}

	$query = $dbc -> query($sql) or die(0);

	if ($query) {
		return 1;
	} else {
		return 0;
	}
}

?>