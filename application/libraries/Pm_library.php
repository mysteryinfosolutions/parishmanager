<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pm_library {
    
       /* ------------------ Start internet check ------------------ */

    public function checkInternetConnection($website = 'www.google.com', $port = '80') {
        if ($port) {
            $internetconnected = @fsockopen($website, $port);
        } else {
            $internetconnected = @fsockopen($website);
        }

        //website, port  (try 80 or 443)
        if ($internetconnected) {
            $is_conn = true; //action when connected
            fclose($internetconnected);
        } else {
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }

    /* ------------------ end internet check ------------------ */
    
    
}
