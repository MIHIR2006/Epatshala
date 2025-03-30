<?php
session_start();
// Tell PayFast that this page is reachable by triggering a header 200
header( 'HTTP/1.0 200 OK' );
flush();
 
require_once "config.php";
 
$pfHost = PAYFAST_SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
// Posted variables from ITN
$pfData = $_POST;
 
// Strip any slashes in data
foreach( $pfData as $key => $val ) {
    $pfData[$key] = stripslashes( $val );
}
 
// Convert posted variables to a string
$pfParamString = '';
foreach( $pfData as $key => $val ) {
    if( $key !== 'signature' ) {
        $pfParamString .= $key .'='. urlencode( $val ) .'&';
    } else {
        break;
    }
}
 
$pfParamString = substr( $pfParamString, 0, -1 );
 
function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {
    // Calculate security signature
    if($pfPassphrase === null) {
        $tempParamString = $pfParamString;
    } else {
        $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
    }
 
    $signature = md5( $tempParamString );
    return ( $pfData['signature'] === $signature );
}
 
function pfValidIP() {
    // Variable initialization
    $validHosts = array(
        'www.payfast.co.za',
        'sandbox.payfast.co.za',
        'w1w.payfast.co.za',
        'w2w.payfast.co.za',
        );
 
    $validIps = [];
 
    foreach( $validHosts as $pfHostname ) {
        $ips = gethostbynamel( $pfHostname );
 
        if( $ips !== false )
            $validIps = array_merge( $validIps, $ips );
    }
 
    // Remove duplicates
    $validIps = array_unique( $validIps );
    $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
    if( in_array( $referrerIp, $validIps, true ) ) {
        return true;
    }
    return false;
}
 
function pfValidPaymentData( $cartTotal, $pfData ) {
    return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
}
 
function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
    // Use cURL (if available)
    if( in_array( 'curl', get_loaded_extensions(), true ) ) {
        // Variable initialization
        $url = 'https://'. $pfHost .'/eng/query/validate';
 
        // Create default cURL object
        $ch = curl_init();
     
        // Set cURL options - Use curl_setopt for greater PHP compatibility
        // Base settings
        curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
        curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
         
        // Standard settings
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
        if( !empty( $pfProxy ) )
            curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
     
        // Execute cURL
        $response = curl_exec( $ch );
        curl_close( $ch );
        if ($response === 'VALID') {
            return true;
        }
    }
    return false;
}
 

require_once("../DB/connect.php");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
// get transaction stored in database

$total = 0;
$products = $_SESSION['cart'];
foreach ($products as $key => $value) {
  $ptotal = $value['price'] * $value['quantity'];
  $total = $total + $ptotal;
}
 
$pfPassphrase = PAYFAST_PASSPHRASE;
$check1 = pfValidSignature($pfData, $pfParamString, $pfPassphrase);
$check2 = pfValidIP();
$cartTotal = $total;
$check3 = pfValidPaymentData($cartTotal, $pfData);
$check4 = pfValidServerConfirmation($pfParamString, $pfHost);
 
$arr_data = array('payment_id' => $pfData['m_payment_id']);
 
if($check1 && $check2 && $check3 && $check4) {
    // All checks have passed, the payment is successful
    $arr_data['status'] = 'completed';
} else {
    // Some checks have failed, check payment manually and log for investigation
    $arr_data['status'] = 'failed';
}

$query = "UPDATE `enroll` SET status=".$arr_data['status']." WHERE payment_id=".$_SESSION['payment_id'];
if (mysqli_query($db,$query)) {
            
}
else{
    echo "query does not run".mysqli_error($db);
}