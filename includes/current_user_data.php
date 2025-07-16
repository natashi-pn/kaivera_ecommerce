<?php
if (isset($_SESSION['user_data'])) {
    $user_id = $_SESSION['user_data']['user_id'];
    $user_name = $_SESSION['user_data']['user_name'];
    $user_email = $_SESSION['user_data']['user_email'];
    $user_phone = $_SESSION['user_data']['user_phone'];
    $user_type =  $_SESSION['user_data']['user_type'];
    $user_profile_image = $_SESSION['user_data']['user_profile_image'];
} else {
    $user_id = null;
    $user_name = null;
    $user_email = null;
    $user_phone = null;
    $user_type =  null;
    $user_profile_image = null;
}
