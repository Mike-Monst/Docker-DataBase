<?php

/* http://crm.mwerk.lokal/webservice.php?key=hash&func=get_avail */
/* https://davidwalsh.name/web-service-php-mysql-xml-json */
/* require the key as the parameter */
if((isset($_GET['key']) && strval($_GET['key']))&&(isset($_GET['func']) && strval($_GET['func']))) {

/* intval */

        require("config.inc.php");


	/* soak in the passed variable or set our own */
	$number_of_elements = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	$format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json'; //json is the default
	$key = intval($_GET['key']); //no default
        if(($key)!='xyz') die('Invalid API Key');


	/* connect to the db */

	$link=mysql_pconnect($server,$user,$passwort) or die('Cannot connect to the DB');
	mysql_select_db('crmgustav',$link) or die('Cannot select the DB');

	/* grab the elements from the db */
	$query = "SELECT location_id, location_long FROM dslprov_locations LIMIT $number_of_elements";
	$result = mysql_query($query,$link) or die('Errant query:  '.$query);

	/* create one master array of the records */
	$elements = array();
	if(mysql_num_rows($result)) {
		while($element = mysql_fetch_assoc($result)) {
			$elements[] = array('element'=>$element);
		}
	}

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('elements'=>$elements));
	}
	else {
		header('Content-type: text/xml');
		echo '<elements>';
		foreach($elements as $index => $element) {
			if(is_array($element)) {
				foreach($element as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</elements>';
	}

	/* disconnect from the db */
	@mysql_close($link);
}

?>