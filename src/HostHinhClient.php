<?php


namespace HostHinh;

class HostHinhClient {

    private static $defaultTimeout = 180; //default timeout
    public static $defaultUrl = 'https://hosthinh.com/image-api';
    private static $apiKey = '';
    private static $apiSecret = '';

    public static function init($key, $secret) {
        self::$apiKey = $key;
        self::$apiSecret = $secret;
    }

    public static function upload($file,$title='',$isPrivate=false,$password='') {
        $timestamp = date('YmdHis');

        $sign = hash('sha1',self::$apiKey . '-' . $timestamp . '-' . self::$apiSecret);

        $content = file_get_contents($file);
        $base64Content = base64_encode($content);

        $response = self::post([
            'api_key' => self::$apiKey,
            'time' => $timestamp,
            'sign' => $sign,
            'title' => $title,
            'private' => $isPrivate,
            'password' => $password,
            'content' => $base64Content
        ]);

        if ($response) {
            return json_decode($response,true);
        }
        else {
            return false;
        }
    }

    private static function post($data = [], $url = false) {
        if ($url === false) $url = self::$defaultUrl;

        $response = self::sendJsonRequest($data,$url,[
            'method' => 'post'
        ]);

        return $response;
    }

    /***
     * @param $request
     * @param $url
     * @param bool $options (key value)
     *      method: post,get...
     * @return bool|string
     */
    private static function sendJsonRequest($request, $url, $options = false, $headers = false) {

        if (!isset($options['method'])) $options['method'] = self::$defaultMethod;
        if (!isset($options['timeout'])) $options['timeout'] = self::$defaultTimeout;
        $post = strtolower($options['method']) == 'post' ? 1 : 0;
        $timeout = $options['timeout'];

        $payload = json_encode($request);

        if ($post) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, $post);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
        else {
            $params = [];
            foreach ($request as $param=>$value) {
                $params[] = $param . '=' . urlencode($value);
            }
            $paramUrl = implode('&',$params);

            $ch = curl_init($url . '?' . $paramUrl);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); //timeout in seconds

        if (is_array($headers)) {
            foreach ($headers as $header => $value) {
                curl_setopt($ch, $header, $value);
            }
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return false;
        }
        else {
            curl_close($ch);
        }

        return $response;
    }
}