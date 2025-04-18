<?php
require_once __DIR__ . '/../config.php';
require_once MODELS_PATH . '/ParticipantModel.php';

class ParticipantController {
    private $model;

    public function __construct() {
        $this->model = new ParticipantModel();
    }

    public function createParticipant($nom, $email) {
        // Validation des données
        if (empty($nom)) {
            return ['success' => false, 'message' => 'Le nom est obligatoire'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Email invalide'];
        }

        // Vérifier si l'email existe déjà
        $existing = $this->model->findByEmail($email);
        if ($existing) {
            return ['success' => false, 'message' => 'Cet email est déjà enregistré'];
        }

        try {
            $result = $this->model->create($nom, $email);
            return [
                'success' => $result, 
                'message' => $result ? 'Participant enregistré avec succès' : 'Erreur lors de l\'enregistrement',
                'participant_id' => $this->model->getLastInsertId()
            ];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getAllParticipants() {
        try {
            return $this->model->readAll();
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getParticipantById($id) {
        try {
            return $this->model->readById($id);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
}
?>