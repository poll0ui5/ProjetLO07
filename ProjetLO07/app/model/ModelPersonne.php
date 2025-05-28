<?php

require_once 'Model.php';

class ModelPersonne {

    private $id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password;

    public function __construct($id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role_responsable = $role_responsable;
        $this->role_examinateur = $role_examinateur;
        $this->role_etudiant = $role_etudiant;
        $this->login = $login;
        $this->password = $password;
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
}
