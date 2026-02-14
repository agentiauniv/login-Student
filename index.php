<?php
$message = "";
$messageColor = "black";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Informations Supabase
    $host = "db.uhqqzlpaybcyxrepisgi.supabase.co";
    $port = "5432";
    $dbname = "postgres";
    $user = "postgres";
    $password_db = "TON_MOT_DE_PASSE_SUPABASE"; // 🔴 Mets ton vrai mot de passe ici

    // Connexion PostgreSQL
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password_db");

    if (!$conn) {
        die("Connexion à la base échouée.");
    }

    // Requête sécurisée
    $query = 'SELECT * FROM "Login" WHERE "Email" = $1 AND "password" = $2';
    $result = pg_query_params($conn, $query, array($email, $password));

    if (pg_num_rows($result) > 0) {
        $message = "Login successful";
        $messageColor = "green";
    } else {
        $message = "Incorrect email or password";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="">
    
    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password :</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>

</form>

<p style="color: <?php echo $messageColor; ?>;">
    <?php echo $message; ?>
</p>

</body>
</html>
