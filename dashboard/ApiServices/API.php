<?php

namespace ApiServices;

error_reporting(0);
require_once  __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class API
{
    Protected $url;
    public function __construct()
    {
        $dotEnv = Dotenv::createImmutable(__DIR__ . '/../')->load();
        $this->url = $dotEnv['API_DOMAIN'];
    }

    public function generateEmail($key)
    {
        $curl = curl_init();
        $URL = $this->url."api/generate-email";
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"key\" : \"$key\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 401){
            return  $httpcode;
            exit();
        }elseif($httpcode == 400) {
            return  $httpcode;
            exit();
        }
        $jsonDecode = json_decode($response);
        return $jsonDecode;
    }


    public  function listMessage($key, $email)
    {
        $URL = $this->url."api/inbox";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"key\" : \"$key\",\n\t\"email\" : \"$email\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode == 401){
            return  $httpcode;
            exit();
        }elseif($httpcode == 400) {
            return  $httpcode;
            exit();
        }
        $jsonDecode = json_decode($response);
        return $jsonDecode;
    }


    public  function message($key, $id)
    {
        $URL = $this->url."api/message";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"key\" : \"$key\",\n\t\"id\" : \"$id\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }


    public  function listEmailSave($key)
    {
        $curl = curl_init();
        $URL = $this->url."api/list-email";
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "key-host: $key"
            ],
        ]);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);
        curl_close($curl);
            if($httpcode == 401){
                return  $httpcode;
                exit();
                }elseif($httpcode == 400) {
                        return  $httpcode;
                        exit();
            }
            $jsonDecode = json_decode($response);
            return $jsonDecode;
    }


    public  function  saveEmail($key, $email)
    {
        $URL = $this->url."api/save-email";
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"key\" : \"$key\",\n\t\"email\" : \"$email\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $jsonDecode = json_decode($response);
        return $jsonDecode;
    }

    public  function  deleteEmail($key, $email)
    {

        $URL = $this->url."api/delete-email";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"key\" : \"$key\",\n\t\"email\" : \"$email\"\n}",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $jsonDecode = json_decode($response);
        return $jsonDecode;
    }

    public function APINews(){
        
        $URL = $this->url."api/news";
        $curl = curl_init();
            curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            $json = \json_decode($response);
            return $json;
    }

}
