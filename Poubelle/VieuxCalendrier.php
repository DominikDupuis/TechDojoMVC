<?php
// Création d'affichage de dispo
$red_dot = '<span class="dot red-dot"></span>';
$green_dot = '<span class="dot green-dot"></span>';
// Set timezone
date_default_timezone_set("America/Toronto");

if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // Ce mois-ci
    $ym = date('Y-m');
}
// Check format
$timestamp = strtotime($ym . '-01');  // Première journée du mois
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Aujourd'hui (Format:2018-08-8)
$today = date('Y-m-j');
// Titre (Format:August, 2018)
$title = date('F, Y', $timestamp);
// Link pour prev. / suiv.
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));
// Nombre de jours dans le mois
$day_count = date('t', $timestamp);
// Jours de la semaine
$str = date('N', $timestamp);
// Liste pour calendrier
$weeks = [];
$week = '';
// Création des cases vides
$week .= str_repeat('<td></td>', $str - 1);
for ($day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym . '-' . $day;
    if ($today == $date) {
        $week .= '<td class="today">';
    } else {
        $week .= '<td>';
    }
    // INSERER LES NUMEROS + LES DISPOS !
    $week .= $day . '<p>' . '<p>' . str_repeat($red_dot . ' ',  4) . '<p>' . str_repeat($red_dot . ' ',  4) . '</td>';
    // Les Samedis / Dimanches
    if ($str % 7 == 0 || $day == $day_count) {
        // Dernier jours du mois
        if ($day == $day_count && $str % 7 != 0) {
            // Cellules vides si - de jours que le tableau
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        $week = '';
    }
}
