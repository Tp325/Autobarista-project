<?php
session_start();
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $coffeeValue = isset($_POST['coffee']) ? $_POST['coffee'] : null;
//     echo "<p>Coffee received value: " . htmlspecialchars($coffeeValue) . "</p>";
//     $sugarValue = isset($_POST['sugar']) ? $_POST['sugar'] : null;
//     echo "<p>Sugar received value: " . htmlspecialchars($sugarValue) . "</p>";

//     $gpio_pin = $_POST['coffee'];       // Example GPIO pin number
//     $time_duration = $_POST['sugar'];   // Example time duration in seconds
//     // Output the data as JSON
//     echo json_encode([
//         'gpio_pin' => $gpio_pin,
//         'time_duration' => $time_duration
//     ]);
// }
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <title>COFFEE</title>
    <h1>COFFEE</h1>
</head>

<body lang="en">
    <form onsubmit="return false">

        <label for="coffee">Coffee:</label>
        <input type="range" id="coffee" name="coffee" min="0" max="1000" value="<?php echo isset($_POST['coffee']) ? $_POST['coffee'] : 500; ?>"
            oninput="updateValueCF(this.value)">
        <output id="coffeeValue"><?php echo isset($_POST['coffee']) ? htmlspecialchars($_POST['coffee']) : 500; ?></output>
        <br>
        <label for="sugar">Sugar:</label>
        <input type="range" id="sugar" name="sugar" min="0" max="1000" value="<?php echo isset($_POST['sugar']) ? $_POST['sugar'] : 500; ?>"
            oninput="updateValueSG(this.value)">
        <output id="sugarValue"><?php echo isset($_POST['sugar']) ? htmlspecialchars($_POST['sugar']) : 500; ?></output>
        <br>
        <input id="submitBtn" type="submit" value="Submit">
        <script>
            // Update displayed value in real-time
            function updateValueCF(val) {
                document.getElementById('coffeeValue').textContent = val;
            }

            function updateValueSG(val) {
                document.getElementById('sugarValue').textContent = val;
            }

            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("submitBtn").onclick = async function() {
                    await sendIngredientQuantity()
                }
            })

            async function sendIngredientQuantity() {
                const sugarValue = document.getElementById("sugarValue").textContent
                const coffeeValue = document.getElementById("coffeeValue").textContent
                const response = await fetch('http://127.0.0.1:8085/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        sugar: sugarValue,
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