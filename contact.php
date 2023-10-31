<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Compila tutti i campi obbligatori e inserisci un indirizzo email valido.";
        exit;
    }

    $recipient = "sigmundmanfroid@gmail.com";
    $subject = "Nuovo Messaggio";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Grazie! Il tuo messaggio è stato inviato.";
    } else {
        http_response_code(500);
      echo "Ops! Qualcosa è andato storto e non è stato possibile inviare il tuo messaggio.";
}
} else {
http_response_code(403);
echo "Si è verificato un problema con l'invio, riprova.";
}
       
