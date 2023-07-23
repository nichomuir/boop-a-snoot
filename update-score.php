<?php

$score = $_POST['score'];

session_start();

if (isset($_SESSION["user_id"])) {
    require('../../mysqli_connect.php');
    $q = "UPDATE player_info SET high_score = CASE WHEN high_score < $score THEN $score ELSE high_score END WHERE user_id = {$_SESSION["user_id"]}";
    try {
        // Run the query.
        $result = @mysqli_query($dbc, $q);
    }
    catch (Exception $e) {
    }
}