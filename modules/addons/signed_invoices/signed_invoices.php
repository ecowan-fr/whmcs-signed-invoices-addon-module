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
                    $table->increments('id');
                    $table->text('name');
                    $table->longText('value');
                }
            );

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

    var_dump($vars);
    exit();

    $modulelink = $vars['modulelink'];
    $version = $vars['version'];

    if (isset($_REQUEST['a'])) {
        foreach ($_POST as $k => $v) {
            if ($k != "token") {
                if ($k == "keypass") {
                    $v = encrypt($v);
                }
                $d = update_query("mod_signedinvoices", array("value" => $v), "name='$k'");
            }
        }
        $successmsg = "Changes Saved.";
    }
    $data = select_query("mod_signedinvoices", "name, value", array());
    while ($r = mysql_fetch_array($data)) {
        switch ($r['name']) {
            case "cert":
                $cert = $r['value'];
                break;
            case "key":
                $key = $r['value'];
                break;
            case "keypass":
                $keypass = decrypt($r['value']);
                break;
            case "extra":
                $extra = $r['value'];
                break;
        }
    }
    if (isset($successmsg)) {
        print '<div class="successbox">' . $successmsg . '</div>';
    }
    print '<div id="tab0box" class="tabbox">
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
			<p align="left"><h5>Signed Invoices was written by <a href="mailto:frank@franksworld.org">Frank Laszlo</a><br />Version ' . $version . '</h5></p>';
}
