<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function signed_invoices_config() {
    $configarray = array(
        "name" => "Signed Invoices by Ecowan",
        "description" => "Addon for signed invoices with a certificate",
        "version" => "1.0",
        "author" => "<a href=\"http://www.ecowan.fr\">Ecowan SAS</a>",
        "language" => "english"
    );
    return $configarray;
}

function signed_invoices_activate() {
    // Create custom tables and schema required by your module
    try {
        Capsule::schema()
            ->create(
                'mod_signedinvoices',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->id('id');
                    $table->text('name');
                    $table->longText('value')->nullable();
                }
            );

        Capsule::table('mod_signedinvoices')->insert(['name' => 'cert']);
        Capsule::table('mod_signedinvoices')->insert(['name' => 'key']);
        Capsule::table('mod_signedinvoices')->insert(['name' => 'keypass']);
        Capsule::table('mod_signedinvoices')->insert(['name' => 'extra']);

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'Database is created !',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mod_signedinvoices: ' . $e->getMessage(),
        ];
    }
}

function signed_invoices_deactivate() {
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('mod_signedinvoices');

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'Database is dropped !',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mod_signedinvoices: {$e->getMessage()}",
        ];
    }
}

function signed_invoices_output($vars) {

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];

    try {
        $data = Capsule::table('mod_signedinvoices')->first();
        $cert = $data['cert'];
        $key = $data['key'];
        $extra = $data['extra'];
        $keypass = $data['keypass'];
        var_dump($data);
    } catch (\Exception $e) {
        echo $e->getMessage();
        exit();
    }

    echo '<div id="tab0box" class="tabbox">
				<div id="tab_content">
					<h3>Configuration</h3>
					<form method="POST" action="' . $modulelink . '&a=save" name="configfrm">
						<table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
							<tr>
								<td class="fieldarea">
									<strong>Signing Certificate</strong><br />
									<textarea rows="20" cols="40" name="cert">' . $cert . '</textarea>
								<td class="fieldarea">
									<strong>Private Key</strong><br />
									<textarea rows="20" cols="40" name="key">' . $key . '</textarea>
								</td>
								<td class="fieldarea">
									<strong>Intermediate Certificates (Optional)</strong><br />
									<textarea rows="20" cols="40" name="extra">' . $extra . '</textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3" align="center">
									<strong>Private Key Passphase (Optional):</strong><input type="password" name="keypass" value="' . $keypass . '" />
								</td>
							</tr>
							<tr>
								<td colspan="3" align="center">
									<input type="submit" value="Save Changes" class="button" />
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<br />
			<p align="left"><h5>Signed Invoices was written by <a href="mailto:hello@ecowan.fr">Ecowan SAS</a><br />Version ' . $version . '</h5></p>';
}
