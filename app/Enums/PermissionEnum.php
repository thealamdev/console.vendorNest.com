<?php

namespace App\Enums;

use App\Support\Traits\HasEnumsCollection;

enum PermissionEnum: string
{
    use HasEnumsCollection;

        // Platform
    case PLATFORM_MANAGE = 'platform.manage';
    case SETTINGS_UPDATE = 'settings.update';
    case ANALYTICS_VIEW = 'analytics.view';

        // User
    case USER_VIEW = 'user.view';
    case USER_CREATE = 'user.create';
    case USER_UPDATE = 'user.update';
    case USER_DELETE = 'user.delete';

        // Role
    case ROLE_VIEW = 'role.view';
    case ROLE_CREATE = 'role.create';
    case ROLE_UPDATE = 'role.update';
    case ROLE_DELETE = 'role.delete';
    case ROLE_ASSIGN = 'role.assign';

        // Permission
    case PERMISSION_VIEW = 'permission.view';

        // Organization
    case ORGANIZATION_VIEW = 'organization.view';
    case ORGANIZATION_CREATE = 'organization.create';
    case ORGANIZATION_UPDATE = 'organization.update';
    case ORGANIZATION_DELETE = 'organization.delete';
    case ORGANIZATION_SWITCH = 'organization.switch';

        // Member
    case MEMBER_VIEW = 'member.view';
    case MEMBER_INVITE = 'member.invite';
    case MEMBER_UPDATE = 'member.update';
    case MEMBER_REMOVE = 'member.remove';

        // Vendor
    case VENDOR_VIEW = 'vendor.view';
    case VENDOR_APPROVE = 'vendor.approve';
    case VENDOR_REJECT = 'vendor.reject';
    case VENDOR_SUSPEND = 'vendor.suspend';

        // Product
    case PRODUCT_VIEW = 'product.view';
    case PRODUCT_CREATE = 'product.create';
    case PRODUCT_UPDATE = 'product.update';
    case PRODUCT_DELETE = 'product.delete';
    case PRODUCT_APPROVE = 'product.approve';
    case PRODUCT_REJECT = 'product.reject';

        // Category
    case CATEGORY_VIEW = 'category.view';
    case CATEGORY_CREATE = 'category.create';
    case CATEGORY_UPDATE = 'category.update';
    case CATEGORY_DELETE = 'category.delete';

        // Order
    case ORDER_VIEW = 'order.view';
    case ORDER_MANAGE = 'order.manage';
    case ORDER_UPDATE_STATUS = 'order.update_status';
    case ORDER_CANCEL = 'order.cancel';

        // Payment
    case PAYMENT_VIEW = 'payment.view';
    case PAYMENT_MANAGE = 'payment.manage';
    case PAYMENT_REFUND = 'payment.refund';

        // Transaction
    case TRANSACTION_VIEW = 'transaction.view';

        // Payout
    case PAYOUT_VIEW = 'payout.view';
    case PAYOUT_PROCESS = 'payout.process';

        // Report
    case REPORT_VIEW = 'report.view';
    case REPORT_EXPORT = 'report.export';

        // Notification
    case NOTIFICATION_VIEW = 'notification.view';
    case NOTIFICATION_SEND = 'notification.send';

        // Support
    case SUPPORT_VIEW = 'support.view';
    case SUPPORT_REPLY = 'support.reply';
    case SUPPORT_CLOSE = 'support.close';
}
