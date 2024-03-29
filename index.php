<html>
<body background='img/me.jpg'>
<?php
#require_once __DIR__ . '/facebook/autoload.php';
session_start();

require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/Entities/SignedRequest.php');
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookSignedRequestFromInputHelper.php');
require_once( 'Facebook/FacebookCanvasLoginHelper.php');
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookOtherException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/GraphUser.php');
require_once( 'Facebook/GraphSessionInfo.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

$facebook = FacebookSession::setDefaultApplication('727092907434360','c67e09be0ca2199cf4da15486f074fd2');
$helper = new FacebookCanvasLoginHelper();

try {
	$session = $helper->getSession();
} catch (FacebookRequestException $ex) {
	echo $ex->getMessage();
} catch (\Exception $ex) {
	echo $ex->getMessage();
}
if ($session) {
	try {
		 $request = new FacebookRequest($session, 'GET', '/me');
		 $response = $request->execute();
		 $me = $response->getGraphObject();
		 echo $me->getProperty('name');
		 
		 $message = array(
			'source' => new CURLFile('img/me.jpg' , 'image/jpg')
		);		

		# $WallPost = new FacebookRequest($session, 'POST', '/me/feed', array('message'=>'Posting text from app'));
		# $Postresponse = $WallPost->execute();

		} catch(FacebookRequestException $e) {
		echo $e->getMessage();
	}
} else {
	$helper = new FacebookRedirectLoginHelper('https://apps.facebook.com/getting_meaty/');
	$auth_url = $helper->getLoginUrl(array('email'));
	echo "<script>window.top.location.href='".$auth_url."'</script>";
}
?>
</body>
</html>
