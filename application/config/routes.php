<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['sample'] = 'home/sample';
$route['parish/makeparish'] = 'parish/makeparish';

// general routing
$route['getFamilyAddress'] = 'general/getFamilyAddress';
$route['getFamilies'] = 'general/getFamilies';
$route['getStates'] = 'general/getStates';

// Admin routing
$route['admin/managedata'] = 'admin/managedata';
$route['admin/viewdata'] = 'admin/viewdata';
$route['admin/tables'] = 'admin/tables';
$route['admin/about'] = 'admin/about';
$route['admin/sync'] = 'admin/sync';
$route['admin/backup'] = 'admin/backup';
$route['admin/statistics'] = 'admin/statistics';
$route['admin/managedonation'] = 'admin/managedonation';
$route['admin/donations'] = 'admin/donations';
$route['admin/substations'] = 'admin/substations';
$route['admin/managesubstation'] = 'admin/managesubstation';
$route['admin/catechists'] = 'admin/catechists';
$route['admin/managecatechist'] = 'admin/managecatechist';
$route['admin/institutions'] = 'admin/institutions';
$route['admin/manageinstitution'] = 'admin/manageinstitution';
$route['admin/manageconventcommunity'] = 'admin/manageconventcommunity';
$route['admin/manageconvent'] = 'admin/manageconvent';
$route['admin/convents'] = 'admin/convents';
$route['admin/manageassociationmembers'] = 'admin/manageassociationmembers';
$route['admin/manageassociation'] = 'admin/manageassociation';
$route['admin/associations'] = 'admin/associations';
$route['admin/printcertificate'] = 'admin/printcertificate';
$route['admin/manageregister'] = 'admin/manageregister';
$route['admin/registers'] = 'admin/registers';
$route['admin/managemember'] = 'admin/managemember';
$route['admin/members'] = 'admin/members';
$route['admin/managefamily'] = 'admin/managefamily';
$route['admin/families'] = 'admin/families';
$route['admin/managescc'] = 'admin/managescc';
$route['admin/sccs'] = 'admin/sccs';
$route['admin/managelogin'] = 'admin/managelogin';
$route['admin/profile'] = 'admin/profile';
$route['admin/settheme'] = 'admin/settheme';
$route['admin/(:any)'] = 'admin/view/$1';

// Sync routing
$route['sync'] = 'server/sync';
$route['update'] = 'server/update';
$route['installupdate'] = 'server/installupdate';
$route['checkforupdate'] = 'server/checkforupdate';

// Account routing
$route['accounts/report'] = 'accounts/report';
$route['accounts/tledgers'] = 'accounts/tledgers';
$route['accounts/managetledger'] = 'accounts/managetledger';
$route['accounts/transactions'] = 'accounts/transactions';
$route['accounts/managetransaction'] = 'accounts/managetransaction';
$route['accounts/bankaccounts'] = 'accounts/bankaccounts';
$route['accounts/managebankaccount'] = 'accounts/managebankaccount';
$route['accounts/financialyears'] = 'accounts/financialyears';
$route['accounts/managefinancialyear'] = 'accounts/managefinancialyear';
$route['accounts/(:any)'] = 'accounts/view/$1';

// Parish routing
$route['parish/shareip'] = 'parish/shareip';
$route['parish/writefile'] = 'parish/writefile';
$route['parish/about'] = 'parish/about';
$route['parish/sync'] = 'parish/sync';
$route['parish/backup'] = 'parish/backup';
$route['parish/statistics'] = 'parish/statistics';
$route['parish/managedonation'] = 'parish/managedonation';
$route['parish/donations'] = 'parish/donations';
$route['parish/substations'] = 'parish/substations';
$route['parish/managesubstation'] = 'parish/managesubstation';
$route['parish/catechists'] = 'parish/catechists';
$route['parish/managecatechist'] = 'parish/managecatechist';
$route['parish/institutions'] = 'parish/institutions';
$route['parish/manageinstitution'] = 'parish/manageinstitution';
$route['parish/manageconventcommunity'] = 'parish/manageconventcommunity';
$route['parish/manageconvent'] = 'parish/manageconvent';
$route['parish/convents'] = 'parish/convents';
$route['parish/manageassociationmembers'] = 'parish/manageassociationmembers';
$route['parish/manageassociation'] = 'parish/manageassociation';
$route['parish/associations'] = 'parish/associations';
$route['parish/printcertificate'] = 'parish/printcertificate';
$route['parish/manageregister'] = 'parish/manageregister';
$route['parish/registers'] = 'parish/registers';
$route['parish/managemember'] = 'parish/managemember';
$route['parish/members'] = 'parish/members';
$route['parish/managefamily'] = 'parish/managefamily';
$route['parish/families'] = 'parish/families';
$route['parish/managescc'] = 'parish/managescc';
$route['parish/sccs'] = 'parish/sccs';
$route['parish/managelogin'] = 'parish/managelogin';
$route['parish/profile'] = 'parish/profile';
$route['parish/settheme'] = 'parish/settheme';
$route['parish/(:any)'] = 'parish/view/$1';


$route['checkMysqlConnectionAjax'] = 'setup/checkMysqlConnectionAjax';
$route['checkMysqlConnection'] = 'setup/checkMysqlConnection';
$route['checkdbexists'] = 'setup/checkdbexists';
$route['setup/backup'] = 'setup/backup';
$route['setup/getup'] = 'setup/getUpdations';
$route['setup/save'] = 'setup/savetofile';
$route['setup/productidexists'] = "setup/productidexists";
$route['setup/importdb'] = 'setup/importdb';
$route['setup/importDbFromFile']='setup/importDbFromFile';
$route['setup/dropDb'] = 'setup/dropDb';
$route['setup/createDb'] = 'setup/createDb';
$route['setup/register'] = 'setup/register';
$route['setup/about'] = 'setup/about';
$route['setup/database_config'] = 'setup/database_config';
$route['setup/(:any)'] = 'setup/view/$1';

$route['logout'] = 'home/logout';
$route['login'] = 'home/login';
$route['activateparish'] = 'home/activateparish';
$route['activeparishcheck'] = 'home/activeparishcheck';
$route['(:any)'] = 'home/view/$1';

$route['default_controller'] = 'setup/initialize';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
