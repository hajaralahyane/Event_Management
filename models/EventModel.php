<?php
require_once __DIR__ . '/../config.php';

class EventModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function create($titre, $date_evenement, $description) {
        $query = 'INSERT INTO events (titre, date_evenement, description) VALUES (:titre, :date_evenement, :description)';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date_evenement', $date_evenement);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    public function readAll() {
        $query = 'SELECT * FROM events ORDER BY date_evenement DESC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $query = 'SELECT * FROM events WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $titre, $date_evenement, $description) {
        $query = 'UPDATE events SET titre = :titre, date_evenement = :date_evenement, description = :description WHERE id = :id';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date_evenement', $date_evenement);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = 'DELETE FROM events WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}