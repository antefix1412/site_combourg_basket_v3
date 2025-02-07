<?php
require 'vendor/autoload.php';
require 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


$mail->Host = SMTP_HOST;
$mail->Username = SMTP_USERNAME;
$mail->Password = SMTP_PASSWORD;
$mail->Port = SMTP_PORT;
$mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);

// Simulons un processus de paiement réussi
$paiement_reussi = true;

if ($paiement_reussi) {
    // Récupérer les détails de la commande
    $numero_commande = uniqid('CMD');
    $total = $_POST['total'];
    $details_commande = $_POST['details'];

    try {
        $mail = new PHPMailer(true);

        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Utilisez votre serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'votre-email@gmail.com'; // Votre adresse email
        $mail->Password = 'votre-mot-de-passe-application'; // Votre mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Pour supporter les caractères accentués

        // Paramètres de l'email
        $mail->setFrom('votre-email@gmail.com', 'Club de Basket Combourg');
        $mail->addAddress('a.lemesle26@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = "Nouvelle commande payée - $numero_commande";
        
        // Corps du message en HTML
        $mail->Body = "
            <h2>Une nouvelle commande a été payée</h2>
            <p><strong>Numéro de commande :</strong> $numero_commande</p>
            <p><strong>Total :</strong> $total €</p>
            <p><strong>Détails de la commande :</strong><br>$details_commande</p>
        ";

        // Version texte pour les clients qui ne supportent pas l'HTML
        $mail->AltBody = "
            Une nouvelle commande a été payée
            Numéro de commande : $numero_commande
            Total : $total €
            Détails de la commande :
            $details_commande
        ";

        $mail->send();
        echo "<script>
            alert('La commande a été traitée avec succès et un e-mail a été envoyé.');
            window.location.href = 'boutique.php';
        </script>";
        
    } catch (Exception $e) {
        echo "<script>
            alert('La commande a été traitée, mais il y a eu un problème lors de l\'envoi de l\'e-mail. Erreur : {$mail->ErrorInfo}');
            window.location.href = 'boutique.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Il y a eu un problème avec le paiement. Veuillez réessayer.');
        window.location.href = 'boutique.php';
    </script>";
}
