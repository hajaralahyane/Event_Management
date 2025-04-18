<?php
require_once __DIR__ . '/../config.php';

class InscriptionModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function create($event_id, $participant_id) {
        $query = 'INSERT INTO inscriptions (event_id, participant_id, date_inscription) VALUES (:event_id, :participant_id, NOW())';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':participant_id', $participant_id);

        return $stmt->execute();
    }

    public function readAll() {
        $query = 'SELECT i.*, e.titre as event_titre, p.nom as participant_nom 
                 FROM inscriptions i
                 JOIN events e ON i.event_id = e.id
                 JOIN participants p ON i.participant_id = p.id
                 ORDER BY i.date_inscription DESC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInscriptionsByEvent($event_id) {
        $query = 'SELECT i.*, p.nom, p.email 
                 FROM inscriptions i
                 JOIN participants p ON i.participant_id = p.id
                 WHERE i.event_id = :event_id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}