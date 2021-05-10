<?php

namespace App\Http\Controllers;



class geoPlugin
{
    	//the geoPlugin server
	var $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}&lang={LANG}';

	//the default base currency
	var $currency = 'USD';

	//the default language
	var $lang = 'en';


	//initiate the geoPlugin vars
	var $ip = null;
	var $city = null;
	var $region = null;
	var $regionCode = null;
	var $regionName = null;
	var $dmaCode = null;
	var $countryCode = null;
	var $countryName = null;
	var $inEU = null;

	var $continentCode = null;
	var $continentName = null;
	var $latitude = null;
	var $longitude = null;
	var $locationAccuracyRadius = null;
	var $timezone = null;
	var $currencyCode = null;
	var $currencySymbol = null;
	var $currencyConverter = null;

	function __construct() {

	}

	function locate($ip = null) {

		global $_SERVER;

		if ( is_null( $ip ) ) {

			//$ip = $_SERVER['REMOTE_ADDR'];
            $ip= "192.168.0.1";
		}

		$host = str_replace( '{IP}', $ip, $this->host );
		$host = str_replace( '{CURRENCY}', $this->currency, $host );
		$host = str_replace( '{LANG}', $this->lang, $host );

		$data = array();

		$response = $this->fetch($host);

		$data = unserialize($response);

		//set the geoPlugin vars
		$this->ip = $ip;
		$this->city = $data['geoplugin_city'];
		$this->region = $data['geoplugin_region'];
		$this->regionCode = $data['geoplugin_regionCode'];
		$this->regionName = $data['geoplugin_regionName'];
		$this->dmaCode = $data['geoplugin_dmaCode'];
		$this->countryCode = $data['geoplugin_countryCode'];
		$this->countryName = $data['geoplugin_countryName'];
		$this->inEU = $data['geoplugin_inEU'];

		$this->continentCode = $data['geoplugin_continentCode'];
		$this->continentName = $data['geoplugin_continentName'];
		$this->latitude = $data['geoplugin_latitude'];
		$this->longitude = $data['geoplugin_longitude'];
		$this->locationAccuracyRadius = $data['geoplugin_locationAccuracyRadius'];
		$this->timezone = $data['geoplugin_timezone'];
		$this->currencyCode = $data['geoplugin_currencyCode'];
		$this->currencySymbol = $data['geoplugin_currencySymbol'];
		$this->currencyConverter = $data['geoplugin_currencyConverter'];

	}

	function fetch($host) {

		if ( function_exists('curl_init') ) {

			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.1');
			$response = curl_exec($ch);
			curl_close ($ch);

		} else if ( ini_get('allow_url_fopen') ) {

			//fall back to fopen()
			$response = file_get_contents($host, 'r');

		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;

		}

		return $response;
	}
}
