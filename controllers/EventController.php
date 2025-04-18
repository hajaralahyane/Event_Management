<?php
require_once __DIR__ . '/../config.php';
require_once MODELS_PATH . '/EventModel.php';

class EventController {
    private $model;

    public function __construct() {
        $this->model = new EventModel();
    }

    public function createEvent($titre, $date_evenement, $description) {
        // Validation des données
        if (empty($titre)) {
            return ['success' => false, 'message' => 'Le titre est obligatoire'];
        }

        if (!strtotime($date_evenement)) {
            return ['success' => false, 'message' => 'Date invalide'];
        }

        try {
            $result = $this->model->create($titre, $date_evenement, $description);
            return ['success' => $result, 'message' => $result ? 'Événement créé avec succès' : 'Erreur lors de la création'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getAllEvents() {
        try {
            return $this->model->readAll();
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getEventById($id) {
        try {
            return $this->model->readById($id);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function updateEvent($id, $titre, $date_evenement, $description) {
        // Validation des données
        if (empty($titre)) {
            return ['success' => false, 'message' => 'Le titre est obligatoire'];
        }

        if (!strtotime($date_evenement)) {
            return ['success' => false, 'message' => 'Date invalide'];
        }

        try {
            $result = $this->model->update($id, $titre, $date_evenement, $description);
            return ['success' => $result, 'message' => $result ? 'Événement mis à jour avec succès' : 'Erreur lors de la mise à jour'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function deleteEvent($id) {
        try {
            $result = $this->model->delete($id);
            return ['success' => $result, 'message' => $result ? 'Événement supprimé avec succès' : 'Erreur lors de la suppression'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
}
?>