<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $_SESSION['contact_success'] = "¡Gracias por tu mensaje, " . htmlspecialchars($name) . "! Nos pondremos en contacto contigo pronto.";


    header("Location: contact.php");
    exit();

} else {

    header("Location: index.php");
    exit();
}
?>