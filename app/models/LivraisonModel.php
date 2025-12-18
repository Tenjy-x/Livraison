<?php
  namespace app\models;
  use Flight;
  use PDO;

  class LivraisonModel {
    private $db;
    public function __construct($db) {
      $this->db = $db;
    }

    public function getAllLivraison() {
      $sql = "SELECT * FROM V_Livraison";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }

    public function getAllZone(){
      $sql = "SELECT * FROM Zone";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }

    public function getAllEntrepot(){
      $sql = "SELECT * FROM Entrepot";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }
    
    public function getAllLivreurs() {
      $sql = "SELECT * FROM Livreurs";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }

    public function getAllVehicule() {
      $sql = "SELECT * FROM Vehicule";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }

    public function getAllColis(){
      $sql = "SELECT * FROM Colis";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }

    public function getAllStatut(){
      $sql = "SELECT * FROM Statut";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll();
    }
  
    // public function insertLivraison($cout , $livreurs , $zone , $vehicules , $colis , $carburant , $entrepot , $statut , $destination , $date) {
    //   $sql = "INSERT INTO Livraison(id_colis, id_zone, id_livreur, id_vehicule, id_entrepot, adresse_de_destination, id_statut, cout_livraison, date_livraison, carburant)
    //   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    //   $stmt = $this->db->prepare($sql);
    //   $stmt->bindParam(1, $colis);
    //   $stmt->bindParam(2, $zone);
    //   $stmt->bindParam(3, $livreurs);
    //   $stmt->bindParam(4, $vehicules);
    //   $stmt->bindParam(5, $entrepot);
    //   $stmt->bindParam(6, $destination);
    //   $stmt->bindParam(7, $statut);
    //   $stmt->bindParam(8, $cout);
    //   $stmt->bindParam(9, $date);
    //   $stmt->bindParam(10, $carburant);
    //   echo $colis;
    //   $stmt->execute();
    //   return $this->db->lastInsertId();
    // }
    public function insertLivraison($data) {
      $st = $this->db->prepare("INSERT INTO Livraison(id_colis, id_zone, id_livreur, id_vehicule, id_entrepot, adresse_de_destination, id_statut, cout_livraison, date_livraison, carburant)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $st->execute($data);
    }

    public function getLivreursByID($id) {
      $sql = "SELECT * FROM Livreurs WHERE id_livreur = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch();
    }
  }