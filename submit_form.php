<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name, email, phone, and message are provided
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["message"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];
        
        // Save the uploaded file
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($_FILES["attachment"]["name"]);

        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $uploadFile)) {
            // Append customer information to customers.txt
            $customerInfo = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message\nFile: $uploadFile\n";
            file_put_contents('customers.txt', $customerInfo, FILE_APPEND);
            // Add separator
            file_put_contents('customers.txt', "_______________________________\n", FILE_APPEND);
            echo "<script>alert('Form submitted successfully!'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Failed to upload file.');</script>";
        }
    } else {
        echo "<script>alert('Name, email, phone, or message is missing.');</script>";
    }
}
?>
