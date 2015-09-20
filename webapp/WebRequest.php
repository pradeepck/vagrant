<?php

class WebRequest
{
	var $ch ;
	var $cookiefile;
	var $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";

	function WebRequest()
	{
		$this->ch= curl_init();
		$this->cookie(dirname(__FILE__)."cookie.txt");
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch, CURLOPT_USERAGENT, $this->useragent);
		curl_setopt ( $this->ch, CURLOPT_COOKIEFILE, $this->cookiefile);
		curl_setopt ( $this->ch, CURLOPT_COOKIEJAR, $this->cookiefile);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);	
	}
	
	function urlencode($paramsArray)
	{
		if ($paramsArray != null)
		{
		   $encodedParams = array();
		   foreach($paramsArray as $key=>$value)
		   {
               if ($key == "import_file")
               {
                   $encodedParams[$key] = $value;
                   continue;
               }else
		      $encodedParams[$key] = urlencode($value);
		   }
		   return $encodedParams;

		}
		else return null;
	
	}
	function get($baseurl, $paramsArray=null)
	{

		//$encodedParams = $this->urlencode($paramsArray);
		//"displaying params..." ;
		//var_dump($paramsArray);
		 
		if ($paramsArray!=null)
		{
			$paramsPart =$this->http_parse_query($paramsArray);
			curl_setopt($this->ch, CURLOPT_URL, $baseurl."?".$paramsPart);
		}else
			curl_setopt($this->ch, CURLOPT_URL, $baseurl);
		//echo "<br/> <br/> url is ". $baseurl."?".$paramsPart;
		$result = curl_exec($this->ch);
		//echo "<br/><br/> result is...." . $result;
		
		return $result;
	}
	
	function post($baseurl, $paramsArray)
	{
		//echo "<br/> <br/> in webrequest->post..." . $baseurl;
		curl_setopt($this->ch, CURLOPT_URL, $baseurl);
		curl_setopt($this->ch, CURLOPT_POST, true);
		$encodedParams = $this->urlencode($paramsArray);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS,$paramsArray);
		//echo "<br/> <br/> before curl_exec...";
		//var_dump($paramsArray);
		$result = curl_exec($this->ch);
		//echo "<br/><br/> result : " . $result;
		return $result;
	}
	
	function cookie($cookie_file) {
        if (file_exists ( $cookie_file )) 
		{
			$this->cookiefile = $cookie_file;
        } 
		else 
		{
			if($fp = fopen ( $cookie_file, 'w' ))
            {
                        fclose($fp);
            }
            else die ( 'The cookie file could not be opened. Make sure this directory has the correct permissions' );
            $this->cookiefile = $cookiefile;
        }
    }
	function http_parse_query( $array = NULL, $convention = '%s' ){

		if( count( $array ) == 0 ){
			return '';
		} else 
		{
			if( function_exists( 'http_build_query' ) )
			{
				$query = http_build_query( $array );
			} else 
			{
				$query = '';
				foreach( $array as $key => $value )
				{
					if( is_array( $value ) )
					{
						$new_convention = sprintf( $convention, $key ) . '[%s]';
						$query .= http_parse_query( $value, $new_convention );
					} else 
					{
						$key = urlencode( $key );
						$value = urlencode( $value );
						$query .= sprintf( $convention, $key ) . "=$value&";
					}
				}
			}

		return $query;

		}
	}
}
?>