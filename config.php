<?php
// Définir les constantes pour les chemins
define('ROOT_DIR', dirname(__FILE__));
define('CONTROLLERS_PATH', ROOT_DIR . '/controllers');
define('MODELS_PATH', ROOT_DIR . '/models');
define('VIEWS_PATH', ROOT_DIR . '/views');
define('CONFIG_PATH', ROOT_DIR . '/config');

// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_evenements');
define('DB_USER', 'root');
define('DB_PASS', '');

// Fonction pour établir la connexion à la base de données
function getDbConnection() {
    try {
        $conn = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $conn;
    } catch (PDOException $e) {
        die('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}