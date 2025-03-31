<?php
    session_start();
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $coffeeValue = isset($_POST['coffee']) ? $_POST['coffee'] : null;
    //     echo "<p>Coffee received value: " . htmlspecialchars($coffeeValue) . "</p>";
    //     $milkValue = isset($_POST['milk']) ? $_POST['milk'] : null;
    //     echo "<p>Milk received value: " . htmlspecialchars($milkValue) . "</p>";
    // }
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <title>MILK COFFEE</title>
    <h1>MILK COFFEE</h1>
</head>

<body lang="en">
<form onsubmit="return false">
    <label for="coffee">Coffee:</label>
        <input type="range" id="coffee" name="coffee" min="0" max="1000" value="<?php echo isset($_POST['coffee']) ? $_POST['coffee'] : 500; ?>"
               oninput="updateValueCF(this.value)">
        <output id="coffeeValue"><?php echo isset($_POST['coffee']) ? htmlspecialchars($_POST['coffee']) : 500; ?></output>
        <br>
    <label for="milk">Milk:</label>
        <input type="range" id="milk" name="milk" min="0" max="1000" value="<?php echo isset($_POST['milk']) ? $_POST['milk'] : 500; ?>"
               oninput="updateValueML(this.value)">
        <output id="milkValue"><?php echo isset($_POST['milk']) ? htmlspecialchars($_POST['milk']) : 500; ?></output>
    <br>
    <input type="submit" value="Submit">
    <script>
        // Update displayed value in real-time
        function updateValueCF(val) {
            document.getElementById('coffeeValue').textContent = val;
        }
        function updateValueML(val) {
            document.getElementById('milkValue').textContent = val;
        }
        document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("submitBtn").onclick = async function() {
                    await sendIngredientQuantity()
                }
            })

            async function sendIngredientQuantity() {
                const sugarValue = document.getElementById("milkValue").textContent
                const coffeeValue = document.getElementById("coffeeValue").textContent
                const response = await fetch('http://127.0.0.1:8085/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        milk: milkValue,
                        coffee: coffeeValue
                    })
                })
                if (response.ok) alert('POST ok')
                else {
                    console.log(response.status)
                }
            }
    </script>
</form>
</body>
</html>