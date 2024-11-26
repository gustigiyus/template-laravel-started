<?php

namespace App\Helpers;

use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;

class OrderStatusHelper
{
    public static function updateOrderStatus(Order $order, $newStatus)
    {
        // Define the order of statuses
        $statusOrder = [
            'Waiting',
            'In Process',
            'Cutting',
            'Embro Out',
            'Embro In',
            'Sewing Out',
            'Sewing In',
            'Run Del',
            'Completed'
        ];

        // Get the current and new statuses
        $currentStatus = $order->order_status;

        // Find the indices of the current and new statuses
        $currentIndex = array_search($currentStatus, $statusOrder);
        $newIndex = array_search($newStatus, $statusOrder);

        if ($currentIndex === false || $newIndex === false) {
            return false; // Return false if the status is not found in the statusOrder array
        }

        if ($newIndex > $currentIndex) {
            return true;
        } else {
            return false;
        }
    }
}
