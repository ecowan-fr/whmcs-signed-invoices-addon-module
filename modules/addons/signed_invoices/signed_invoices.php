<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function signed_invoices_config() {
    $configarray = array(
        "name" => "Signed Invoices by Ecowan",
        "description" => "Addon for signed invoices with a certificate",
        "version" => "1.0",
        "author" => "<a href=\"http://www.ecowan.fr\">Ecowan SAS</a>",
        "language" => "english",
        "fields" => array(
            "privateKey" => array(
                "FriendlyName" => "Private Key",
                "Type" => "textarea",
                "Rows" => "10",
                "Cols" => "50",
                "Default" => "-----BEGIN PRIVATE KEY-----"
            ),
            "passPhrasePrivateKey" => array(
                "FriendlyName" => "Passphrase of your private key",
                "Type" => "text",
                "Size" => "25"
            ),
            "certificate" => array(
                "FriendlyName" => "Your Certificate",
                "Type" => "textarea",
                "Rows" => "10",
                "Cols" => "50",
                "Description" => "You certificate with .pem extention",
                "Default" => "-----BEGIN CERTIFICATE-----"
            ),
        )
    );
    return $configarray;
}

function signed_invoices_activate() {
}

function signed_invoices_deactivate() {
}

function signed_invoices_output($vars) {
}

function signed_invoices_clientarea($vars) {
}

function signed_invoices_upgrade($vars) {
}
