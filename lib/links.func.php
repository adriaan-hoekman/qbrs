<?php

	function load_useful_links($links_file) {
		$handle = fopen("$links_file", "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				$link_array[] = preg_split('~(http)~u',$line , null, PREG_SPLIT_DELIM_CAPTURE);
			}

			fclose($handle);
		}
		return $link_array;
	}

	function save_useful_links($links_file, $new_links) {
		$handle = fopen("$links_file", "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
					$link_array[] = (explode("http", $line));
			}

			fclose($handle);
		}
	}

?>