<?php
include 'connectdb.php';

// Get all orders
function getAllOrders(){
    $conn = Connect();

    $query = "
        SELECT 
            invoice.inv_number AS invoice_id,
            invoice.inv_date,
            invoice.inv_subtotal,
            invoice.inv_tax,
            invoice.inv_total,
            CONCAT(customer.cus_fname, ' ', customer.cus_lname) AS customer_name
        FROM invoice
        INNER JOIN customer 
        ON invoice.cus_code = customer.cus_code
        ORDER BY invoice.inv_number DESC
    ";

    $result = $conn->query($query);
    $data = [];

    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    $conn->close();
    return $data;
}

// Search orders by invoice # or customer name
function findOrders($search){
    $conn = Connect();

    $query = "
        SELECT 
            invoice.inv_number AS invoice_id,
            invoice.inv_date,
            invoice.inv_subtotal,
            invoice.inv_tax,
            invoice.inv_total,
            CONCAT(customer.cus_fname, ' ', customer.cus_lname) AS customer_name
        FROM invoice
        INNER JOIN customer 
        ON invoice.cus_code = customer.cus_code
        WHERE invoice.inv_number LIKE '%$search%'
           OR customer.cus_fname LIKE '%$search%'
           OR customer.cus_lname LIKE '%$search%'
    ";

    $result = $conn->query($query);
    $data = [];

    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    $conn->close();
    return $data;
}
?>
