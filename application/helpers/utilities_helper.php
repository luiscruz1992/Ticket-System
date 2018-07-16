<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilities_helper
 *
 * @author eren
 */

/**
 * Remove <br/> in string
 * @param type $string
 * @return type
 */
function br2nl($string) {
    $text = preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n", "", str_replace("\r", "", htmlspecialchars_decode($string))));
    return $text;
}

/**
 * Get new format by date time
 * @param type $dateTime
 * @param type $fotmat
 * @return type
 */
function dateTimeFormat($dateTime, $fotmat) {
    $date = str_replace('/', '-', $dateTime);
    return date($fotmat, strtotime($date));
}
