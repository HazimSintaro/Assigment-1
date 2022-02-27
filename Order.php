<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include orderProc.php file
include __DIR__ . '/function/orderProc.php';

//read table order
$app->get('/order', function (Request $request, Response $response, array
$arg){
return $this->response->withJson(array('data' => 'success'), 200);
});

// read all data from table order
$app->get('/allorder',function (Request $request, Response $response,
array $arg)
{
$data = getAllorder($this->db);
if (is_null($data)) {
return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404);
}
return $this->response->withJson(array('data' => $data), 200);
});


//request table sample_data by condition (order id)
$app->get('/order/[{id}]', function ($request, $response, $args){
$ID = $args['id'];
if (!is_numeric($ID)) {
return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
}
$data = getorder($this->db,$ID);
if (empty($data)) {
return $this->response->withJson(array('error' => 'no data'), 500);
}
return $this->response->withJson(array('data' => $data), 200);
});

//add new order in sample_data
$app->post('/order/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createorder($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
    );


//delete row
$app->delete('/order/del/[{id}]', function ($request, $response, $args){
    $ID = $args['id'];
    if (!is_numeric($ID)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
    }
    $data = deleteorder($this->db,$ID);
    if (empty($data)) {
    return $this->response->withJson(array($ID=> 'is successfully deleted'), 202);};
    });
    
//put table products
$app->put('/order/put/[{id}]', function ($request, $response, $args){
    $ID = $args['id'];

    $date = date("Y-m-j h:i:s");

    if (!is_numeric($ID)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
    }

    $form_dat=$request->getParsedBody();
    $data=updateorder($this->db,$form_dat,$ID,$date);
    if ($data <=0)
    return $this->response->withJson(array('data' => 'successfully updated'), 200);
});