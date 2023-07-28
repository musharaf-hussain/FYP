<?php
session_start();

include('./connection.php');
include('./env.php');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
if(isset($_GET['user_id']) && isset($_GET['type']) && $_GET['user_id']!='' && $_GET['type']!=''){
   
    $user_id = $_GET['user_id'];
    $type = $_GET['type'];
    $time = getCurrentDate();
    
   
    $column = $type=='check_in' ? 'check_in' : 'check_out';
    
        $currentDate = '2023-07-25';

        $getSql = "SELECT * FROM attendences WHERE user_id='$user_id'";
        $d = mysqli_query($conn, $getSql);
        
        $isCheckIn = false;
        $checkOut = null;
        while($row = mysqli_fetch_assoc($d)) {
          
            if(getJustDate($row['check_in']) == getJustDate($time))
            {
               $isCheckIn = true;
               $checkOut = $row['check_out'];
            }
        }
        if($isCheckIn){
            if($type=='check_out' && !$checkOut){
                $auth =  $_SESSION['auth'];
                $id = $auth['id'];
                $sql = "update attendences set check_out = '$time' where user_id = '$id' AND check_out IS NULL";
                mysqli_query($conn, $sql);
            }

        }else {
            $auth =  $_SESSION['auth'];
            $id = $auth['id'];
            $sql = "insert into attendences (check_in,user_id,check_out) values('$time','$id',NULL) ";
            mysqli_query($conn, $sql);
        }

        

        
    

    /**
     * check out time
     */
    // if ($type == 'check_out') {
    //     $currentDate = date('Y-m-d');
    //     echo $currentDate;
    //     $getSql = "SELECT * FROM attendences WHERE DATE('check_in')  = '$currentDate' AND user_id='$user_id'";
    //     $d = mysqli_query($conn, $getSql);
    //     echo mysqli_num_rows($d);
    //     die();
    //     if (mysqli_num_rows($d) > 0) {

    //       $row = mysqli_fetch_assoc($d);
    //       echo $row['check_out'];
    //       die();
    //       if(!$row['check_out']){
     
    //             $auth =  $_SESSION['auth'];
    //             $id = $auth['id'];
    //             $sql = "update attendences (check_out) values('$time') where user_id = '$id' ";
    //             mysqli_query($conn, $sql);
    //       }
    //     }
    // }
    

}
header('Location:'. $baseUrl.'?attendence='.$type.'');
function getJustDate($format){

    // Create a DateTime object from the datetime string
    $dateTime = new DateTime($format);

    // Get the date part as a string in 'Y-m-d' format
    $dateOnly = $dateTime->format('Y-m-d');
    return $dateOnly;
}
function getCurrentDate()
{
    // Set the timezone to Pakistan, Karachi
    $timezone = new DateTimeZone('Asia/Karachi');
    $dateTime = new DateTime('now', $timezone);

    // Format the date in 24-hour format
    $currentDate = $dateTime->format('Y-m-d H:i'); // Format: YYYY-MM-DD HH:mm:ss
    return $currentDate;
}
?>