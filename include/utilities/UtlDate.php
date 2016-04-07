<?php

class UtlDate {

    private static $daysSp = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    private static $monthsSp = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    /**
     * Devuelve la fecha (o fecha/hora) en formato MySQL
     * @param $date String Fecha en formato dd/mm/YYYY [H:i:s]
     * @return String Fecha en formato MySQL
     */
    public static function toMySQLDateFormat($date) {
        $arr_date = explode(' ', $date);
        $arr_time = $arr_date[1];
        $arr_date = explode('/', $arr_date[0]);
        $mysql_date = $arr_date[2] . '-' . $arr_date[1] . '-' . $arr_date[0];
        if (strlen($arr_time) > 0)
            $mysql_date .= ' ' . $arr_time;
        return $mysql_date;
    }

    // Retorna en el formato especificado, la fecha dada agregandole los dias dados. $date viene el formato mysql.
    public static function addDays($date, $days, $format = 'Y-m-d') {
        try {
            $date = strtotime(date('Y-m-d', strtotime($date)) . " +$days day");
            $date = date($format, $date);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $date;
    }

    // Retorna en el formato especificado, la fecha dada restandole los dias dados. $date viene el formato mysql.
    public static function substractDays($date, $days, $format = 'Y-m-d') {
        try {
            $date = strtotime(date('Y-m-d', strtotime($date)) . " -$days day");
            $date = date($format, $date);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $date;
    }

    public static function getMonthNameEnglish($monthNumber, $short = false) {
        $month = '';
        try {
            $month = date('F', mktime(0, 0, 0, $monthNumber));
            if ($short)
                $month = substr($month, 0, 3);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $month;
    }

    public static function getMonthNameSpanish($monthNumber, $short = false) {
        $month = '';
        try {
            $month = ($short) ? substr(self::$monthsSp[$monthNumber - 1], 0, 3) : self::$monthsSp[$monthNumber - 1];
        } catch (Exception $ex) {
            throw $ex;
        }
        return $month;
    }

    public static function getDayNameEnglish($strDate, $short = false) {
        $day = '';
        try {
            if ($short)
                $day = date('D', strtotime($strDate));
            else
                $day = date('l', strtotime($strDate));
        } catch (Exception $ex) {
            throw $ex;
        }
        return $day;
    }

    public static function getDayNameSpanish($strDate, $short = false) {
        $day = '';
        try {
            $day = self::$daysSp[date('w', strtotime($strDate))];

            if ($short)
                $day = substr($day, 0, 3);
        } catch (Exception $ex) {
            throw $ex;
        }
        return $day;
    }

    public static function getDayMonthSufixEnglish($monthNumber) {
        $sufix = '';
        try {
            $sufix = date('S', mktime(0, 0, 0, $monthNumber));
        } catch (Exception $ex) {
            throw $ex;
        }
        return $sufix;
    }

    /**
     * @param string	$strDate	Should be in mysql format
     * @return array	Returns an array in the format: array(year, month, day).
     */
    public static function getYearMonthDay($strDate) {
        $data = array(0, 0, 0);
        try {
            $data = explode('-', substr($strDate, 0, 10));
        } catch (Exception $ex) {
            throw $ex;
        }
        return $data;
    }

    public static function getAge($strDate) {
        $yearDiff = 0;
        try {
            list($year, $month, $day) = explode('-', substr($strDate, 0, 10));
            $yearDiff = date('Y') - $year;
            $monthDiff = date('m') - $month;
            $dayDiff = date('d') - $day;
            if ($monthDiff < 0)
                --$yearDiff;
            else if (($monthDiff == 0) && ($dayDiff < 0))
                --$yearDiff;
        } catch (Exception $ex) {
            throw $ex;
        }
        return $yearDiff;
    }

    public static function isValidDate($strDate) {
        $valid = false;
        try {
            $dateArr = explode('-', substr($strDate, 0, 10));
            if (count($dateArr) == 3) {
                list($d, $m, $y) = $dateArr;
                $valid = checkdate($m, $d, $y) && strtotime("$y-$m-$d") && preg_match('#\b\d{2}[/-]\d{2}[/-]\d{4}\b#', "$d-$m-$y");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        return $valid;
    }

    public static function getDateMysqlLong($mysqlLongDateTime) {
        return str_replace("-", "/", current(explode(" ", $mysqlLongDateTime)));
    }

    public static function getMessageDate($date = 'now') {
        $time = strtotime($date);

        $diaSemana = self::getDayNameSpanish($date);
        $mesAnio = self::getMonthNameSpanish(date('m', $time));
        return $diaSemana . ' ' . date('d', $time) . ' de ' . $mesAnio . ' ' . date('H', $time).":".date('i', $time);
    }
    
    
    public static function formatFechaEdicion($fechaEdicion) {
        $diaSemana = self::getDayNameSpanish($fechaEdicion);
        $mesAnio = self::getMonthNameSpanish(date('m', strtotime($fechaEdicion)));
        return $diaSemana . ' ' . date('d', strtotime($fechaEdicion)) . ' de ' . $mesAnio . ' de ' . date('Y', strtotime($fechaEdicion));
    }

    public static function getDayNameByShortForm($shortForm) {
        switch ($shortForm) {
            case 'LUN':
                return 'Lunes';
            case 'MAR':
                return 'Martes';
            case 'MIE':
                return 'Miercoles';
            case 'JUE':
                return 'Jueves';
            case 'VIE':
                return 'Viernes';
            case 'SAB':
                return 'Sabado';
            case 'DOM':
                return 'Domingo';
        }
    }

    public static function getDayNumberByShortForm($shortForm) {
        switch ($shortForm) {
            case 'LUN':
                return 1;
            case 'MAR':
                return 2;
            case 'MIE':
                return 3;
            case 'JUE':
                return 4;
            case 'VIE':
                return 5;
            case 'SAB':
                return 6;
            case 'DOM':
                return 7;
        }
    }

    public static function getShortFormByDayNumber($dayNumber) {
        switch ($dayNumber) {
            case 1:
                return 'LUN';
            case 2:
                return 'MAR';
            case 3:
                return 'MIE';
            case 4:
                return 'JUE';
            case 5:
                return 'VIE';
            case 6:
                return 'SAB';
            case 7:
                return 'DOM';
        }
    }

}