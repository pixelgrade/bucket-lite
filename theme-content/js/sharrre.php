<?php
  header('content-type: application/json');
  //Sharrre by Julien Hany
  $json = array('url'=>'','count'=>0);
  $json['url'] = $_GET['url'];
  $url = urlencode($_GET['url']);
  $type = urlencode($_GET['type']);
  
  if(filter_var($_GET['url'], FILTER_VALIDATE_URL)){
    if($type == 'googlePlus'){  //source http://www.helmutgranda.com/2011/11/01/get-a-url-google-count-via-php/
		$json['count'] = getGooglePlusShares($url);
    }
    else if($type == 'stumbleupon'){
      $content = parse("http://www.stumbleupon.com/services/1.01/badge.getinfo?url=$url");
      
      $result = json_decode($content);
      if (isset($result->result->views))
      {
          $json['count'] = $result->result->views;
      }

    }
  }
  echo str_replace('\\/','/',json_encode($json));
  
  function curl_exec_follow( $ch, &$maxredirect = null) {
    $mr = $maxredirect === null ? 5 : intval($maxredirect);
    if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
    } else {
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        if ($mr > 0) {
            $newurl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

            $rch = curl_copy_handle($ch);
            curl_setopt($rch, CURLOPT_HEADER, true);
            curl_setopt($rch, CURLOPT_NOBODY, true);
            curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
            curl_setopt($rch, CURLOPT_RETURNTRANSFER, true);
            do {
                curl_setopt($rch, CURLOPT_URL, $newurl);
                $header = curl_exec($rch);
                if (curl_errno($rch)) {
                    $code = 0;
                } else {
                    $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
                    if ($code == 301 || $code == 302) {
                        preg_match('/Location:(.*?)\n/', $header, $matches);
                        $newurl = trim(array_pop($matches));
                    } else {
                        $code = 0;
                    }
                }
            } while ($code && --$mr);
            curl_close($rch);
            if (!$mr) {
                if ($maxredirect === null) {
                    trigger_error('Too many redirects. When following redirects, libcurl hit the maximum amount.', E_USER_WARNING);
                } else {
                    $maxredirect = 0;
                }
                return false;
            }
            curl_setopt($ch, CURLOPT_URL, $newurl);
        }
    }
    return curl_exec($ch);
} 
  
  function parse($encUrl){
	$maxredirects = 3;
    $options = array(
      CURLOPT_RETURNTRANSFER => true, // return web page
      CURLOPT_HEADER => false, // don't return headers
//      CURLOPT_FOLLOWLOCATION => true, // follow redirects
      CURLOPT_ENCODING => "", // handle all encodings
      CURLOPT_USERAGENT => 'sharrre', // who am i
      CURLOPT_AUTOREFERER => true, // set referer on redirect
      CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect
      CURLOPT_TIMEOUT => 10, // timeout on response
      CURLOPT_MAXREDIRS => $maxredirects, // stop after 10 redirects
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => false,
    );
    $ch = curl_init();
    
    $options[CURLINFO_EFFECTIVE_URL] = $encUrl;  
    curl_setopt_array($ch, $options);
    
    $content = curl_exec_follow($ch, $maxredirects);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    
    curl_close($ch);
    
    if ($errmsg != '' || $err != '') {
      /*print_r($errmsg);
      print_r($errmsg);*/
    }
    return $content;
  }

function getGooglePlusShares($url) {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
	$curl_results = curl_exec ($curl);
	curl_close ($curl);
	$json = json_decode($curl_results, true);
	if (isset($json[0]['result']['metadata']['globalCounts']['count'])) {
		return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
	} else {
		return 0;
	}
}