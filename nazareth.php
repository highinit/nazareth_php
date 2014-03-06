<?php

class Nazareth {
	private $app_id;
	private $app_secret;

	function __construct($_app_id, $_app_secret) {
		$this->app_id = $_app_id;
		$this->app_secret = $_app_secret;
	}

	public function categorize($text) {
		$args = json_encode(array ( "text" => $text ));
		$sign = sha1($args.$this->app_secret);
		$req = array("app_id" => $this->app_id,
				"sign" => $sign,
				"action" => "categorize",
				"args" => $args);
		//echo json_encode( $req );
		
		if( $curl = curl_init() ) {
			curl_setopt($curl, CURLOPT_URL, 'http://sugg.highinit.com:1234');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, "query=".json_encode($req));
			$out = curl_exec($curl);
			curl_close($curl);
			return $out;
		}
	}
}

?>
