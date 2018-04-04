<?php
/**
 * Description of Validation Methods
 *
 * @author Adedayo Akinpelu <adedayoakinpelu@gmail.com>
 */
class Options
{
    public $ci;
    public static $_subscriber = "subscribers";

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function curl($url, $username = '', $password = '') 
    {
        $ch = curl_init();
        $content_header = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $content_header);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, false);

        if (!empty($username) && !empty($password))
        {
            curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        }

        $tmp_output = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return array(
            'body' => $tmp_output,
            'code' => $http_code
        );
    }

    public function validate_email($email_address)
    {
        if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) return true; 
    }

    public function validate_email_domain($email_address)
    {
        $domain = explode("@", $email_address, 2);
        return checkdnsrr($domain[1]);
    }

    public function is_complete_user_profile(array $user_profile)
    {
        if (!isset($user_profile['email_address']) || empty($user_profile['email_address'])) return true;
        if (!isset($user_profile['name']) || empty($user_profile['name'])) return true;
        if (!isset($user_profile['state']) || empty($user_profile['state'])) return true;

        return false;
    }

    public static function phone_number_sanitizer($phone_number, $zip, $plus = false)
    {
        $phone_number = trim($phone_number);

        $phone_number = str_replace('+', '', $phone_number);

        if (preg_match('/^'.$zip.'/i', $phone_number) == true) {

            $phone_number = '0' . substr($phone_number, 3);

        }

        if (strlen($phone_number) == 11) {

            $phone_number = $zip . substr($phone_number, 1);

        }
        else {

            if (strpos($phone_number, '+') == false) {

                $phone_number = '+' . $phone_number;

            }

        }

        if ($plus == false) {

            $phone_number = str_replace('+', '', $phone_number);

        }

        return $phone_number;
    }

    
}