<?php

$status_signed_invoices = false;


$dataFromModule = localAPI(
    'GetModuleConfigurationParameters',
    ['moduleType' => 'addon', 'moduleName' => 'Signed Invoices by Ecowan']
);

var_dump($dataFromModule);
exit();
