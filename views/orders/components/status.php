<?php
	$status_label_class = "";
	if (isset($order)) {
		switch($order->status) {
			case Order::PENDING: $status_label_class = "default";break;
			case Order::APPROVED: $status_label_class = "primary";break;
			case Order::DELIVERED: $status_label_class = "success";break;
			case Order::CANCELLED: $status_label_class = "warning";break;
			case Order::ERROR: $status_label_class = "danger";break;
		}
	}
?>