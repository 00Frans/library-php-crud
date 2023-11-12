<?php
$conn = new mysqli('localhost', 'root', '', 'library');

if (!$conn) {
    die(mysqli_error($conn));
}
?>