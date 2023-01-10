<?php
function signed_invoices_config() {
    $configarray = array(
        "name" => "Signed Invoices by Ecowan",
        "description" => "Addon for signed invoices with a certificate",
        "version" => "1.0",
        "author" => "Ecowan SAS",
        "fields" => array(
            "privateKey" => array(
                "FriendlyName" => "Private Key", "Type" => "textarea", "Rows" => "10",
                "Cols" => "50", "Description" => "You private key", "Default" => "-----BEGIN PRIVATE KEY-----",
            ),
            "passPhrasePrivateKey" => array(
                "FriendlyName" => "Passphrase of your private key", "Type" => "text", "Size" => "25",
                "Description" => "Textbox", "Default" => "Example",
            ),
            "certificate" => array(
                "FriendlyName" => "Your Certificate", "Type" => "textarea", "Rows" => "10",
                "Cols" => "50", "Description" => "You certificate with .pem extention", "Default" => "-----BEGIN CERTIFICATE-----",
            ),
        )
    );
    return $configarray;
}
