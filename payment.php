<?php
include 'action.php';
$program_id = $_POST['program_id'];
$application_id = $_POST['application_id'];
$user_id = $_POST['user_id'];
$select1 = "SELECT * FROM program WHERE id = '$program_id'";
$select1_query = $conn->query($select1);
$row = $select1_query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .payment-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-icons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-icons img {
            width: 50px;
            height: auto;
        }

        .btn-pay {
            background-color: #28a745;
            color: white;
            width: 100%;
            padding: 10px;
        }

        .btn-pay:hover {
            background-color: #218838;
        }

        .form-label {
            font-weight: bold;
        }

        input[type="text"]::placeholder {
            font-size: 14px;
        }

        .expiry-group {
            display: flex;
            gap: 10px;
        }

        select {
            padding: 5px;
            font-size: 16px;
            width: 100%;
        }
    </style>
</head>

<body>
    
    <div class="payment-container">
    <h3 class="text-center mb-4">Payment Details</h3>

<h5 class="text-center my-2">
    <?php 
    // Concatenate 'ID: 24' with $application_id and $program_id, adding a space between them
    echo 'ID: 24' . htmlspecialchars($application_id) . htmlspecialchars($program_id); 
    ?>
</h5>

        <!-- Card Icons (Visa, MasterCard, etc.) -->
        <div class="card-icons">
            <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
            <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="MasterCard">
            <img src="https://img.icons8.com/color/48/000000/amex.png" alt="Amex">
            <img src="https://img.icons8.com/color/48/000000/paypal.png" alt="PayPal">
        </div>

        <!-- Payment Form -->
         
        <form method="post" action="payment-check.php" >
            <!-- Card Number with auto spacing -->
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
            </div>

            <!-- Name on Card -->
            <div class="mb-3">
                <label for="cardName" class="form-label">Name on Card</label>
                <input type="text" class="form-control" id="cardName" placeholder="John Doe">
            </div>

            <!-- Expiry Date and CVV -->
            <div class="expiry-group mb-3">
                <div class="w-50">
                    <label for="expiryMonth" class="form-label">Expiry Month</label>
                    <select id="expiryMonth" class="form-select">
                        <option value="" disabled selected>MM</option>
                        <option value="01">01 - January</option>
                        <option value="02">02 - February</option>
                        <option value="03">03 - March</option>
                        <option value="04">04 - April</option>
                        <option value="05">05 - May</option>
                        <option value="06">06 - June</option>
                        <option value="07">07 - July</option>
                        <option value="08">08 - August</option>
                        <option value="09">09 - September</option>
                        <option value="10">10 - October</option>
                        <option value="11">11 - November</option>
                        <option value="12">12 - December</option>
                    </select>
                </div>
                <div class="w-50">
                    <label for="expiryYear" class="form-label">Expiry Year</label>
                    <select id="expiryYear" class="form-select">
                        <option value="" disabled selected>YY</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                    </select>
                </div>
            </div>

            <!-- CVV -->
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3">
            </div>

            <!-- Amount Field -->
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" class="form-control" id="amount" value="<?php echo $row['fees']  ?>" readonly>
            </div>

            <input type="hidden" name="application_id" value="<?php echo $application_id?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id?>">
            <button type="submit" class="btn btn-pay">Pay Now</button>
            
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-format the card number with spaces every 4 digits
        document.getElementById('cardNumber').addEventListener('input', function(e) {
            let cardNumber = e.target.value.replace(/\D/g, '');
            if (cardNumber.length > 16) {
                cardNumber = cardNumber.slice(0, 16);
            }
            e.target.value = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 ');
        });
    </script>
</body>

</html>
