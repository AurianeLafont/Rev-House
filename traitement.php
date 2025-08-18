<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des données
    $nom     = htmlspecialchars($_POST['name']);
    $prenom  = htmlspecialchars($_POST['prenom']);
    $email   = htmlspecialchars($_POST['email']);
    $tel     = htmlspecialchars($_POST['tel']);
    $event   = htmlspecialchars($_POST['event']);
    $spot    = htmlspecialchars($_POST['spot']);
    $date    = htmlspecialchars($_POST['date']);
    $message = htmlspecialchars($_POST['message']);

    // Adresse de destination (à remplacer par la tienne)
    $to = "lolipope2012@gmail.com";

    // Sujet de l’email
    $subject = "Nouvelle demande de contact depuis le site";

    // Corps du mail
    $body = "Vous avez reçu un nouveau message via le formulaire de contact :\n\n";
    $body .= "Nom : $nom\n";
    $body .= "Prénom : $prenom\n";
    $body .= "Email : $email\n";
    $body .= "Téléphone : $tel\n\n";
    $body .= "Événement : $event\n";
    $body .= "Zone : $spot\n";
    $body .= "Date : $date\n\n";
    $body .= "Message :\n$message\n";

    // En-têtes du mail
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Envoi
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>
        alert('Merci $prenom, votre message a bien été envoyé ✅');
        window.location.href = 'projet.html';
      </script>";
    } else {
        echo "<h2>❌ Une erreur est survenue lors de l'envoi. Veuillez réessayer.</h2>";
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $secretKey = "6Ldu26krAAAAANzQ6x0gCX5YRae_m3SyAvoPJCrC";

    // Vérification du reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse,
        'remoteip' => $remoteIp
    ];

    // Requête vers Google
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captchaSuccess = json_decode($verify);

    if ($captchaSuccess->success) {
        // Ici ton code pour envoyer le mail
        // ...
    } else {
        echo "<h2>❌ Veuillez valider le reCAPTCHA pour envoyer le formulaire.</h2>";
    }
}
?>

