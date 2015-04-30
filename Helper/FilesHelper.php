<?php

namespace Helper;

class FilesHelper{
    public static function readJSONFile($filename){
        return json_decode(
            file_get_contents(realpath($filename)),
            true
        );
    }
}