<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    
echo phpinfo();
    //return $app->version();
});

$app->group([
	'prefix' => 'api/clients',
	'namespace' => 'App\Http\Controllers'
], function () use ($app) {
	$app->get('', 'ClientsControllers@index');
	$app->get('{id}', 'ClientsControllers@show');
	$app->post('', 'ClientsControllers@store');
	$app->put('{id}','ClientsControllers@update');
	$app->delete('{id}', 'ClientsControllers@destroy');
});

$app->group([
	'prefix' => 'api/clients/{client}/addresses',
	'namespace' => 'App\Http\Controllers'
	], function () use ($app) {
	$app->get('','AddressesController@index');
	$app->get('{id}', 'AddressesController@show');
	$app->post('', 'AddressesController@store');
	$app->put('{id}','AddressesController@update');
	$app->delete('{id}','AddressesController@destroy');
});

/*
$uri = 'http://son-soap.dev:8000';
$app->get('son-soap.wsdl', function () use ($uri) {
	$autoDiscover = new \Zend\Soap\AutoDiscover();
	$autoDiscover->setUri("$uri/server");
	$autoDiscover->setServiceName('WEB_SERVER_SOAP');
	$autoDiscover->addFunction('soma');
	$autoDiscover->handle();
});

$app->post('server', function () use ($uri) {
	$server = new \Zend\Soap\Server("$uri/son-soap.wsdl",[
		'cache_wsdl' => WSDL_CACHE_NONE
	]);
	$server->setUri("$uri/server");
	return $server
		->setReturnResponse(true)
		->addFunction('soma')
		->handle();

});

$app->get('soap-test',function () use ($uri) {
	$client = new \Zend\Soal\Client("$uri/son-soap.wsdl",[
		'cache_wsdl' => WSDL_CACHE_NONE
	]);

	//print_r($client->soma(100,200));
});

//SOAP SERVER com CLIENT
$uriClient = "$uri/client";
$app->get('client/son-soap.wsdl', function () use ($uriClient){
	$autoDiscover = new \Zend\Soap\AutoDiscover();
	$autoDiscover->setUri("$uriClient/server");
	$autoDiscover->setServiceName('WEB_SERVER_SOAP');
	$autoDiscover->addFunction('soma');
	$autoDiscover->handle();
});

$app->post('client/server', function () use ($uriClient){
	$server = new \zend\Soap\Server("$uriClient/son-soap.wsdl", [
		'cache_wsdl' => WSDL_CACHE_NONE
	]);
	$server->setUri("uriClient/server");
	return $server
		->setReturnResponse(true)
		->setClass(\App\Soap\ClientsSoapController::class)
		->handle();
});

$app->get('soap-client', function () use ($uriClient) {
	$client = new \Zend\Soap\Client("$uriClient/son-soap.wsdl",[
		'cache_wsdl' => WSDL_CACHE_NONE
	]);

	print_r($client->create([
		'name' 	=> 'Onesimo Batista',
		'email' => 'onesimobatista@gmail.com',
		'phone' => '777'
	]));
});

function soma($num1, $num2)
{
	return $num1 + $num2;
}
*/