<?php

require_once 'Model.php';

class ModelPersonne {

    private $id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password;

    public function __construct() {
// constructeur vide requis pour FETCH_CLASS
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getRole_responsable() {
        return $this->role_responsable;
    }

    public function getRole_examinateur() {
        return $this->role_examinateur;
    }

    public function getRole_etudiant() {
        return $this->role_etudiant;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }

    public function setRole_responsable($role_responsable): void {
        $this->role_responsable = $role_responsable;
    }

    public function setRole_examinateur($role_examinateur): void {
        $this->role_examinateur = $role_examinateur;
    }

    public function setRole_etudiant($role_etudiant): void {
        $this->role_etudiant = $role_etudiant;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public static function connect($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE login = :login AND password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password
            ]);

            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function connected($login) {
        
    }

    public static function insert($role_responsable, $role_examinateur, $role_etudiant, $nom, $prenom, $login_user, $password_user) {
    try {
        $database = Model::getInstance();

// Vérifier si le login existe déjà
            $query = "SELECT COUNT(*) FROM personne WHERE login = :login";
            $statement = $database->prepare($query);
            $statement->execute(['login' => $login_user]);
            $count = $statement->fetchColumn();

            if ($count > 0) {
// Login déjà existant, ne pas insérer
                return false;
            }

// Générer un nouvel id
            $query = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0] + 1;

        if ($count > 0) {
            // Login déjà existant, ne pas insérer
            return false;
        }

        // Générer un nouvel id
        $query = "SELECT MAX(id) FROM personne";
        $statement = $database->query($query);
        $tuple = $statement->fetch();
        $id = $tuple[0] + 1;

        // Insertion du nouvel utilisateur
        $query = "INSERT INTO personne (id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password) 
                  VALUES (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)";
        $statement = $database->prepare($query);
        $statement->execute([
            'id' => $id,
            'nom' => $nom,
            'prenom' => $prenom,
            'role_responsable' => $role_responsable,
            'role_examinateur' => $role_examinateur,
            'role_etudiant' => $role_etudiant,
            'login' => $login_user,
            'password' => $password_user
        ]);

        return $id;

    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return -1;
    }
    }

    public static function getAllResponsable() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE role_responsable = true";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllExam() {
        try {
            $database = Model::getInstance();
            $query = "SELECT * FROM personne WHERE role_examinateur = true";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insertExam($prenom, $nom, $role_examinateur, $role_etudiant, $role_responsable) {
        try {
            $database = Model::getInstance();

// Étape 1 : calcul du nouvel ID
            $query = "SELECT MAX(id) FROM personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple[0] + 1;

// Étape 2 : génération d'un login unique et mot de passe
            $login = strtolower($prenom . '.' . $nom) . '.' . $id; // ex: jean.dupont.13
            $password = 'secret';

// Étape 3 : insertion
            $query = "INSERT INTO personne (id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password) 
                  VALUES (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'role_responsable' => $role_responsable,
                'role_examinateur' => $role_examinateur,
                'role_etudiant' => $role_etudiant,
                'login' => $login,
                'password' => $password
            ]);

            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
