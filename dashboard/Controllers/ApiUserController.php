<?php
namespace Controllers;

require_once __DIR__ . '/../ApiServices/API.php';
use ApiServices\API;


class ApiUserController
{

    protected  $API;
    public function __construct()
    {
//        $api = new API();
        $this->API = new API();
    }

    public  function  checkKeyAndGenerate($key)
    {

        return $this->API->generateEmail($key);
    }

    public  function listMessages($key, $email)
    {

        return $this->API->listMessage($key, $email);

    }

    public  function showMessage($key, $id){
        return $this->API->message($key, $id);
    }

    public  function listEmailSave($key){

        return $this->API->listEmailSave($key);
    }

    public  function  saveEmail($key, $email){

        return $this->API->saveEmail($key, $email);
    }

    public  function  deleteEmailUser($key, $email){
        return $this->API->deleteEmail($key, $email);
    }

    public function news(){
        return $this->API->APINews();

    }

}


//$test = new ApiUserController();
//print_r($test->checkKeyAndGenerate());