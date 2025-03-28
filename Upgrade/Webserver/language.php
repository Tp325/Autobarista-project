<?php
    session_start();
    if(isset($_POST['submit'])){
        switch($_POST['myDropdown']){
            case 'English':
                header('Location: ./EN-en/welcome.php');
                break;
            case 'Tiếng Việt':
                header('Location: ./VN-vn/welcome.php');
                break;
            case '中文（简体）':
                header('Location: ./CN-cn/welcome.php');
                break;
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>AUTO BARISTA MACHINE</title>
    <h1> Welcome to Auto Barista Machine</h1>
</head>

<body>
<form 
    action="<?php echo 
        htmlspecialchars($_SERVER['PHP_SELF']); ?>"
    method="POST"
    >
    <label for="myDropdown">Choose a language:</label>
    <select id="myDropdown" name="myDropdown">
    <option value="English">English</option>
    <option value="Tiếng Việt">Tiếng Việt</option>
    <option value="中文（简体）">中文（简体）</option>
</select>
<br><br>
<button type="submit" value="Submit" name="submit">Submit Button</button>
</form>
</body>
</html>
