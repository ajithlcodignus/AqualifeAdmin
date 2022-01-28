<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*------------------------------ APP DETAILS STARTS-----------------------------------*/


define('TAG_APP_NAME', 'DAYKART');

/*------------------------------ APP DETAILS END-----------------------------------*/



define('TAG_RESPONSE_DATA', 'response');
define('TAG_RESPONSE_STATUS', 'status');
define('HTTP_FAILURE_RESPONSE', 0);
define('HTTP_SUCCESS_RESPONSE', 1);
define('TAG_ERROR_STRING', 'error_string');
define('TAG_RESPONSE_DATA_STATUS', 'data_status');
define('TAG_DATA_ERROR_STRING', 'data_error_string');
define('TAG_SERVER_RESPONSE_DATA', 'server_response_data');


/*------------------------------Order Status-----------------------------------*/
define('TAG_ORDER_STATUS_ASSIGNED', 'Assigned');
define('TAG_ORDER_STATUS_RECEIVED', 'Received');
define('TAG_ORDER_STATUS_DELIVERED', 'Delivered');
define('TAG_ORDER_STATUS_CANCELLED', 'Cancelled');
/*------------------------------Order Status-----------------------------------*/


define('TAG_POPULAR_ITEMS', 'popular_items');
define('TAG_ORDER_LIST', 'order_list');
define('TAG_FAVORITE_ITEMS', 'favorite_items');
define('TAG_RECOMMENDED_ITEMS', 'recommended_items');
define('TAG_ALL_ITEMS', 'all_items');
define('TAG_SHOPS_LIST', 'shops_list');
define('TAG_ALL_CATEGORIES', 'all_categories');
define('TAG_USER', 'user');
define('TAG_CART_ITEMS', 'cart_items');
define('TAG_ITEM', 'item');
define('TAG_USER_ID', 'userId');
define('TAG_CART_ID', 'cartId');
define('TAG_ITEM_ID', 'itemId');
define('TAG_RESTAURANT_ID', 'restaurantId');
define('TAG_POPULAR_ITEM_FLAG', 'popularItemFlag');
define('TAG_RECOMMENDED_ITEM_FLAG', 'recommendedItemFlag');

define('TAG_NAME', 'name');
define('TAG_DESCRIPTION', 'description');
define('TAG_MOBILE', 'mobile');
define('TAG_EMAIL_ID', 'emailId');
define('TAG_SHOP_EMAIL_ID', 'shopEmailId');
define('TAG_PASSWORD', 'password');
define('TAG_ADDRESS', 'address');
define('TAG_FULL_ADDRESS', 'fullAddress');
define('TAG_HOUSE_NAME', 'houseName');
define('TAG_ADDRESS_ID', 'addressId');
define('TAG_PIN_CODE', 'pinCode');
define('TAG_LATITUDE', 'latitude');
define('TAG_LONGITUDE', 'longitude');
define('TAG_MINIMUM_ORDER', 'minimumOrder');
define('TAG_ENTRY_DATE', 'entryDate');
define('TAG_ORDER_DATE', 'orderDate');
define('TAG_FAVOURITEFLAG', 'favouriteFlag');
define('TAG_AMOUNT', 'amount');
define('TAG_QUANTITY', 'quantity');
define('TAG_TOTAL_AMOUNT', 'totalAmount');
define('TAG_PAYMENT_AMOUNT', 'paymentAmount');
define('TAG_DISCOUNT_AMOUNT', 'discountAmount');
define('TAG_PACKING_CHARGE', 'packingCharge');
define('TAG_DELIVERY_FEE', 'deliveryFee');
define('TAG_PAYMENT_MODE', 'paymentMode');
define('TAG_GST', 'gst');
define('TAG_CART_GST', 'cartGst');
define('TAG_TRANSACTION_ID', 'transactionId');
define('TAG_ORDER_ID', 'orderId');
define('TAG_SHOP_ID', 'shopId');
define('TAG_CART_SHOP_ID', 'cart_shop_id');
define('TAG_ADDRESS_TYPE', 'addressType');
define('TAG_ADDRESS_STATUS', 'addressStatus');
define('TAG_LANDMARK', 'landmark');
define('TAG_BANNER_LIST', 'banner_list');
define('TAG_ADDRESS_INFO', 'address_info');
define('TAG_ADDRESS_LIST', 'address_list');
define('TAG_BANNER_1', 'banner_1');
define('TAG_BANNER_2', 'banner_2');
define('TAG_BANNER_3', 'banner_3');
define('TAG_ACTIVE', 'active');
define('TAG_PUBLISH_FLAG', 'publishFlag');
define('TAG_AVAILABILITY_STATUS', 'availabilityStatus');

