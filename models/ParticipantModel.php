<?php
require_once __DIR__ . '/../config.php';

class ParticipantModel {
    private $db;

    public function __construct() {
        $this->db = getDbConnection();
    }

    public function create($nom, $email) {
        $query = 'INSERT INTO participants (nom, email) VALUES (:nom, :email)';
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function readAll() {
        $query = 'SELECT * FROM participants ORDER BY nom ASC';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $query = 'SELECT * FROM participants WHERE id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email) {
        $query = 'SELECT * FROM participants WHERE email = :email';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}