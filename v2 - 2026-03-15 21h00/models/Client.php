<?php
class Client {
    private $id;
    private $prenom;
    private $nom;
    private $email;
    private $telephone;
    private $password_hash;
    private $token_verify;
    private $email_verified;
    private $token_reset;
    private $token_reset_exp;
    private $accepte_cgu;
    private $accepte_politique;
    private $created_at;
    private $updated_at;

    public function __construct(array $data) {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) $this->$k = $v;
        }
    }

    public function getId(): int            { return (int)$this->id; }
    public function getPrenom(): string     { return $this->prenom ?? ''; }
    public function getNom(): string        { return $this->nom ?? ''; }
    public function getEmail(): string      { return $this->email ?? ''; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function getPasswordHash(): string { return $this->password_hash ?? ''; }
    public function getTokenVerify(): ?string { return $this->token_verify; }
    public function isEmailVerified(): bool { return (bool)$this->email_verified; }
    public function getTokenReset(): ?string  { return $this->token_reset; }
    public function getTokenResetExp(): ?string { return $this->token_reset_exp; }
    public function hasAccepteCgu(): bool   { return (bool)$this->accepte_cgu; }
    public function hasAcceptePolitique(): bool { return (bool)$this->accepte_politique; }
    public function getCreatedAt(): string  { return $this->created_at ?? ''; }
    public function getNomComplet(): string { return $this->prenom.' '.$this->nom; }
}
