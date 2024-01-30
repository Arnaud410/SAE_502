<?php
include('functions.php');

// Gérez la demande de marquer en retard
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_late'])) {
    // Chargez les données d'état de présence
    $presenceData = loadPresenceData();

    // Marquez en retard les élèves sélectionnés
    if (isset($_POST['retard']) && is_array($_POST['retard'])) {
        foreach ($_POST['retard'] as $eleve => $value) {
            $presenceData[$eleve] = $value == 1 ? 'retard' : true;
        }
    }

    // Sauvegardez les nouvelles données d'état de présence
    savePresenceData($presenceData);
}

// Chargez les données pour inclure les dernières mises à jour
$presenceData = loadPresenceData();

// Affichez le tableau d'état de présence pour l'enseignant
displayTeacherDashboard($presenceData);
?>
