<?php

if (isset($_POST['submit'])) {
    require 'conn.php';

    $QDate = $_POST['QDate'];
    $QNumber = $_POST['QNumber'];
    $QStatus =  $_POST['QStatus'];

    // $stmt = $conn->prepare("UPDATE  Customer SET Name=:Name, Email=:Email WHERE CustomerID=:CustomerID");
    $stmt = $conn->prepare(
        'UPDATE queue
    SET QStatus = :QStatus 
    WHERE QDate = :QDate AND QNumber = :QNumber'
    );

    $stmt->bindParam(':QNumber', $QNumber);
    $stmt->bindParam(':QDate', $QDate);
    $stmt->bindParam(':QStatus', $QStatus);
    $stmt->execute();

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() >= 0) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update customer information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}
