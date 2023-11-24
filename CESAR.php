<?php
function chiffrementCesar($texte, $decalage) {
    $resultat = "";

    for ($i = 0; $i < strlen($texte); $i++) {
        $caractere = $texte[$i];

        if (ctype_alpha($caractere)) {
            $minuscule = (strtolower($caractere) == $caractere);
            $caractere = chr((ord($caractere) - ($minuscule ? ord('a') : ord('A')) + $decalage + 26) % 26 + ($minuscule ? ord('a') : ord('A')));
        }

        $resultat .= $caractere;
    }

    return $resultat;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $expression = htmlspecialchars($_POST["expression"]);
    $decalage = intval($_POST["decalage"]);
    $action = $_POST["action"];

   
    $resultat = ($action == "chiffrer") ? chiffrementCesar($expression, $decalage) : chiffrementCesar($expression, -$decalage);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>César Cipher</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 50px;
    background-color: pink;
}

h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    margin-bottom: 5px;
    color: black;
}

input, select {
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: skyblue;
    color: black;
    cursor: pointer;
}

h3 {
    margin-top: 20px;
    color: #333;
    text-align: center;
}

p {
    color: #555;
    text-align: center;
}
    </style>
</head>
<body>

    <h2>Codage de Cesar</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="expression">Expression :</label>
        <input type="text" name="expression" required>

        <label for="decalage">Décalage :</label>
        <input type="number" name="decalage" required>

        <label for="action">Action :</label>
        <select name="action" required>
            <option value="chiffrer">Chiffrer</option>
            <option value="dechiffrer">Déchiffrer</option>
        </select>

        <input type="submit" value="Appliquer">
    </form>

    <?php
   
    if (isset($resultat)) {
        echo "<h3>Résultat :</h3>";
        echo "<p>$resultat</p>";
    }
    ?>

</body>
</html>