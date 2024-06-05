<?php
function getUserID() {
    $userID = session_id().$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'];
    return md5($userID);
}
?>