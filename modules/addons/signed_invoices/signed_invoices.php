<?php
function demo_config() {
    $configarray = array(
        "name" => "Signed Invoices by Ecowan",
        "description" => "Addon for signed invoices with a certificate",
        "version" => "1.0",
        "author" => "Ecowan SAS",
        "fields" => array(
            "option1" => array(
                "FriendlyName" => "Option1", "Type" => "text", "Size" => "25",
                "Description" => "Textbox", "Default" => "Example",
            ),
            "option2" => array(
                "FriendlyName" => "Option2", "Type" => "password", "Size" => "25",
                "Description" => "Password",
            ),
            "option3" => array(
                "FriendlyName" => "Option3", "Type" => "yesno", "Size" => "25",
                "Description" => "Sample Check Box",
            ),
            "option4" => array("FriendlyName" => "Option4", "Type" => "dropdown", "Options" =>
            "1,2,3,4,5", "Description" => "Sample Dropdown", "Default" => "3",),
            "option5" => array("FriendlyName" => "Option5", "Type" => "radio", "Options" =>
            "Demo1,Demo2,Demo3", "Description" => "Radio Options Demo",),
            "option6" => array(
                "FriendlyName" => "Option6", "Type" => "textarea", "Rows" => "3",
                "Cols" => "50", "Description" => "Description goes here", "Default" => "Test",
            ),
        )
    );
    return $configarray;
}
