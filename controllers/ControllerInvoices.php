<?php
class ControllerInvoices extends Controller {
    public function __construct(array $url) {
        $this->requireAuth();
        $im     = new InvoiceManager();
        $userId = Session::getUserId();
        $sub    = $url[1] ?? 'list';

        if ($sub === 'download' && isset($url[2])) {
            $inv = $im->getById((int)$url[2]);
            if (!$inv || $inv->getUserId() !== $userId) {
                Session::flash('error','Accès refusé.'); functions::redirect('invoices');
            }
            // Générer HTML → PDF simple inline
            $this->outputInvoicePdf($inv, $userId);
            return;
        }

        $invoices = $im->getByUser($userId);
        $this->setView('Invoices', [
            'invoices' => $invoices,
            'flash'    => Session::getFlash(),
        ], true, 'Mes devis & factures — SannaStudio', 'dashboard');
    }

    private function outputInvoicePdf(Invoice $inv, int $userId): void {
        $um   = new UserManager();
        $user = $um->getById($userId);
        header('Content-Type: text/html; charset=UTF-8');
        // Sortie HTML printable (pas de lib PDF requise côté serveur)
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8">
        <title>'.htmlspecialchars($inv->getNumber()).'</title>
        <style>
        body{font-family:Arial,sans-serif;color:#111;padding:40px;max-width:700px;margin:0 auto}
        .header{display:flex;justify-content:space-between;border-bottom:3px solid #7B2FBE;padding-bottom:20px;margin-bottom:30px}
        .brand{font-size:24px;font-weight:900;letter-spacing:2px;color:#7B2FBE}
        .brand small{display:block;font-size:11px;color:#888;font-weight:400;letter-spacing:1px}
        table{width:100%;border-collapse:collapse;margin:20px 0}
        th{background:#7B2FBE;color:#fff;padding:10px 14px;text-align:left;font-size:12px;letter-spacing:1px}
        td{padding:10px 14px;border-bottom:1px solid #eee;font-size:13px}
        .total{font-size:24px;font-weight:700;color:#7B2FBE;text-align:right}
        .badge{display:inline-block;padding:3px 12px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase}
        .paid{background:#d1fae5;color:#065f46} .draft{background:#fef3c7;color:#92400e} .sent{background:#dbeafe;color:#1e40af}
        @media print{button{display:none!important}}
        </style></head><body>
        <div class="header">
            <div><div class="brand">SANNASTUDIO<small>Webdiffusion Professionnelle</small></div></div>
            <div style="text-align:right;font-size:13px;color:#555">
                <strong>'.htmlspecialchars($inv->getNumber()).'</strong><br>
                '.strtoupper($inv->getType()).'<br>
                Émis le : '.($inv->getIssuedAt() ? date('d/m/Y',strtotime($inv->getIssuedAt())) : date('d/m/Y')).'
            </div>
        </div>
        <div style="display:flex;justify-content:space-between;margin-bottom:30px">
            <div><strong>Facturé à</strong><br>'.htmlspecialchars($user->getFullName()).'<br>'.htmlspecialchars($user->getEmail()).'</div>
            <div style="text-align:right"><strong>Statut :</strong><br><span class="badge '.htmlspecialchars($inv->getStatus()).'">'.htmlspecialchars($inv->getStatus()).'</span></div>
        </div>
        <table><thead><tr><th>Description</th><th style="text-align:right">Montant</th></tr></thead>
        <tbody><tr><td>'.htmlspecialchars($inv->getNotes() ?: 'Services SannaStudio').'</td><td style="text-align:right">'.number_format($inv->getAmount(),2,',',' ').' $</td></tr></tbody>
        <tfoot><tr><td style="text-align:right;font-weight:700;padding-top:12px">TOTAL</td><td class="total">'.number_format($inv->getAmount(),2,',',' ').' $</td></tr></tfoot></table>
        <p style="font-size:11px;color:#aaa;margin-top:40px;border-top:1px solid #eee;padding-top:16px">SannaStudio — contact@sannastudio.ca — sannastudio.ca<br>Ce document a été généré automatiquement.</p>
        <button onclick="window.print()" style="margin-top:20px;background:#7B2FBE;color:#fff;border:none;padding:12px 24px;cursor:pointer;font-size:14px;border-radius:4px">🖨 Imprimer / Enregistrer PDF</button>
        </body></html>';
        exit;
    }
}
