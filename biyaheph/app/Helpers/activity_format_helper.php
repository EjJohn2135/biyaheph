<?php

if (! function_exists('activity_format')) {
    function activity_format(string $action, $details = null): array
    {
        $key = strtolower((string)$action);
        if (is_string($details)) {
            $decoded = json_decode($details, true);
            if (json_last_error() === JSON_ERROR_NONE) $details = $decoded;
        }
        $get = fn($k, $d=null) => (is_array($details) && array_key_exists($k, $details)) ? $details[$k] : $d;

        $mappings = [
            '/register|create_account|account_registered/' => ['label'=>'Create Account','icon'=>'fa-user-plus','class'=>'action-create','desc'=> fn() => $get('user_name',$get('name','New account created'))],
            '/login_success|login_successful/' => ['label'=>'Login','icon'=>'fa-sign-in-alt','class'=>'action-auth','desc'=> fn() => $get('user_name','User logged in')],
            '/login_failed/' => ['label'=>'Failed Login','icon'=>'fa-ban','class'=>'action-reject','desc'=> fn() => "Failed login for ".$get('username','unknown')],
            '/create_package|package_created/' => ['label'=>'Create Package','icon'=>'fa-plus-circle','class'=>'action-create','desc'=> fn() => "Created package «".$get('package_name',$get('name','')) ."»"],
            '/edit_package|package_updated/' => ['label'=>'Edit Package','icon'=>'fa-edit','class'=>'action-edit','desc'=> fn() => "Updated package «".$get('package_name',$get('name','')) ."»"],
            '/delete_package|package_deleted/' => ['label'=>'Delete Package','icon'=>'fa-trash','class'=>'action-delete','desc'=> fn() => "Deleted package «".$get('package_name',$get('name','')) ."»"],
            '/booking_created|create_booking/' => ['label'=>'Create Booking','icon'=>'fa-calendar-plus','class'=>'action-create','desc'=> fn() => "Created booking #".$get('booking_ref',$get('id',''))],
            '/payment_success|payment_completed/' => ['label'=>'Payment Received','icon'=>'fa-credit-card','class'=>'action-create','desc'=> fn() => "Payment ".$get('amount','')." for ".$get('booking_ref','')],
            '/admin_approved|approve_admin/' => ['label'=>'Admin Approved','icon'=>'fa-check-circle','class'=>'action-approve','desc'=> fn() => "Approved admin ID ".$get('target_id',$get('user_id',''))],
            '/admin_rejected|reject_admin/' => ['label'=>'Admin Rejected','icon'=>'fa-times-circle','class'=>'action-reject','desc'=> fn() => "Rejected admin ID ".$get('target_id',$get('user_id',''))],
            '/logout/' => ['label'=>'Logout','icon'=>'fa-sign-out-alt','class'=>'action-auth','desc'=> fn() => $get('user_name','User logged out')],
            '/toggle_maintenance|enable_maintenance|disable_maintenance/' => [
                'label' => 'Maintenance Mode',
                'icon' => 'fa-tools',
                'class' => 'action-edit',
                'desc' => fn() => $get('action') === 'enabled' ? 'Maintenance mode enabled' : ($get('action') === 'disabled' ? 'Maintenance mode disabled' : 'Maintenance mode toggled')
            ],
            // generic fallbacks
            '/create|created|add|new/' => ['label'=>'Create','icon'=>'fa-plus','class'=>'action-create','desc'=> fn() => 'Created record'],
            '/update|edit|modified/' => ['label'=>'Update','icon'=>'fa-edit','class'=>'action-edit','desc'=> fn() => 'Updated record'],
            '/delete|removed|destroy/' => ['label'=>'Delete','icon'=>'fa-trash','class'=>'action-delete','desc'=> fn() => 'Deleted record'],
            '/get|view|visited|access/' => ['label'=>'Visited Page','icon'=>'fa-eye','class'=>'action-view','desc'=> fn() => $get('path','Visited a page')],
        ];

        foreach ($mappings as $pat => $meta) {
            if (preg_match($pat, $key)) {
                // Resolve label if it's callable
                $label = is_callable($meta['label']) ? $meta['label']() : $meta['label'];
                
                return [
                    'label' => $label,
                    'description' => is_callable($meta['desc']) ? $meta['desc']() : $meta['desc'],
                    'icon' => $meta['icon'],
                    'class' => $meta['class'],
                ];
            }
        }

        // default
        return [
            'label' => ucwords(str_replace(['_','-'], ' ', $key)),
            'description' => $get('description',''),
            'icon' => 'fa-info-circle',
            'class' => 'action-view',
        ];
    }
}