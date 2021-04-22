<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $amount = $_POST["amount"];
    if (empty($_POST["name"])) {  
        $_SESSION['errorMess'] = "Error! You didn't enter the Name.";    
    } 
    else if($_SESSION['login_user'] != $_POST['name']) {  
        $_SESSION['errorMess'] = "Username is not matching!";  
    }
    else if (empty($_POST["amount"])) {  
        $_SESSION['ErrorMess'] = "Error! Amount is not Entered";    
    }  
    else if (!preg_match ("/^[0-9]*$/", $amount) ){  
        $_SESSION['ErrorMess'] = "Amount must be numbers!";  
    }
    else{
        $userID = $_SESSION['userID'];
        $sql = "UPDATE users SET card_balance = card_balance + $amount where userID = $userID";
            $status = mysqli_query($db, $sql);

            if(!$status){
                die('Could not update data: ' . mysqli_error());
            }
            else{
                //echo "Updated data successfully\n";
                mysqli_close($db);
                //header("location: recharge.php");
                
            }
    }
}

header("location: recharge.php");
?>