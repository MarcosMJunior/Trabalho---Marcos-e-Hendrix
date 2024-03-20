<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["bet"]) && isset($_POST["guess"])) {
        $bet = $_POST["bet"];
        $guess = $_POST["guess"];

        if ($bet > 0) {
            $dice_roll = rand(1, 6);
            
            if (($guess == 1 && $dice_roll > 3) || ($guess == 0 && $dice_roll <= 3)) {
                $result = "Você ganhou!";
                $_SESSION["balance"] += $bet;
            } else {
                $result = "Você perdeu!";
                $_SESSION["balance"] -= $bet; 
            }

            
            echo "<p>O número do dado foi: $dice_roll</p>";
        } else {
            $result = "A aposta deve ser um número positivo.";
        }
    } else {
        $result = "Por favor, preencha todos os campos.";
    }
} else {
   
    header("Location: index.php");
    exit;
}


if (!isset($_SESSION["balance"])) {
    $_SESSION["balance"] = 100; 
}


echo "<h2>$result</h2>";
echo "<p>Seu saldo atual é: $" . $_SESSION["balance"] . "</p>";


setcookie("balance", $_SESSION["balance"], time() + (86400 * 1), "/"); 
?>
