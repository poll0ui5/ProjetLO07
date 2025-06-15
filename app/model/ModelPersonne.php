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

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple
            $query = "insert into personne (id, nom, prenom, role_responsable, role_examinateur, role_etudiant, login, password) 
                  values (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)";
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
        $query = "SELECT id, prenom, nom FROM personne WHERE role_responsable = TRUE";
        $statement = $database->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    } catch (PDOException $e) {
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return null;
    }
}
}

