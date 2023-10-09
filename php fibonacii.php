<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci Series</title>
</head>
<body>
    <h1>Fibonacci Series in PHP</h1>

    <form method="POST">
        <label for="n">Enter the number of terms:</label>
        <input type="number" name="n" id="n" required>
        <br>
        <input type="submit" value="Generate Fibonacci Series">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = (int)$_POST["n"];
        $a = 0;
        $b = 1;

        echo "<h2>Fibonacci Series:</h2>";

        for ($i = 1; $i <= $n; $i++) {
            echo $a . ", ";

            $temp = $a;
            $a = $b;
            $b = $temp + $b;
        }
    }
    ?>
</body>
</html>
