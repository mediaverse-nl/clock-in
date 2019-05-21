<?php

if (!function_exists('MinToHumanHours')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function MinToHumanHours($time, $format = '%02d uur %02d min') {
        if ($time < 1) {
            return '0 min';
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
}
