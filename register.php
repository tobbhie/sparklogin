<?php
 
// Define variables
$username = $name = $password = $email = $match = $matchu = "";
$username_err = $name_err = $password_err = $email_err = $confirm_password_err = "";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

     //Get the JSON file
     $data = file_get_contents(__DIR__ . '/www/users.json'); 
     $data = json_decode($data, true);
     $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL); //Remove nonesense characters
     $username = trim($_POST["username"]);

     if(is_array($data)){
        foreach($data as $row){
            if ($row['email'] === $email) {
                $match = $row;
                // We found a match so let's break the loop
                break;
            }
         }  
     }else{
        $match = "";
     }
     if(is_array($data)){
        foreach($data as $row){
            if ($row['username'] === $username) {
                $matchu = $row;
                // We found a match so let's break the loop
                break;
            }
         }  
     }else{
        $matchu = "";
     }
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //check for correct email format
        $email_err = "Please enter a valid email.";
    }else if($match){              // Check JSON file for non repition of email
                echo 'Email Exist, login with existing email';
                $email_err = "Email Exist";
    }else if ($match === ""){
                $email = trim($_POST["email"]);
    }else {
        $email = trim($_POST["email"]);
    }

    //Validate Name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a Name.";     
    }else if(!filter_var($_POST["name"], FILTER_SANITIZE_STRING)){ //Filter through name
        $name_err = "Please use a valid name.";
    }else{
        $name = trim($_POST["name"]);
    }

     //Validate UserName
     if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a Userame.";     
    }else if(!filter_var($_POST["username"], FILTER_SANITIZE_STRING)){ //Filter through name
        $username_err = "Please use a valid name.";
    }else if($matchu){              // Check JSON file for non repition of username
        echo 'Username Exist, try another';
        $username_err = "User Exist";
    }else{
        $username = trim($_POST["username"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["repeatpassword"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["repeatpassword"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($password_err) && empty($email_err) && empty($confirm_password_err) && empty($username_err)){
        
        // Insert the details into json
        if(isset($_POST['submit'])){
            $data = file_get_contents(__DIR__ . '/www/users.json'); 
            $data_array = json_decode($data);
            //data in our POST
            $input = array(
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) // Creates a password hash
            );
            //append the POST data
            $data_array[] = $input;
            //return to json and put contents to our file
            $data_array = json_encode($data_array, JSON_PRETTY_PRINT);
            file_put_contents(__DIR__ . '/www/users.json', $data_array);

            //Session Store
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            
            //Response Sent to Javascript
            echo 'REGD_SUCCESS';
        }
        else{
            echo 'An error occured, submit again';
        }   
    }
}
?>