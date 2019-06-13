<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customlibrary {

    public function getpaddedindexdiocese($index, $length = 3) {
        $id = str_pad($index, $length, '0', STR_PAD_LEFT);
        return $id;
    }

    public function getpaddedindexparish($index, $length = 3) {
        $id = str_pad($index, $length, '0', STR_PAD_LEFT);
        return $id;
    }
    
    public function getpaddedindexregister($index, $length = 7) {
        $id = str_pad($index, $length, '0', STR_PAD_LEFT);
        return $id;
    }

}
