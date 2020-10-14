<?php


namespace common\services;


use common\models\User;

class UserTransactionsService
{
    private $user;

    public function __construct($userId)
    {
        $this->user = User::findOne($userId);
    }

    public function getHistory()
    {
        return [];
    }

    public function expanse()
    {
        return [];
    }

    public function income()
    {
        return [];
    }

    private function getContent($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gateway.kassa24.kz",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => $xml,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

            echo "cURL Error #:" . $err;

        } else {

            $res = new \SimpleXMLElement($response);

            return $res->body;
        }
    }
}
