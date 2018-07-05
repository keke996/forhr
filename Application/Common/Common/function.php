<?php
function xxl($a){
    echo"<pre>";
    print_r($a);
    echo"</pre>";
}


function isadmin(){
    if($_SESSION['login']['isadmin']!=1){
        return false;
    }else{
        return true;
    }
}


function excelTime($date, $time = false) {
    if(function_exists('GregorianToJD')){
        if (is_numeric( $date )) {
        $jd = GregorianToJD( 1, 1, 1970 );
        $gregorian = JDToGregorian( $jd + intval ( $date ) - 25569 );
        $date = explode( '/', $gregorian );
        $date_str = str_pad( $date [2], 4, '0', STR_PAD_LEFT )
        ."-". str_pad( $date [0], 2, '0', STR_PAD_LEFT )
        ."-". str_pad( $date [1], 2, '0', STR_PAD_LEFT )
        . ($time ? " 00:00:00" : '');
        return $date_str;
        }
    }else{
        $date = $date > 25568 ? $date+1 : 25569;
        /*There was a bug if Converting date before 1-1-1970 (tstamp 0)*/
        // $ofs=(70 * 365 + 17+2) * 86400;
        $ofs=2209161600;
        $date = date("Y-m-d",($date * 86400) - $ofs).($time ? " 00:00:00" : '');
    }
  return $date;
}
?>