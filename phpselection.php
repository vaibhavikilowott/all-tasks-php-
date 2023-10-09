<!DOCTYPE html>
<html>
<head>
    <title>Selection Sort</title>
</head>
<body>
    <h1>Selection Sort in PHP</h1>

    <?php
    function selectionSort(&$arr) {
        $n = count($arr);

        for ($i = 0; $i < $n - 1; $i++) {
            $minIndex = $i; // Assume the current index has the minimum value

            // Find the index of the minimum element in the unsorted portion
            for ($j = $i + 1; $j < $n; $j++) {
                if ($arr[$j] < $arr[$minIndex]) {
                    $minIndex = $j;
                }
            }

            // Swap the minimum element with the first element of the unsorted portion
            $temp = $arr[$i];
            $arr[$i] = $arr[$minIndex];
            $arr[$minIndex] = $temp;
        }
    }

    $sorted = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["elements"])) {
        $elements = $_POST["elements"];
        
        // Remove leading and trailing spaces and validate format
        $elements = trim($elements);
        if (!preg_match('/^\d+(,\d+)*$/', $elements)) {
            echo "Invalid format. Enter elements in a comma-separated format (e.g., 1,2,3).<br>";
        } else {
            $elementsArray = explode(",", $elements);

            // Validate elements
            $isValid = true;
            foreach ($elementsArray as $element) {
                if (!is_numeric($element)) {
                    $isValid = false;
                    echo "Invalid element: $element<br>";
                }
            }

            if ($isValid) {
                echo "Original array: ";
                foreach ($elementsArray as $element) {
                    echo $element . " ";
                }
                echo "<br>";

                selectionSort($elementsArray);

                echo "Sorted array: ";
                foreach ($elementsArray as $element) {
                    echo $element . " ";
                }
                echo "<br>";

                $sorted = true;
            }
        }
    }

    if (!$sorted) {
    ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="elements">Enter elements (comma-separated):</label>
        <input type="text" name="elements" id="elements">
        <input type="submit" value="Sort">
    </form>
    <?php
    }
    ?>
</body>
</html>
