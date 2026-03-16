<?php
class RdvDemande {
    private $id;
    private $client_id;
    private $nom;
    private $email;
    private $telephone;
    private $service;
    private $date_souhaitee;
    private $duree;
    private $plateformes;
    private $message;
    private $statut;
    private $created_at;

    public function __construct(array $data) {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) $this->$k = $v;
        }
    }

    public function getId(): int           { return (int)$this->id; }
    public function getClientId(): ?int    { return $this->client_id ? (int)$this->client_id : null; }
    public function getNom(): string       { return $this->nom ?? ''; }
    public function getEmail(): string     { return $this->email ?? ''; }
    public function getTelephone(): string { return $this->telephone ?? ''; }
    public function getService(): string   { return $this->service ?? ''; }
    public function getDate(): string      { return $this->date_souhaitee ?? ''; }
    public function getDuree(): string     { return $this->duree ?? ''; }
    public function getPlateformes(): string { return $this->plateformes ?? ''; }
    public function getMessage(): string   { return $this->message ?? ''; }
    public function getStatut(): string    { return $this->statut ?? 'nouveau'; }
    public function getCreatedAt(): string { return $this->created_at ?? ''; }
}
