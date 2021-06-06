
<?php
$soapURL            = "http://api.rpxholding.com/wsdl/rpxwsdl.php?wsdl";
$soapUser           = "demo";
$soapPassword       = "demo";

$xml_post_string = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
                        <Body>
                            <getCity xmlns="urn:rpxwsdl">
                                <user>'.$soapUser.'</user>
                                <password>'.$soapPassword.'</password>
                                <format></format>
                                <province></province>
                            </getCity>
                        </Body>
                    </Envelope>';

$headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache"
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $soapURL );
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 100);
curl_setopt($curl, CURLOPT_TIMEOUT,        100);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_POST,           true );
curl_setopt($curl, CURLOPT_POSTFIELDS,     $xml_post_string);
curl_setopt($curl, CURLOPT_HTTPHEADER,     $headers);

if(curl_exec($curl) === false) {
    $err = 'Curl error: ' . curl_error($curl);
    curl_close($curl);
    print $err;
} else {
    $result = curl_exec($curl);
    echo '<pre>';
    print_r($result);
    curl_close($curl);
}

?>