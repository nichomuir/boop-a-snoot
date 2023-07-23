<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <div class="logo"><img src="../images/logo.png" height="100px;"></div>
    <div id="main">
        <div id="create-account">
            <form action="create-account.php" method="post" name="create-account" onsubmit="return(createAccountValidation());">
                <p><strong>Create Account</strong></p>
                <span id="req1" class="invisible">*</span>
                <input type="text" id="email" name="email" placeholder="Email" maxlength="150"><br><br>
                <span id="req2" class="invisible">*</span>
                <input type="text" id="username" name="username" placeholder="Username" maxlength="150"><br><br>
                <span id="req3" class="invisible">*</span>
                <input type="password" id="password" name="password" placeholder="Password"><br><br>
                <span class="invisible">*</span>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password"><br>
                <div id="req4" class="invisible"></div><br>
                <input type="submit" value="Confirm">
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            require('../../../mysqli_connect.php'); // Connect to the db.

            //create email variable
            $em = mysqli_real_escape_string($dbc, trim($_POST['email']));

            //create username variable
            $us = mysqli_real_escape_string($dbc, trim($_POST['username']));
        
            //create password variable
            $hashed_pa = password_hash($_POST["password"], PASSWORD_DEFAULT);
                
            //$pa = mysqli_real_escape_string($dbc, $hashed_pa);
    
            //initialize high_score
            $hs = 0;

            // Register the user in the database...

            // Make the query:
            $q = "INSERT INTO player_info (email, username, password, high_score, registration_date) VALUES ('$em', '$us', '$hashed_pa', '$hs', NOW())";
    
            try {
                // Run the query.
                $result = @mysqli_query($dbc, $q);
                //header("Location: account-created.html");
                echo "<script>window.location.href='account-created.html';</script>";
                mysqli_close($dbc);
            }
            //if email or username already exists, error 1062 will be thrown
            catch (Exception $e) {
                echo '<p id="exists" style="color:red;">*Email or username already exists.</p>';
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