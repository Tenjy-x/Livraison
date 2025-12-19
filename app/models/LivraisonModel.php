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

    public function getBeneficesParPeriode($jour = null, $mois = null, $annee = null) {
      $periodeValue = "DATE(L.date_livraison)";
      $periodeLabel = "DATE(L.date_livraison)";

      if (!empty($jour)) {
        $periodeValue = "DATE(L.date_livraison)";
        $periodeLabel = "DATE(L.date_livraison)";
      } elseif (!empty($mois)) {
        $periodeValue = "DATE_FORMAT(L.date_livraison, '%Y-%m-01')";
        $periodeLabel = "DATE_FORMAT(L.date_livraison, '%Y-%m')";
      } elseif (!empty($annee)) {
        $periodeValue = "YEAR(L.date_livraison)";
        $periodeLabel = "YEAR(L.date_livraison)";
      }

      $where = [];

      $where[] = "L.id_statut NOT IN (2, 3)";

      if (!empty($jour)) {
        $where[] = "DATE(L.date_livraison) = '" . $jour . "'";
      }
      if (!empty($mois)) {
        $where[] = "DATE_FORMAT(L.date_livraison, '%Y-%m') = '" . $mois . "'";
      }
      if (!empty($annee)) {
        $where[] = "YEAR(L.date_livraison) = '" . $annee . "'";
      }
      $whereSql = '';
      if (!empty($where)) {
        $whereSql = 'WHERE ';
        $countWhere = count($where);
        for ($i = 0; $i < $countWhere; $i++) {
          $whereSql .= $where[$i];
          if ($i < $countWhere - 1) {
            $whereSql .= ' AND ';
          }
        }
      }

      $sql = "
        SELECT
          {$periodeValue}   AS periode_value,
          {$periodeLabel}   AS periode_label,
          COUNT(*)          AS livraisons,
          SUM(C.poids * C.prix)                         AS ca,
          SUM(L.carburant + LV.salaire)                 AS couts,
          SUM((C.poids * C.prix) - (L.carburant + LV.salaire)) AS benefice
        FROM Livraison L
        JOIN Colis C ON C.id_colis = L.id_colis
        JOIN Livreurs LV ON LV.id_livreur = L.id_livreur
        {$whereSql}
        GROUP BY periode_value, periode_label
        ORDER BY periode_value DESC
      ";

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