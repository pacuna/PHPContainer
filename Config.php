<?php

Class Config {
    public static function load($filename){
        $data = include($filename);
        return $data;
    }
}
