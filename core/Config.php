<?php 

namespace Apps;

class Config {
    function load_env_file($env_file_name) {
        $filename = "./".$env_file_name;
        if(is_readable($filename)){
            $handle = fopen($filename, "r" );
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $entry = explode('=',$line,2);
                    $entry[0] = trim($entry[0]);
                    if(count($entry) > 1){
                        $entry[1] = trim($entry[1]);
                        if($entry[1][0] === "\""){
                            $entry[1] = substr($entry[1],1);
                        }
                        if($entry[1][strlen($entry[1])-1] === "\""){
                            $entry[1] = substr($entry[1],0,strlen($entry[1])-1);
                        }
                    }
                    if(!defined($entry[0])){
                        define($entry[0], count($entry) > 1 ? $entry[1] : null);
                    }
                }
                fclose($handle);
            }

        }
    }
}