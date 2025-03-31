<?php
    session_start();
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $teaValue = isset($_POST['tea']) ? $_POST['tea'] : null;
    //     echo "<p>Tea received value: " . htmlspecialchars($teaValue) . "</p>";
    //     $sugarValue = isset($_POST['sugar']) ? $_POST['sugar'] : null;
    //     echo "<p>Sugar received value: " . htmlspecialchars($sugarValue) . "</p>";
    // }
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <title>TEA</title>
    <h1>TEA</h1>
</head>

<body lang="en">
<form 
    action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    method="POST"
    >
    <label for="tea">tea:</label>
        <input type="range" id="tea" name="tea" min="0" max="1000" value="<?php echo isset($_POST['tea']) ? $_POST['tea'] : 500; ?>"
               oninput="updateValueCF(this.value)">
        <output id="teaValue"><?php echo isset($_POST['tea']) ? htmlspecialchars($_POST['tea']) : 500; ?></output>
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
            document.getElementById('teaValue').textContent = val;
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
                const milkValue = document.getElementById("milkValue").textContent
                const coffeeValue = document.getElementById("coffeeValue").textContent
                const response = await fetch('http://127.0.0.1:8085/pumphandle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        sugar: milkValue,
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