define('TAG_DELIVERY_BOY_ID', 'deliveryBoyId');
define('TAG_DELIVERY_BOY_NAME', 'deliveryBoyName');
define('TAG_CURRENT_ORDER_ID', 'currentOrderId');
define('TAG_SHOP_NAME', 'shopName');
define('TAG_ITEM_NAME', 'itemName');
define('TAG_USER_NAME', 'userName');
define('TAG_CURRENT_ORDER_DETAILS', 'current_order_details');
define('TAG_ORDER_STATUS', 'orderStatus');
define('TAG_GST_STATUS', 'gst_status');
define('TAG_CURRENT_SHOP_GST', 'currentShopGst');
define('TAG_GST_DATA', 'gst_data');
define('TAG_OTP', 'otp');
define('TAG_ITEMS_LIST', 'itemsList');
define('TAG_ACTIVE_ORDER', 'active_order');
define('TAG_REMARK', 'remark');
define('TAG_REMARKS', 'remarks');
define('TAG_USER_REMARK', 'userRemark');
define('TAG_RECEIVED_ORDERS', 'received_orders');
define('TAG_ASSIGNED_ORDERS', 'assigned_orders');
define('TAG_COMPLETED_ORDERS', 'completed_orders');
define('TAG_CANCELED_ORDERS', 'canceled_orders');
define('TAG_VERSION_CODE', 'versionCode');
define('TAG_APP_VERSION_CODE', 'appVersionCode');
define('TAG_LOCAL_DB_VERSION_CODE', 'localDbVersionCode');
define('TAG_TITLE', 'title');
define('TAG_BODY', 'body');
define('TAG_IMAGE', 'image');
define('TAG_ORDERS_LIST', 'orders_list');
define('TAG_CART_ACTIVE_ITEM', 'cartActiveItem');
define('TAG_DELIVERY_FEE_DETAILS', 'delivery_fee_details');
define('TAG_USER_MOBILE','userMobile');
define('TAG_CONTROLLER','controller');
define('TAG_ANDROID_APP_VERSION_CODE', 'androidAppVersionCode');
define('TAG_ORDER_COUNT','orderCount');
define('TAG_OTP_SENT_STATUS','otpSentStatus');
define('TAG_INSERT_STATUS','insertStatus');
define('TAG_OTP_SENT_COUNT','otpSentCount');
define('TAG_COUPON_DETAILS', 'coupon_details');
define('TAG_COUPON_STATUS', 'status');
define('TAG_COUPON_TYPE', 'couponType');
define('TAG_COUPON_PERCENTAGE', 'couponPercentage');
define('TAG_FIXED_AMOUNT', 'couponFixedAmount');
define('TAG_MIN_PURCHASE_AMOUNT', 'minPurchaseAmount');
define('TAG_MAX_DISCOUNT_AMOUNT', 'maxDiscountAmount');
define('TAG_COUPON_CODE', 'couponCode');
define('TAG_ORDER_COUNT_TYPE', 'orderCountType');
define('TAG_NUMBER_OF_ORDERS', 'numberOfOrders');
define('TAG_COUPON_DISCOUNT_AMOUNT', 'coupon_discount_amount');
define('TAG_OTP_LIMIT_EXCEEDED_TIME', 'otpLimitExceededTime');
define('TAG_AUTH_STRING', 'auth_string');
define('TAG_SPECIAL_OFFER_FLAG', 'specialOfferFlag');
define('TAG_FIRST_ORDER_FLAG', 'firstOrderFlag');
define('TAG_TOKEN', 'token');
define('TAG_NEW_USER', 'new_user');
define('TAG_ACTIVE_FLAG', 'activeFlag');
define('TAG_SHOP_CATEGORY_LIST', 'shop_category_list');
define('TAG_ADMIN_TOKEN', 'admin_token');
define('TAG_SHOP_LIST', 'shop_list');
define('TAG_ORDER_SHIPPING_DETAILS', 'order_shipping_details');
define('TAG_ORDER_SHIPPING_STATUS', 'shippingStatus');
define('TAG_ORDER_SHIPPING_REMARKS', 'remarks');
define('TAG_ORDER_SHIPPING_PRIORITY', 'priority');
define('TAG_SHIPPING_SELLER_NAME', 'sellerName');
define('TAG_SHIPPING_TYPE', 'shippingType');
define('TAG_DELIVERY_TIME', 'deliveryTime');
define('TAG_USER_LIST', 'user_list');
define('TAG_SHOP_ADMIN_DETAILS', 'shopadmin_details');
define('TAG_PROGRESS_BAR_STATUS', 'progressBarStatus');
define('TAG_USER_ROLE','userRole');
define('TAG_PLATFORM_TYPE','platform_type');

define('TAG_QUICK_ITEM_PRIORITY', 'quickItemPriority');
define('TAG_QUICK_ITEM_ID', 'quickItemId');
define('TAG_QUICK_ITEM_NAME', 'quickItemName');
define('TAG_QUICK_QUANTITY', 'quickQuantity');
define('TAG_QUICK_AMOUNT', 'quickAmount');
define('TAG_QUICK_ENTRY_DATE', 'quickEntryDate');

define('TAG_DELIVERY_BOY_COMMISSION','delivery_boy_commission');
define('TAG_FIREBASE_TOKEN','firebase_token');
define('TAG_PAID_STATUS','paidStatus');
define('TAG_CUSTOMER_PAID_STATUS','customerPaidStatus');
define('TAG_ASSIGN_FLAG', 'assignFlag');

define('TAG_ORDER_CANCEL_ID','orderCancelId');
define('TAG_USER_TYPE','userType');
define('TAG_CANCELLED_USER_ID', 'cancelledUserId');
define('TAG_ORDER_HASH_ID', 'orderHashId');

