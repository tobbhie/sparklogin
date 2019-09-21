<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then send a Javascrit to redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo 'ALREADY_LOGGED_IN';
    //   header("location: welcome.php");
  exit;
}

 
// Define variables and initialize with empty values
$email = $password = $match = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter username or email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        
        //Get the JSON file
     $data = file_get_contents(__DIR__ . '/www/users.json'); 
     $data = json_decode($data, true);

     //Check for match
        if(is_array($data)){
            foreach($data as $row){
                if ($row['email'] === $email||$row['username'] === $email) {
                    $match = $row;                          //Store match
                    $hashed_password = $row['password'];    //Store Password
                    // We found a match so let's break the loop
                    break;
                }
             }  
         }else{
            $match = "";
         }
         if($match){
            if (password_verify($password, $hashed_password)){
                // Store the session
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $email;
                // Handles redirection
                echo 'LOG_IN';          
            }else{
                echo 'Invalid Password';
            }
         }else{
             echo 'Invalid Email or Password';
         }
    }else{
        echo 'OOPS';
    }
}
?>
