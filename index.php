<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-hw4</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <main class="main">
        <form class="calc" method="POST">
            <input type="text" class="calc__input" readonly name="calc">
            <input type="button" class="calc__button calc__button_one" value="1">
            <input type="button" class="calc__button calc__button_two" value="2">
            <input type="button" class="calc__button calc__button_three" value="3">
            <input type="button" class="calc__button calc__button_four" value="4">
            <input type="button" class="calc__button calc__button_five" value="5">
            <input type="button" class="calc__button calc__button_six" value="6">
            <input type="button" class="calc__button calc__button_seven" value="7">
            <input type="button" class="calc__button calc__button_eight" value="8">
            <input type="button" class="calc__button calc__button_nine" value="9">
            <input type="button" class="calc__button calc__button_zero" value="0">
            <input type="button" class="calc__button calc__button_bracket-open" value="(">
            <input type="button" class="calc__button calc__button_bracket-close" value=")">
            <input type="button" class="calc__button calc__button_add" value="+">
            <input type="button" class="calc__button calc__button_sub" value="-">
            <input type="button" class="calc__button calc__button_mult" value="*">
            <input type="button" class="calc__button calc__button_div" value="/">
            <input type="button" class="calc__button calc__button_reset" value="c">
            <input type="button" class="calc__button calc__button_delete" value="←">
            <input type="submit" class="calc__button calc__button_result" value="=">
        </form>
    </main>
    <?php
        // error_reporting(0);
        $res = '';
        if (!empty($_POST["calc"])) {
            $elems = explode(' ', $_POST["calc"]);

            $brackets = 0;
            for ($i = 0; $i < count($elems); $i++) {
                if ($elems[$i] == '(') $brackets++;
                if ($elems[$i] == ')') $brackets--;
                if ($brackets != 0 && $i == count($elems) - 1) {
                    $res = 'Проверь скобки';
                    
                };
            }
            $keyBracketsOpen = [];
            try {
                while (array_search('(', $elems) != false and array_search(')', $elems) != false) {
                    for ($i = 0; $i < count($elems); $i++) {
                        if ($elems[$i] == '(') {
                            array_push($keyBracketsOpen, $i);
                        } elseif ($elems[$i] == ')') {
                            $first = array_pop($keyBracketsOpen);
                            $second = $i;
                            $replacement = calc(array_slice($elems, $first + 1, $second - $first - 1));
                            array_splice($elems, $first, $second - $first + 1, $replacement);
                        }
                    }
                    
                }
                if ($res == '') {
                    $res = calc(array_values(array_diff($elems, array(''))))[0];
                }

            } catch (DivisionByZeroError $e) {
                $res = 'Деление на 0';
            }

        }


        function calc($arr) {
            for ($i = 0; $i < count($arr); $i++) {
                if ($arr[$i] == '*' or $arr[$i] == '/') {
                    switch ($arr[$i]) {
                        case '*':
                            $arr[$i - 1] = (float)$arr[$i - 1] * (float)$arr[$i + 1];
                            array_splice($arr, $i, 2);
                            break;
                        case '/':
                            $arr[$i - 1] = (float)$arr[$i - 1] / (float)$arr[$i + 1];
                            array_splice($arr, $i, 2);
                            break;
                    }
                }
            }

            for ($i = 0; $i < count($arr); $i++) {
                if ($arr[$i] == '+' or $arr[$i] == '-') {
                    switch ($arr[$i]) {
                        case '+':
                            $arr[$i - 1] = (float)$arr[$i - 1] + (float)$arr[$i + 1];
                            array_splice($arr, $i, 2);
                            break;
                        case '-':
                            $arr[$i - 1] = (float)$arr[$i - 1] - (float)$arr[$i + 1];
                            array_splice($arr, $i, 2);
                            break;
                    }
                }
            }

            while (array_search('+', $arr) != false ||
                   array_search('-', $arr) != false ||
                   array_search('*', $arr) != false ||
                   array_search('/', $arr) != false) {
                    $arr =  calc($arr);
            }    
        
            return $arr;
        }
    ?>
    <script>
        var res = '<?= $res ?>';
    </script>
    <script src="scripts/scripts.js"></script>
</body>
</html>