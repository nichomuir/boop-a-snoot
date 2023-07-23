<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <div class="logo"><img src="../images/logo.png" height="100px;"></div>
    <div id="main">
            <span class="title"><strong><p>Leaderboard</p></strong></span>
            <br><br>
            <div id="leaderboard-container">
            <table id="leaderboard">
                <tr id="leaderboard-header">
                    <th>Rank</th>
                    <th>Username</th>
                    <th>High Score</th>
                </tr>
                <?php
                //connect to db
                require('../../../mysqli_connect.php');
                
                // Define the query:
                $q = "SELECT username, high_score FROM player_info ORDER BY high_score DESC LIMIT 10";
                
                // Run the query.
                $result = @mysqli_query($dbc, $q); 

                //initialize rank
                $rank = 1;
  
                //access each row from query
                if (mysqli_num_rows($result)) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr><th>{$rank}</th>
                        <td>{$row['username']}</td>
                        <td>{$row['high_score']}</td><tr>";
                        $rank++;
                    }
                }
                
                //session_start();
                if (isset($_SESSION["user_id"])) {
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
            </table>
            </div>
    </div>
    <br>
    <div class="link-container">
    <?php 
        if (isset($user)) {
            echo "<span><p class='link-item'>Your current High Score is: " .  htmlspecialchars($user['high_score']) . "</p></span>";
        }
    ?>
        <span><a href="../index.php"><p class="link-item">Return to Homepage</p></a></span>
    </div>
    
    <script src=""></script>

</body>
</html>