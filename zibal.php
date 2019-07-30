<?php
    /**
     * connects to zibal's rest api
     * @author Mohammad Zamanzadeh
     * @param $path
     * @param $parameters
     * @return \stdClass
     */
    function sendRequestToZibal($path, $parameters, $apiKey)
    {
        $url = 'https://api.zibal.ir/v1/'.$path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer '.$apiKey
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);
        if($response==null)
            return (object)['message'=>'خطا در ارتباط با زیبال','result'=>-1];
        return json_decode($response);
    }



    //usage
    //gateway transactions report
    $parameters=[
	"size"=> 10,
	"page"=> 1,
	"merchantId"=> "GATEWAY_MERCHANT",
	"verbose"=> true,
	"mobile"=>"09121234562"
    ];
    $results = sendRequestToZibal("gateway/report/transaction",$parameters,"apiKey");
    var_dump($results);
