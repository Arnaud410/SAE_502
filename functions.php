<?php

// Fonction pour vérifier les informations d'identification
function checkCredentials($username, $password) {
    // Remplacez ces valeurs par les informations d'identification réelles
    $teacherUsername = 'enseignant';
    $teacherPasswordHash = password_hash('motdepasse_enseignant', PASSWORD_DEFAULT);

    $studentUsernames = ['eleve1', 'eleve2', 'eleve3'];
    $studentPasswordHash = password_hash('motdepasse_eleve', PASSWORD_DEFAULT);

    // Vérifiez le type d'utilisateur
    if ($username === $teacherUsername && password_verify($password, $teacherPasswordHash)) {
        return 'enseignant';
    } elseif (in_array($username, $studentUsernames) && password_verify($password, $studentPasswordHash)) {
        return 'eleve';
    }

    return false;
}

// Fonction pour afficher le tableau d'état de présence pour un élève
function displayStudentDashboard($username, $eleves) {
    echo '<div class="dashboard-container">';
    echo '<h2>Tableau de présence</h2>';
    echo '<table border="1">';
    echo '<tr><th>Élève</th><th>Présent</th></tr>';
    
    foreach ($eleves as $eleve => $present) {
        echo '<tr>';
        echo '<td>' . $eleve . '</td>';
        echo '<td>' . ($eleve === $username ? ($present ? 'Présent' : 'Absent') : ($present ? 'Présent' : 'Absent')) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}

// Fonction pour afficher le tableau d'état de présence pour l'enseignant
function displayTeacherDashboard($eleves) {
    echo '<div class="dashboard-container">';
    echo '<h2>Tableau de présence pour l\'enseignant</h2>';
    echo '<table border="1">';
    echo '<tr><th>Élève</th><th>Présent</th></tr>';
    
    foreach ($eleves as $eleve => $present) {
        echo '<tr>';
        echo '<td>' . $eleve . '</td>';
        echo '<td>' . ($present ? 'Présent' : 'Absent') . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}

// Fonction pour charger les données d'état de présence depuis le fichier
function loadPresenceData() {
    $presenceFile = 'data/presence.json';
    if (file_exists($presenceFile)) {
        $presenceData = json_decode(file_get_contents($presenceFile), true);
        if ($presenceData !== null) {
            return $presenceData;
        }
    }

    // Si le fichier n'existe pas ou ne peut pas être décodé, retournez un tableau par défaut
    return ['eleve1' => false, 'eleve2' => false, 'eleve3' => false];
}

// Fonction pour sauvegarder les données d'état de présence dans le fichier
function savePresenceData($presenceData) {
    $presenceFile = 'data/presence.json';
    file_put_contents($presenceFile, json_encode($presenceData));
}

?>
