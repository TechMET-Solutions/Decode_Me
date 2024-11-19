<?php

namespace App\Helpers;

use App\Models\AdminSetting;
use App\Models\Customer;
use App\Models\PrivacyPolicy;
use Exception;
use Illuminate\Http\Response;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class AppHelpers
{
    public static function sendMail($sub, $viewBody, $receiver_email)
    {
        if ($receiver_email == null || $receiver_email == "") {
            return;
        }
        $mail = new PHPMailer();
        try {
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = "mailhog";
            $mail->Host = "1025";
            $mail->Username = "support@prashnamanjusha.com";
            $mail->Password = "supportPM@183";
            $mail->setFrom("support@prashnamanjusha.com");
            $mail->addAddress($receiver_email);
            $mail->Subject = $sub;
            $mail->AltBody = $viewBody;
            $mail->MsgHTML($viewBody);
            $mail->isHTML(true);
            $mail->send();
        } catch (Exception $e) {
        }
    }

    public static function sendNotification($token, $title, $body, $image)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $notification = array('title' => $title, 'body' => $body);
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAASeWm61E:APA91bH5Ezw16PFrWRrH7uOr--5szbrp8xB0CeYg3iZhXFcO_4RXCButHH0fjP4ISguw4ZUJG6aEcLGXIk01wpk9E7mL9nzLJEknkgdyK3uI8u_0JE7c5L6axyQvX4kf8hsVbOJzeIzj';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if ($response === false) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    // Send to all User
    public static function sendAll($title, $body)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $notification = array('title' => $title, 'body' => $body);
        $arrayToSend = array('to' => '/topics/all', 'notification' => $notification, 'priority' => 'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAASeWm61E:APA91bH5Ezw16PFrWRrH7uOr--5szbrp8xB0CeYg3iZhXFcO_4RXCButHH0fjP4ISguw4ZUJG6aEcLGXIk01wpk9E7mL9nzLJEknkgdyK3uI8u_0JE7c5L6axyQvX4kf8hsVbOJzeIzj';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        if ($response === false) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }

    public static function sendResponse($result = [], $msg = null, $status_code = null)
    {
        return response()->json([
            'result' => $result,
            'message' => $msg,
        ], $status_code);
    }





    // public static function uploadImage($image, $path)
    // {
    //     $image_name = time() . '.' . $image->getClientOriginalExtension();
    //     $image->move(public_path($path), $image_name);
    //     return $image_name;
    // }

    function toRoman($number)
    {
        $map = [
            1 => 'i',
            4 => 'iv',
            5 => 'v',
            9 => 'ix',
            10 => 'x',
            40 => 'xl',
            50 => 'l',
            90 => 'xc',
            100 => 'c',
        ];

        $result = '';

        foreach (array_reverse(array_keys($map)) as $value) {
            while ($number >= $value) {
                $result .= $map[$value];
                $number -= $value;
            }
        }

        return $result;
    }
}
