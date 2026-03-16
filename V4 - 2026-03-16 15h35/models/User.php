<?php
class User {
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $phone;
    private $password_hash;
    private $email_token;
    private $email_verified;
    private $reset_token;
    private $reset_token_exp;
    private $accepted_tos;
    private $accepted_privacy;
    private $last_login_at;
    private $last_login_ip;
    private $created_at;
    private $updated_at;
    private $role;

    public function __construct(array $data) {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) $this->$k = $v;
        }
    }

    public function getId(): int            { return (int)$this->id; }
    public function getFirstName(): string  { return $this->first_name ?? ''; }
    public function getLastName(): string   { return $this->last_name ?? ''; }
    public function getFullName(): string   { return trim($this->first_name.' '.$this->last_name); }
    public function getEmail(): string      { return $this->email ?? ''; }
    public function getPhone(): ?string     { return $this->phone; }
    public function getPasswordHash(): string { return $this->password_hash ?? ''; }
    public function getEmailToken(): ?string  { return $this->email_token; }
    public function isEmailVerified(): bool   { return (bool)$this->email_verified; }
    public function getResetToken(): ?string  { return $this->reset_token; }
    public function getResetTokenExp(): ?string { return $this->reset_token_exp; }
    public function hasAcceptedTos(): bool    { return (bool)$this->accepted_tos; }
    public function hasAcceptedPrivacy(): bool { return (bool)$this->accepted_privacy; }
    public function getLastLoginAt(): ?string { return $this->last_login_at; }
    public function getLastLoginIp(): ?string { return $this->last_login_ip; }
    public function getRole(): string  { return $this->role ?? 'client'; }
public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function getCreatedAt(): string    { return $this->created_at ?? ''; }
}