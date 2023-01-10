<?php

use WHMCS\Database\Capsule;

$status_signed_invoices = false;

try {
    foreach (Capsule::table('mod_signedinvoices')->get() as $key => $value) {
        switch ($value->name) {
            case "cert":
                $cert = $value->value;
                break;
            case "key":
                $privatekey = $value->value;
                break;
            case "keypass":
                $keypass = openssl_decrypt($value->value, 'AES-256-CTR', 'sf64g654sd6f4sdf4');
                break;
            case "extra":
                $extra = $value->value;
                break;
        }
    }
    if (
        !is_null($cert) && $cert != '' &&
        !is_null($privatekey) && $privatekey != ''
    ) {
        $status_signed_invoices = true;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
    exit();
}
