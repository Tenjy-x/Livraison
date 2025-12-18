<?php
  namespace app\controllers;
  use Flight;

  use app\models\LivraisonModel;

  class LivraisonController {
    public function getAllLivraison() {
      $LivraisonModel = new LivraisonModel(Flight::db());
      $livraison = $LivraisonModel->getAllLivraison();
      $LivraisonModel = new LivraisonModel(Flight::db());
      $livreurs = $LivraisonModel->getAllLivreurs();
      $vehicule = $LivraisonModel->getAllVehicule();
      $colis = $LivraisonModel->getAllColis();
      $statuts = $LivraisonModel->getAllStatut();
      $zones = $LivraisonModel->getAllZone();
      $entrepot = $LivraisonModel->getAllEntrepot();
      Flight::render("liste", ['data' => $livraison, 'livreurs'=>$livreurs, 'vehicules'=>$vehicule, 'colis'=>$colis,'statut'=>$statuts,'zones'=>$zones, 'entrepot'=>$entrepot]);
    }

    public function getAllLivraisonIndex() {
      $LivraisonModel = new LivraisonModel(Flight::db());
      $livraison = $LivraisonModel->getAllLivraison();
      $LivraisonModel = new LivraisonModel(Flight::db());
      $livreurs = $LivraisonModel->getAllLivreurs();
      $vehicule = $LivraisonModel->getAllVehicule();
      $colis = $LivraisonModel->getAllColis();
      $statuts = $LivraisonModel->getAllStatut();
      $zones = $LivraisonModel->getAllZone();
      $entrepot = $LivraisonModel->getAllEntrepot();
      Flight::render("index", ['data' => $livraison, 'livreurs'=>$livreurs, 'vehicules'=>$vehicule, 'colis'=>$colis,'statut'=>$statuts,'zones'=>$zones, 'entrepot'=>$entrepot]);
    }
    public function insertLivraison() {
        $tmp = new LivraisonModel(Flight::db());
        
        $livreur = ($_POST['Livreurs']);
        $chauffeur = $tmp->getLivreursByID($livreur);

        $cout = floatval($_POST['Carburant']) + $chauffeur['salaire'];

        $idColis = $_POST['Colis'];
        $statut =  $_POST['Statut'];
        $zone = $_POST['Zone'];
        $vehicule = $_POST['Vehicule'];
        $date = $_POST['date_livraison'];
        $carburant = floatval($_POST['Carburant']);
        $entrepot = $_POST['Entrepot'];
        $destination = $_POST['Destination'];

        // $affaire = $colis['poids']*$config['prix_kg'];
        $data = [$idColis, $zone , $livreur, $vehicule , $entrepot , $destination , $statut , $cout ,  $date , $carburant];
        $livraison = new LivraisonModel(Flight::db());
        $livraison->insertLivraison($data);
        Flight::redirect("/");
    }
  }

