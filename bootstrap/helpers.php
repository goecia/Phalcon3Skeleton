<?php

if (!function_exists("validate_ip")) {
    function validate_ip($ip)
    {
        return preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/", $ip);
    }
}

if (!function_exists("get_current_client_ip")) {
    function get_current_client_ip()
    {
        if (isset($_SERVER['HTTP_TRUE_CLIENT_IP']) && !empty($_SERVER['HTTP_TRUE_CLIENT_IP'])) {
            return $_SERVER['HTTP_TRUE_CLIENT_IP'];
        }

        // Check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // Check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Check if multiple IP addresses exist in var
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ipList[count($ipList) - 1]);
        }

        if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED'])) {
            return $_SERVER['HTTP_X_FORWARDED'];
        }

        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        }

        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_FORWARDED_FOR'];
        }

        if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED'])) {
            return $_SERVER['HTTP_FORWARDED'];
        }

        // Return unreliable IP address since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }
}

if (!function_exists("get_profile")) {
    function get_profile()
    {
        global $app;
        $params = $app->request->get();

        // Set profile to boolean value.
        if (!isset($params['profile']) || empty($params['profile']) || strtolower($params['profile']) == "false") {
            return false;
        }

        return true;
    }
}

if (!function_exists("get_request_params")) {
    function get_request_params()
    {
        global $app;
        $params = $app->request->get();

        // Remove Phalcon's auto injected "_url" param.
        if (array_key_exists("_url", $params)) {
            unset($params['_url']);
        }

        return $params;
    }
}

if (!function_exists("get_url_action")) {
    function get_url_action() {
        global $app;
        $urlAsArray = explode("/", $app->getRouter()->getRewriteUri());
        return end($urlAsArray);
    }
}

if (!function_exists("convert_to_boolean")) {
    function convert_to_boolean($value) {
        if (!isset($value) || empty($value) || strtolower($value) == "false") {
            return false;
        } else {
            return true;
        }
    }
}
