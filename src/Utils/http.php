<?php

namespace Nucleus\Utils;

class Http
{
    private $url;

    private $clientID;

    public function __construct($url, $clientID)
    {
        $this->url = $url;
        $this->clientID = $clientID;
    }

    public function updateURL($url) {
        $this->url = $url;
    }

    public function get($uri) {
        return $this->request('GET', $uri, null, $this->clientID);
    }

    public function post($uri, $data) {
        return $this->request('POST', $uri, $data, $this->clientID);
    }

    private function request($method, $uri, $data, $authorization)
    {
        if(is_array($data)){
            if($authorization) {
                $data["business_api_key"] = $authorization;
            }
        }
        $json = json_encode($data);
        $ch = curl_init($this->url . $uri);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        $header = [
            'Content-Type: application/json',
            "Authorization: Bearer {$authorization}",
            "User-Agent: NucleusSDK/1.0.0"
        ];
        if ($method != 'GET') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            $header[] = 'Content-Length: ' . strlen($json);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($err) {
            return $err;
        } else {
            if ($result) {
                return json_decode($result, true);
            }
            return $httpcode === 204;
        }
    }
}
