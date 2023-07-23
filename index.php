<?php
session_start();
if (isset($_SESSION["user_id"])) {
    require('../../mysqli_connect.php');
    $q = "SELECT * FROM player_info WHERE user_id = {$_SESSION["user_id"]}";
    try {
        // Run the query.
        $result = @mysqli_query($dbc, $q);
        $user = $result->fetch_assoc();
    }
    catch (Exception $e) {
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Boop-A-Snoot</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="logo"><img src="images/logo.png" height="100px;"></div>
    <div id="main">
        <div class="title">
            <span><strong><p>Score: &nbsp;</p></strong></span>
            <span class="padding-right"><strong><p id="score-display">0</p></strong></span>
            <span><strong><p>Time Remaining: &nbsp;</p></strong></span>
            <span><strong><p id="timer-display">10</p></strong></span>
        </div>
    
        <div id="grid"></div><br>
        
        <span><button type="button" onclick="startNewGame()">Start New Game</button></span><br>
    
        <span id="final-score"></span>
    </div>
    <br>
    <div class="link-container">
        <?php 
        if (isset($user)) {
            echo "<span><p class='link-item'>Welcome, " .  htmlspecialchars($user['username']) . "!</p></span>";
            echo '<span><a href="content/logout.php"><p class="link-item">Logout</p></a></span>';
        }
        else {
            echo '<span><a href="content/sign-in.php"><p class="link-item">Sign In</p></a></span><span><a href="content/create-account.php"><p class="link-item">Create Account</p></a></span>';
        }
        ?>
        <span><a href="content/leaderboard.php"><p class="link-item">Leaderboard</p></a></span>
        <audio id="player" controls><source src="audio/executive-lounge.mp3" type="audio/mpeg"></audio>
    </div>
    
    <script>
        let audio = document.getElementById("player");
        audio.volume = 0.4;
    </script>
    
    <script src="js/app.js"></script>

</body>
</html>