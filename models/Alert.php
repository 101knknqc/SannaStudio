<?php
class Alert {
    public const TYPE_SUCCESS = 'success';
    public const TYPE_ERROR   = 'error';
    public const TYPE_WARNING = 'warning';
    public const TYPE_INFO    = 'info';

    private bool   $status;
    private string $type;
    private string $message;

    public function __construct(bool $status, string $type, string $message) {
        $this->status  = $status;
        $this->type    = $type;
        $this->message = $message;
    }

    public function getStatus(): bool   { return $this->status; }
    public function getType(): string   { return $this->type; }
    public function getMessage(): string{ return $this->message; }

    public function asJson(): string {
        return json_encode([
            'success' => $this->status,
            'type'    => $this->type,
            'message' => $this->message,
        ]);
    }
}
