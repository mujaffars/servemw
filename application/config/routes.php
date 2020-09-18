<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = '';
$route['404_override'] = 'welcome/overridePage';
$route['translate_uri_dashes'] = FALSE;
$route['test'] = 'Welcome/test';

/* * ** MotoWorks Routes *** */
//$route['addcustomer']='Motowork/addcustomer';

/* * ********************************************************************************************************** */

$route['avoidCI'] = ['Welcome', 'Login_Controller']; //
/* Login Route */
$route['UserLogin'] = "Authenticate_Controller/Login_Controller/UserLogin";

$route['encdnc'] = "Welcome/encdnc";
$route['getdata'] = "Welcome/getdata";

// $route['logout'] 			= "Authenticate_Controller/Login_Controller/logout";
//Creat Deal Route
$route['createDeal'] = "Transaction_Controller/Transaction_Controller/createDeal";

$route['dashboardDtl'] = "MwTransaction_Controller/MwTransaction_Controller/dashboardDtl";
$route['createCustomer'] = "MwTransaction_Controller/MwTransaction_Controller/createCustomer";
$route['listCustomer'] = "MwTransaction_Controller/MwTransaction_Controller/listCustomer";
$route['deleteCustomer'] = "MwTransaction_Controller/MwTransaction_Controller/deleteCustomer";
$route['updateCustomer'] = "MwTransaction_Controller/MwTransaction_Controller/updateCustomer";
$route['searchCustomer'] = "MwTransaction_Controller/MwTransaction_Controller/searchCustomer";
$route['getCustomerAutocomp'] = "MwTransaction_Controller/MwTransaction_Controller/getCustomerAutocomp";
$route['listReminders'] = "MwTransaction_Controller/MwTransaction_Controller/listReminders";

$route['createInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/createInvoice";
$route['listInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/listInvoice";
$route['getInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/getInvoice";
$route['searchInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/searchInvoice";
$route['deleteInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/deleteInvoice";
$route['editInvoice'] = "MwTransaction_Controller/MwInvoice_Controller/editInvoice";

