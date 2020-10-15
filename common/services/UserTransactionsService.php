<?php


namespace common\services;


use common\models\User;

class UserTransactionsService
{
    private $user;

    const TRANSACTION_TYPE_EXPENSE = 1;
    const TRANSACTION_TYPE_INCOME = 2;

    private static $transactionTypes = [
        self::TRANSACTION_TYPE_EXPENSE => 'Вывод средств',
        self::TRANSACTION_TYPE_INCOME => 'Добавление средств средств',
    ];

    public function __construct($userId)
    {
        $this->user = User::findOne($userId);
    }

    public static function getType($typeId)
    {
        return self::$transactionTypes[$typeId];
    }

    /**
     * @return array
     */
    public function getHistory()
    {
        $history = $this->getContent('/history/' . $this->user->id, 'GET');
        return $history;
    }

    /**
     * Вывод средств из счёта
     *
     * @param $toUserId
     * @param $sum
     * @return array
     */
    public function expense($toUserId, $sum)
    {
        if ($toUserId == 0) {
            $toUserId = $this->user->id;
        }
        $params = [
            'userId' => $this->user->id,
            'toUserId' => $toUserId,
            'sum' => $sum
        ];

        $expense = $this->getContent('/expense/', 'POST', $params);

        return $expense;
    }

    /**
     * Добавление средств на счёт
     *
     * @param $toUserId
     * @param $sum
     * @return array
     */
    public function income($toUserId, $sum)
    {
        if ($toUserId == 0) {
            $toUserId = $this->user->id;
        }
        $params = [
            'userId' => $this->user->id,
            'toUserId' => $toUserId,
            'sum' => $sum
        ];

        $income = $this->getContent('/income/', 'POST', $params);

        return $income;
    }

    /**
     * @param $url
     * @param $method
     * @param array $params
     * @return array
     */
    private function getContent($url, $method, $params = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => \Yii::$app->params['api'] . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            return [
                'success' => !isset($response['errorText']['error']),
                'data' => isset($response['errorText']['error']) ? [] : $response['data'],
                'error' => isset($response['errorText']['error']) ? $response['errorText']['error'] :  [],
            ];
        }
    }
}
