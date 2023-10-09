<!DOCTYPE html>
<html>
<head>
    <title>Bubble Sort</title>
</head>
<body>
    <h1>Bubble Sort in PHP</h1>

    <?php
    function bubbleSort($arr) {
        $n = count($arr);

        for ($i = 0; $i < $n - 1; $i++) {
            $swapped = false;

            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    // Swap arr[$j] and arr[$j + 1]
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;

                    $swapped = true;
                }
            }

            // If no two elements were swapped in the inner loop, the array is already sorted
            if (!$swapped) {
                break;
            }
        }

        return $arr;
    }

    $arrayLength = "";
    $inputArray = "";
    $sortedArray = array();
    $formSubmitted = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $arrayLength = (int)$_POST["arrayLength"];
        $inputArray = $_POST["inputArray"];
        $inputArray = explode(",", $inputArray);

        // Remove any leading/trailing white spaces from each element
        $inputArray = array_map("trim", $inputArray);

        $validInput = true;

        foreach ($inputArray as $element) {
            if (!is_numeric($element) || !ctype_digit($element)) {
                $validInput = false;
                break;
            }
        }

        if (!$validInput) {
            $message = "Please enter valid integer values.";
        } else {
            // Convert input values to integers
            $inputArray = array_map("intval", $inputArray);

            $elementCount = count($inputArray);

            if ($elementCount < $arrayLength) {
                $missingElements = $arrayLength - $elementCount;
                $message = "Enter at least " . $missingElements . " more element" . ($missingElements > 1 ? "s" : "") . ".";
            } elseif ($elementCount > $arrayLength) {
                $message = "The array size does not match the number of elements entered.";
            } else {
                $sortedArray = bubbleSort($inputArray);
                $formSubmitted = true;
            }
        }
    }
    ?>

    <?php if (!$formSubmitted) { ?>
        <form method="POST">
            <label for="arrayLength">Enter the length of the array:</label>
            <input type="number" name="arrayLength" id="arrayLength" required>
            <br>
            <label for="inputArray">Enter comma-separated numbers:</label>
            <input type="text" name="inputArray" id="inputArray" required>
            <br>
            <input type="submit" value="Sort">
        </form>
        <?php if (isset($message)) { ?>
            <p style='color: red;'><?php echo $message; ?></p>
        <?php } ?>
    <?php } ?>

    <?php if ($formSubmitted) { ?>
        <h2>Sorted array:</h2>
        <?php
        echo implode(", ", $sortedArray);
        ?>
    <?php } ?>
</body>
</html>
