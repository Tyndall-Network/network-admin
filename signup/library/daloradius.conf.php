<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@enginx.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 * Description:
 *              daloRADIUS Paypal registration codebase
 *
 * Modification Date:
 *              Sat Sep 13 03:14:23 EDT 2008
 *********************************************************************************************************
 */


$configValues['CONFIG_DB_ENGINE'] = 'mysqli';
$configValues['CONFIG_DB_HOST'] = '127.0.0.1';
$configValues['CONFIG_DB_USER'] = 'Bram';
$configValues['CONFIG_DB_PASS'] = 'Bram1!';
$configValues['CONFIG_DB_NAME'] = 'radius_users';
$configValues['CONFIG_DB_TBL_RADCHECK'] = 'radcheck';
$configValues['CONFIG_DB_TBL_RADREPLY'] = 'radreply';
$configValues['CONFIG_DB_TBL_RADGROUPREPLY'] = 'radgroupreply';
$configValues['CONFIG_DB_TBL_RADGROUPCHECK'] = 'radgroupcheck';
$configValues['CONFIG_DB_TBL_RADUSERGROUP'] = 'radusergroup';
$configValues['CONFIG_DB_TBL_RADNAS'] = 'nas';
$configValues['CONFIG_DB_TBL_RADPOSTAUTH'] = 'radpostauth';
$configValues['CONFIG_DB_TBL_RADACCT'] = 'radacct';
$configValues['CONFIG_DB_TBL_RADIPPOOL'] = 'radippool';
$configValues['CONFIG_DB_TBL_DALOOPERATOR'] = 'operators';
$configValues['CONFIG_DB_TBL_DALOBILLINGRATES'] = 'rates';
$configValues['CONFIG_DB_TBL_DALOHOTSPOTS'] = 'hotspots';
$configValues['CONFIG_DB_TBL_DALOUSERINFO'] = 'userinfo';
$configValues['CONFIG_DB_TBL_DALODICTIONARY'] = 'dictionary';
$configValues['CONFIG_DB_TBL_DALOREALMS'] = 'realms';
$configValues['CONFIG_DB_TBL_DALOPROXYS'] = 'proxys';
$configValues['CONFIG_DB_TBL_DALOBILLINGPAYPAL'] = 'billing_paypal';
$configValues['CONFIG_DB_TBL_DALOBILLINGPLANS'] = 'billing_plans';
$configValues['CONFIG_DB_TBL_DALOBILLINGMERCHANT'] = 'billing_merchant';
$configValues['CONFIG_DB_TBL_DALOUSERBILLINFO'] = 'userbillinfo';
$configValues['CONFIG_LANG'] = 'en';
$configValues['CONFIG_LOG_PAYPAL_IPN_FILENAME'] = '/tmp/paypal-transactions.log';
$configValues['CONFIG_MERCHANT_IPN_SECRET'] = '';
//$configValues['CONFIG_MERCHANT_WEB_PAYMENT'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
//$configValues['CONFIG_MERCHANT_IPN_URL_ROOT'] = 'https://portal.daloradius.com/signup-paypal';
$configValues['CONFIG_MERCHANT_IPN_URL_RELATIVE_DIR'] = 'paypal-ipn.php';
$configValues['CONFIG_MERCHANT_IPN_URL_RELATIVE_SUCCESS'] = 'success.php';
$configValues['CONFIG_MERCHANT_IPN_URL_RELATIVE_FAILURE'] = 'cancelled.php';
$configValues['CONFIG_MERCHANT_BUSINESS_ID'] = 'welbram@gmail.com';
$configValues['CONFIG_LOG_MERCHANT_IPN_FILENAME'] = '/tmp/mpesa-transactions.log';
$configValues['CONFIG_MERCHANT_SUCCESS_MSG_PRE'] = "Dear customer, we thank you for completing your payment.<br/><br/>".
                        "It takes a couple of seconds to validate your payment ".
                        "and <b>activate</b> your account.<br/><br/>".
                        "Please be patient, this web page will refresh automatically every 5 seconds.";
$configValues['CONFIG_MERCHANT_SUCCESS_MSG_POST'] = "Use your Phone Number as Your Username and the Provided Password.<br/>".
                                        "Login to start your surfing";
$configValues['CONFIG_MERCHANT_SUCCESS_MSG_HEADER'] = "Account Created!!<br/>";
$configValues['CONFIG_USER_ALLOWEDRANDOMCHARS'] = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789";
$configValues['CONFIG_USERNAME_LENGTH'] = "8";		/* the length of the random username to generate */
$configValues['CONFIG_PASSWORD_LENGTH'] = "8";		/* the length of the random password to generate */
?>
