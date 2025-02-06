<?php
// traitement-commande.php

// Simulons un processus de paiement réussi
$paiement_reussi = true; // Dans un cas réel, cela dépendrait de la réponse du système de paiement

if ($paiement_reussi) {
    // Récupérer les détails de la commande (à adapter selon votre système)
    $numero_commande = uniqid('CMD');
    $total = $_POST['total']; // Assurez-vous que ce champ existe dans votre formulaire
    $details_commande = $_POST['details']; // Assurez-vous que ce champ existe dans votre formulaire

    // Préparer le contenu de l'e-mail
    $to = 'a.lemesle26@gmail.com';
    $subject = "Nouvelle commande payée - $numero_commande";
    $message = "Une nouvelle commande a été payée :\n\n";
    $message .= "Numéro de commande : $numero_commande\n";
    $message .= "Total : $total €\n";
    $message .= "Détails de la commande :\n$details_commande";

    $headers = 'From: votresite@domaine.com' . "\r\n" .
        'Reply-To: votresite@domaine.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // Envoyer l'e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "La commande a été traitée avec succès et un e-mail a été envoyé.";
    } else {
        echo "La commande a été traitée, mais il y a eu un problème lors de l'envoi de l'e-mail.";
    }
} else {
    echo "Il y a eu un problème avec le paiement. Veuillez réessayer.";
}