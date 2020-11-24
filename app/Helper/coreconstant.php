<?php

// LOT Status
const WAREHOUSE_STATUS_ACTIVE=1;
const WAREHOUSE_STATUS_INACTIVE=2;

const DISCOUNT_TYPE_FLAT=1;
const DISCOUNT_TYPE_PERCENTAGE=2;

//product Type
const PRODUCT_TYPE_PHYSICAL=1;
const PRODUCT_TYPE_DOWNLOADABLE=2;
// Discount Type
const PRODUCT_DISCOUNT_TYPE_FLAT=1;
const PRODUCT_DISCOUNT_TYPE_RATIONAL=2;

//STATUS
const STATUS_ACTIVE = 1;
const STATUS_DEACTIVE = 2;

//Captcha
const CAPTCHA_ON =1;
const CAPTCHA_OFF =2;
// Stockable
const STOCKABLE_NO=0;
const STOCKABLE_YES=1;


const USER_ROLE_SUPERADMIN = 1;
const USER_ROLE_ADMIN = 2;
const USER_ROLE_SELLER = 3;
const USER_ROLE_GUEST = 4;
const USER_ROLE_CUSTOMER = 5;
const USER_ROLE_AGENT = 6;
const USER_ROLE_DEALER = 7;

// Paginate
const PAGINATE_SMALL=10;
const PAGINATE_MEDIUM=20;
const PAGINATE_LARGE=50;

// category Status
const CATEGORY_ACTIVE=1;
const CATEGORY_INACTIVE=2;
//Slider Status
const SLIDER_ACTIVE=1;
const SLIDER_INACTIVE=2;
//Attribute
const ATTRIBUTE_ACTIVE=1;
const ATTRIBUTE_INACTIVE=2;
// product type
const PRODUCT_TYPE_SINGLE=1;
const PRODUCT_TYPE_VARIABLE=2;




const ORDER_TYPE_PENDING = 1;
const ORDER_TYPE_APPROVED = 2;
const ORDER_TYPE_REJECTED = 3;
const ORDER_TYPE_PAUSED = 4;
const ORDER_TYPE_DELEVERED = 5;
const ORDER_TYPE_SHIPPING = 6;

const PRODUCT_STATUS_INACTIVE = 0;
const PRODUCT_STATUS_PUBLISHED = 1;
const PRODUCT_STATUS_PAUSED = 3;


const USER_STATUS_PENDING = 0;
const USER_STATUS_DELETED = 1;
const USER_STATUS_SUSPENDED = 2;
const USER_STATUS_APPROVED = 3;

const USER_IS_CUSTOMER =2;
const USER_IS_SELLER=2;

const USER_EMAIL_VERIFIED = 1;
const USER_EMAIL_PENDING = 0;

const TRANSACTION_TYPE_BUYPIN = 1;
const TRANSACTION_TYPE_BUYPRODUCT = 2;
const TRANSACTION_TYPE_UNILEVELREFERRAL = 3;
const TRANSACTION_TYPE_SELLERWALLETWITHDRAWL = 4;
const TRANSACTION_TYPE_WALLET_DEPOSITE = 5;

const MENU_STATUS_ACTIVE = 1;
const MENU_STATUS_INACTIVE = 2;

const CUPON_STATUS_ACTIVE = 1;
const CUPON_STATUS_INACTIVE = 0;

// Actions
const ACTION_DASHBOARD_VIEW = 'action_dashboard_view';
const ACTION_USER_VIEW = 'action_user_view';
const ACTION_USER_ADD = 'action_user_add';
const ACTION_USER_EDIT = 'action_user_edit';
const ACTION_USER_DELETE = 'action_user_delete';

const ACTION_ROLE_VIEW = 'action_role_view';
const ACTION_ROLE_ADD = 'action_role_add';
const ACTION_ROLE_EDIT = 'action_role_edit';
const ACTION_ROLE_DELETE = 'action_role_delete';

const ACTION_LOT_VIEW = 'action_lot_view';
const ACTION_LOT_ADD = 'action_lot_add';
const ACTION_LOT_EDIT = 'action_lot_edit';
const ACTION_LOT_DELETE = 'action_lot_delete';

const ACTION_PRODUCT_VIEW = 'action_product_view';
const ACTION_PRODUCT_ADD = 'action_product_add';
const ACTION_PRODUCT_EDIT = 'action_product_edit';
const ACTION_PRODUCT_DELETE = 'action_product_delete';

const ACTION_SUPPLIER_VIEW = 'action_supplier_view';
const ACTION_SUPPLIER_ADD = 'action_supplier_add';
const ACTION_SUPPLIER_EDIT = 'action_supplier_edit';
const ACTION_SUPPLIER_DELETE = 'action_supplier_delete';

const ACTION_BRAND_VIEW = 'action_brand_view';
const ACTION_BRAND_ADD = 'action_brand_add';
const ACTION_BRAND_EDIT = 'action_brand_edit';
const ACTION_BRAND_DELETE = 'action_brand_delete';

const ACTION_CATEGORY_VIEW = 'action_category_view';
const ACTION_CATEGORY_ADD = 'action_category_add';
const ACTION_CATEGORY_EDIT = 'action_category_edit';
const ACTION_CATEGORY_DELETE = 'action_category_delete';

const ACTION_WAREHOUSE_VIEW = 'action_warehouse_view';
const ACTION_WAREHOUSE_ADD = 'action_warehouse_add';
const ACTION_WAREHOUSE_EDIT = 'action_warehouse_edit';
const ACTION_WAREHOUSE_DELETE = 'action_warehouse_delete';

const ACTION_CUPON_VIEW = 'action_cupon_view';
const ACTION_CUPON_ADD = 'action_cupon_add';
const ACTION_CUPON_EDIT = 'action_cupon_edit';
const ACTION_CUPON_DELETE = 'action_cupon_delete';

const ACTION_SELL_PRODUCT = 'action_sell_product';
const ACTION_CSV_UPLOAD = 'action_csv_upload';
const ACTION_EXCEL_UPLOAD = 'action_excel_upload';
const ACTION_SETTINGS = 'settings';
const ACTION_REPORT = 'report';

