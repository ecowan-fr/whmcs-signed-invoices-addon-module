<?php

$status_signed_invoices = false;


$dataFromModule = localAPI(
    'GetModuleConfigurationParameters',
    ['moduleType' => 'addon', 'moduleName' => 'signed_invoices']
);

var_dump($dataFromModule);
exit();
