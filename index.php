<?php
// Tillåt bara POST-anrop från formuläret
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: kontakts.html");
    exit;
}

// Hämta och städa bort onödiga mellanslag i början/slutet
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

$errors = [];

if ($name === "") {
    $errors[] = "Du behöver fylla i ditt namn.";
}

if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Ange en giltig e-postadress.";
}

if ($message === "") {
    $errors[] = "Du behöver skriva ett meddelande.";
}

// Skyddar utskrift mot HTML/XSS-tecken
function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontaktbekräftelse - Mac Flink</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php if (!empty($errors)): ?>
            <h2>Något blev tokigt</h2>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
            <p><a href="kontakts.html">Tillbaka till kontaktsidan</a></p>
        <?php else: ?>
            <h2>Tack för ditt meddelande, <?= e($name) ?>!</h2>
            <p>Vi har tagit emot din förfrågan till Mac Flink.</p>
            <p><strong>E-post:</strong> <?= e($email) ?></p>
            <p><strong>Meddelande:</strong><br><?= nl2br(e($message)) ?></p>
            <p><a href="kontakts.html">Skicka ett nytt meddelande</a></p>
        <?php endif; ?>
    </main>
</body>
</html>