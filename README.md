# whmcs-stancer-gateway-module

This is a WHMCS Module Addon for sign invoices with a certificate

## Instalation

Copy files on your root WHMCS system and active Addon on your settings.

## INSTALLATION

1. Copy all files into your whmcs installation directory
2. Navigate to Setup -> Addon Modules in the WHMCS admin interface
3. Activate the "Signed Invoices" module
4. Setup your administrator role access to the module
5. Fill out required fields and save the changes
6. Add the following code to templates/YOURTEMPLATE/invoicepdf.tpl just ABOVE the last line :

```php
// _ BEGIN SIGN INVOICES CODE BLOCK _
require_once ROOTDIR.'/modules/addons/signed_invoices/si_include.php';
if ($status_signed_invoices) {
    $pdf->setSignature($cert,$privatekey,$keypass,$extra);
} else {
	logActivity('Impossible to sign invoices');
}
// _ END SIGN INVOICES CODE BLOCK _
```
