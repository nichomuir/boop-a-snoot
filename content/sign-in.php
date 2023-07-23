<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <div class="logo"><img src="../images/logo.png" height="100px;"></div>
    <div id="main">
        <div id="sign-in">
            <form action="" method="post" name="sign-in" onsubmit="return(signInValidation());">
                <p><strong>Sign In</strong></p>
                <span id="req1" class="invisible">*</span>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="150"><br><br>
                <span id="req2" class="invisible">*</span>
                <input type="password" id="password" name="password" placeholder="Password"><br><br>
                <input type="submit" value="Sign In">
            </form>
            <?php
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            try{
                require('../../../mysqli_connect.php'); // Connect to the db.
            }
            catch (Exception $e){

            }

            //create email/username variable
            $em = mysqli_real_escape_string($dbc, trim($_POST['email']));
        
            //create password variable
            //$pa = mysqli_real_escape_string($dbc, trim($_POST['password']));

            // Make the query:
            $q = "SELECT * FROM player_info WHERE email = '$em'";
                
                
            try {
                // Run the query.
                $result = @mysqli_query($dbc, $q);

                //if email is found in table, store all player information in "user" variable
                $user = $result->fetch_assoc();

                //check if password matches the user/email
                if ($user) {
                    if(password_verify($_POST['password'], $user["password"])) {
                        try {
                            $_SESSION["user_id"] = $user["user_id"];
                            //header("Location: ../index.php");
                            echo "<script>window.location.href='../index.php';</script>";
                        }
                        catch (Exception $e) {
                        }
                    }
                }
                echo '<p id="exists" style="color:red;">*Login Invalid.</p>';
            }
            //if email or username already exists, error 1062 will be thrown
            catch (Exception $e) {
                echo '<p id="exists" style="color:red;">*Login Invalid.</p>';
            }
        
            mysqli_close($dbc); // Close the database connection.
            
            }   
            ?>
        </div>
    </div>
    <br>
    <span class="link-container"><a href="../index.php"><p>Return to Homepage</p></a></span>
    
    <script src="../js/validation.js"></script>

</body>
</html>