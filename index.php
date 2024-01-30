<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>

    <?php
    include('functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $userType = checkCredentials($username, $password);

    if ($userType) {
        // Utilisateur connecté avec succès
        if ($userType === 'eleve') {
            // Chargez les données d'état de présence
            $presenceData = loadPresenceData();

            // Mettez à jour l'état de présence pour l'élève connecté
            $presenceData[$username] = true;

            // Sauvegardez les nouvelles données d'état de présence
            savePresenceData($presenceData);

            // Affichez le tableau d'état de présence pour l'élève
            displayStudentDashboard($username, $presenceData);
        } elseif ($userType === 'enseignant') {
            // Redirigez l'enseignant vers la page du tableau de bord
            header("Location: teacher_dashboard.php");
            exit();
        }
    } else {
        echo '<p style="color: red;">Nom d\'utilisateur ou mot de passe incorrect.</p>';
    }
}
    ?>

    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
