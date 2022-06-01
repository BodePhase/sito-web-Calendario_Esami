<?php
if (!(isset($_POST['registrationButton']))) {
    header("Location: /");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=CalendarioEsami 
                user=postgres password=ltw2022") 
                or die('Could not connect: ' . pg_last_error());
}
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
            if ($dbconn) {
                $email = $_POST['inputEmail'];
                $q1="select * from utente where email= $1";
                $result=pg_query_params($dbconn, $q1, array($email));
                if ($line=pg_fetch_array($result, null, PGSQL_ASSOC)) {
                    echo "<h1> Sorry, you are already a registered user</h1>
                        <a href=../login/index.html> Click here to login </a>";
                }
                else {
                    $nome = $_POST['inputName'];
                    $cognome = $_POST['inputSurname'];
                    $cap = $_POST['inputCap'];
                    $password = md5($_POST['inputPassword']); // md5 per criptare la password sul database
                    $q2 = "insert into utente values ($1,$2,$3,$4,$5)";
                    $data = pg_query_params($dbconn, $q2,
                        array($email, $nome, $cognome, $password, $cap));
                    if ($data) {
                        echo "<h1> Registration is completed. 
                            Start using the website <br/></h1>";
                        echo "<a href=../Welcome.php?name=$nome> Premi qui </a>
                            per inziare ad utilizzare il sito web";
                    }
                }
            }
        ?> 
    </body>
</html>