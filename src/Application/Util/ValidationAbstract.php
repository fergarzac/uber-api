<?php
namespace App\Application\Util;


abstract class ValidationAbstract
{

    abstract protected function getValidskeys();
    abstract protected function getIdKey();

    public function validateId($key = '') {
        return $this->getIdKey === $key;
    }

    public function validateArray($array = []) {
        $not_found = true;
        if(sizeof($array) > 0) {
            $keys = $this->getValidskeys();
            if(is_array($keys)) {
                foreach($keys as $k) {
                    if(!array_key_exists($k, $array)) {
                        $not_found = false;
                    }
                }
                return $not_found;
            }
            return false;
        }
        
        return false;
    }
}