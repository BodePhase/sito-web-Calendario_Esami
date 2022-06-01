<!DOCTYPE html>
<body lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario Esami</title>
  <!-- Bootstrap 5 CDN-Import: -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- DOMPurify: -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.6/purify.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Light-Theming: -->
  <link id="mainStyle" rel="stylesheet" href="style.css">
  <script src="//code.jquery.com/jquery-3.6.0.js"></script>
  <script defer src="./app.js"></script>
  <script>
    $(document).ready(function(){
      //per info qmark1
      $("#qmark").on('mouseover',function(e) {
        $("#qmark-label").text("Per gli url Google Sheet converti i file in formato excel da File > Salva come foglio Google");
        $("#qmark-label").show();
      });
      $("#qmark").on('mouseout',function(e) {
        $("#qmark-label").hide();
      });
      //per info qmark2
      $("#qmark2").on('mouseover',function(e) {
        $("#qmark-label2").text("Per vedere valori compilare la form soprastante");
        $("#qmark-label2").show();
      });
      $("#qmark2").on('mouseout',function(e) {
        $("#qmark-label2").hide();
      });

      $("#calendar").click(function(){
        $("#corpo").load("/googlecalendar/calendar.php");
      });
    });
  </script>
</head>

<body>
  <div class="page-content">
  <!-- nav start --> 
  <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
    <div class="container">
      <a class="navbar-brand advert-img me-2" href="https://www.uniroma1.it/it/pagina-strutturale/studenti"><img id="header_logo" class="logo" src="./images/Uniroma1.svg" height="90"  /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">  
          <li class="nav-item my-2 d-flex align-items-center">
            <a class="nav-link mx-2 btn btn-theme" id="theme_button" onclick="onThemeChange()">
              <i id="theme_icon" class="fas fa-moon"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" id="link-about" onclick="scrollSmoothTo('about')" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="#">Calendario</a>
          </li>
          <li class="nav-item my-2 d-flex align-items-center">
           <a class="nav-link mx-2 active btn btn-sapienza px-3" type="button" href="./login/login.html" ><i class="fa fa-sign-in fa-fw mr-2"></i> Login</a>
          </li> 
        </ul>      
      </div>
    </div>
  </nav>  
  <!-- nav end -->
  <div id="corpo">
  <header>
    <div class="container text-center">
      <div class="row m-4">
        <h1 class="text-titolo display-4">Calendario Esami</h1>
        <p class="fs-4 text-muted ">Aggiungi gli esami a cui sei interessato durante la sessione.</p>
      </div>
    </div>
  </header>
    <main>
    <div class="container">
      <!-- form -->
      <form id="corsostudi-form" name="corsostudi-form" onsubmit="return validaFormUrl();" action="index.php" method="post" class="p-4 m-4 row shadow-sm rounded-3 border border-sottile text-font">
        <div class="form-group col-md-4 my-2 ">
          <label for="urlcorso">URL del calendario degli esami</label>
          
          <style>label[for="qmark"]{font-size: 12px;}</style>
          <label for="qmark" id="qmark-label"></label>
          <input required autocomplete="off" id="urlcorso" name="urlcorso" type="url" class="form-control" placeholder="e.g., https://docs.google.com/spreadsheets/d...">
        </div>
        <div class="form-group col-md-4 my-2 ">
          <label for="urltype">Tipo del file</label>
          <br/>
          <select name="urltype" id="urltype" class="form-select" >
            <option value="vuoto" selected></option>  
            <option value="sheet">Google Sheet</option>  
            <option value="excel">Excel</option>  
          </select>  
        </div>
        <div class="form-group mt-4">
          <input type="submit" value="Aggiungi Esami Del Tuo Corso" class="btn btn-sapienza">
        </div>
      </form>

      <form id="recipe-form" class="p-4 m-4 row shadow-sm rounded-3 border border-sottile text-font">
      <div>
        
        <style>label[id="qmark-label2"]{font-size: 12px;}</style>
        <label id="qmark-label2"></label>
      </div>
      <div class="form-group col-md-4 my-2 ">
          <label for="esame">Esame</label>
          <input required autocomplete="off" type="text" id="esame" class="form-control auth-input" placeholder="e.g., Linguaggi e tecnologie per il web">
        </div>
        <div class="form-group col-md-4 my-2 ">
          <label for="data">Data</label>
          <input required autocomplete="off" type="text" id="data" class="form-control auth-input" placeholder="e.g., 01/06/2022">
        </div>
        <div class="form-group col-md-4 my-2">
          <label for="posizione">Posizione</label>
          <input required autocomplete="off" type="text" id="posizione" class="form-control auth-input" placeholder="e.g., Telematica">
        </div>
        <div class="form-group col-md-4 my-2">
          <label for="professore">Professore</label>
          <input required autocomplete="off" type="text" id="professore" class="form-control auth-input" placeholder="e.g.,Riccardo Rosati">
        </div>
        <div class="form-group col-md-4 my-2">
          <label for="canale">Canale</label>
          <input required autocomplete="off" type="text" id="canale" class="form-control auth-input" placeholder="e.g., Canale 1">
        </div>
        <div class="form-group col-md-4 my-2">
          <label for="note">Note</label>
          <input autocomplete="off" type="text" id="note" class="form-control auth-input">
        </div>
        <div class="form-group mt-4">
          <input type="submit" value="Aggiungi Esame" class="btn btn-sapienza">
        </div>
      </form>
      <!-- form end -->

      <div class="container">
        <div class="row m-4 border-bottom border-3 border-sottile">
          <p class="h3 text-titolo">Esami salvati</p>
        </div>
        
      </div>
      <div class="row row-cols-1 row-cols-md-3 mx-4 my-6 text-center" id="recipe-container">
      </div>
    </div>
    </main>
  <br>
  <br>
  <section id="about">
  <div class="container">
  <div class="article__author">
    <a href="https://github.com/BodePhase/sito-web-Calendario_Esami"><img src="./images/GitHub-Mark-Black.png" id="Github-logo" alt="Github logo" class="article__author--image"></a>
    <div class="article__author--details text-bordo">
      <h3>Linguaggi e tecnologie per il Web 2021/2022</h3>
      <p><b>Massimiliano Favetta e Francesco Toccafondi</b></p>
      <p >Progetto sviluppato per il corso di Linguaggi e tecnologie per il Web 2021/2022 del corso di laurea in Ingegneria Informatica e Automatica della Università di Roma La Sapienza.</p>    
    </div>
  </div>
</div>
</section>

<!-- Footer -->
<footer>
    <div class="text-center p-4 text-bordo">
      © Linguaggi e tecnologie per il Web 2021/2022 
     <div>
</footer>

</div>  
  <script type="text/javascript">
    function onThemeChange() {
        let cssStyleSheet = document.getElementById("mainStyle");
        let path = (cssStyleSheet.href).substring((cssStyleSheet.href).length-9, (cssStyleSheet.href).length);
        if(path === "style.css") {
            cssStyleSheet.href = "style_dark.css";
            document.getElementById("header_logo").src = "./images/Uniroma1.svg";
            document.getElementById("Github-logo").src = "./images/GitHub-Mark-Light.png";
            document.getElementById("theme_icon").className = "fas fa-sun";
        } else {
            cssStyleSheet.href = "style.css";
            document.getElementById("header_logo").src = "./images/Uniroma1.svg";
            document.getElementById("Github-logo").src = "./images/GitHub-Mark-Black.png";
            document.getElementById("theme_icon").className = "fas fa-moon";
        }
    }
  </script>
  <!-- Bootstrap 5 JS-Bundle CDN import: -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE); 

//googlesheet
require __DIR__ . '/googlesheets/quickstart/vendor/autoload.php';

use Google\Service\CloudBuild\Warning;
use Google\Service\Dfareporting\Resource\Files;
//excel
require './excel/vendor/autoload.php';
use RebaseData\Converter\Converter;
use RebaseData\InputFile\InputFile;

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Sheets API PHP Quickstart');
    $client->setScopes(Google\Service\Sheets::SPREADSHEETS_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->addScope(Google\Service\Drive::DRIVE);
    $client->setPrompt('select_account consent');
    $redirect_uri = 'http://localhost:8080';
    $client->setRedirectUri($redirect_uri);

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = '/googlesheets/quickstart/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

if(isset($_POST["urlcorso"])){

$to_insert=array(); //da inserire nel DB

  if($_POST["urltype"]=="sheet"){
// Get the API client and construct the service object.
$client = getClient();
$service = new Google\Service\Sheets($client);

$postUrl = $_POST["urlcorso"];
$pattern = "/https:\/\/docs\.google\.com\/spreadsheets\/d\//";
$postUrl = preg_replace ($pattern,"", $postUrl);
$pattern = "/\/(.*)/";
$postUrl = preg_replace ($pattern,"", $postUrl);
$spreadsheetId = $postUrl;
$sheet_metadata = $service->spreadsheets->get($spreadsheetId);
$sheets = $sheet_metadata->getSheets();
$title = $sheets[0]->getProperties()->getTitle();
$range = $title; //per leggere l'intero sheet
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();



if (empty($values)) {
    print "No data found.\n";
} else {
    $iesame=-1;
    $icanale=-1;
    $iprof=-1;
    $ipos=-1;
    $idata1=-1;
    $idata2=-1;
    $idata3=-1;
    $fineheader=false;
    $controllo_header=false; //per cominciare ad acquisire valori dopo l'header del file
    //$to_insert=array();
    foreach ($values as $row) {
      //inizializzazioni
          $line1=array();
          $line2=array();
          $line3=array();
          $line1["esame"]=null;
          $line2["esame"]=null;
          $line3["esame"]=null;
          $line1["posizione"]=null;
          $line1["data_esame"]=null;
          $line2["data_esame"]=null;
          $line3["data_esame"]=null;
          //per quelli che non hanno canale
          $line1["canale"]=null;
          $line2["canale"]=null;
          $line3["canale"]=null;
        foreach ($row as $key=>$value) {
          if($value=="PRIMO ANNO" || $value=="SECONDO ANNO" || $value=="TERZO ANNO" || $value=="" || $value==null){
            break;
          }
          
          if($controllo_header){
            if($key==$iesame){
              $line1["esame"]=$value;
              $line2["esame"]=$value;
              $line3["esame"]=$value;
            }
            if($key==$icanale){
              $line1["canale"]=$value;
              $line2["canale"]=$value;
              $line3["canale"]=$value;
            }
            if($key==$iprof){
              $line1["professore"]=$value;
              $line2["professore"]=$value;
              $line3["professore"]=$value;
            }
            if($key==$ipos){
              $line1["posizione"]=$value;
              $line2["posizione"]=$value;
              $line3["posizione"]=$value;
            }
            if($key==$idata1){
              $line1["data_esame"]=$value;
            }
            if($key==$idata2){
              $line2["data_esame"]=$value;
            }
            if($key==$idata3){
              $line3["data_esame"]=$value;
            }
          }
          if($value=="INSEGNAMENTO"){
            $iesame=$key;
            $fineheader=true;
          }
          if($fineheader){
          if($value=="CAN." || $value=="CAN" || $value=="CANALE"){
            $icanale=$key;
          }
          if($value=="DOCENTE"){
            $iprof=$key;
          }
          if($value=="DATA" || strpos($value,"MAGGIO")!=false || strpos($value,"GIUGNO")!=false || strpos($value,"LUGLIO")!=false || strpos($value,"SETTEMBRE")!=false){
            if($value=="DATA"){
              if($idata1==-1){
                $idata1=$key;
              }
              elseif($idata2==-1){
                $idata2=$key;
              }
              else{
                $idata3=$key;
              }
            }
            else{
              if(strpos($value,"MAGGIO")!=false || strpos($value,"GIUGNO")!=false){
                $idata1=$key;
              }
              elseif(strpos($value,"LUGLIO")!=false){
                $idata2=$key;
              }
              else{
                $idata3=$key;
              }
            }
          }
          if($value=="AULA"){
            $ipos=$key;
          }
        }
      }
      if($fineheader){
        $controllo_header=true;
      }
      //controlli vari
      if($line1["esame"]!=null && $line1["posizione"]==null){
        $line1["posizione"]="da definire";
        $line2["posizione"]="da definire";
        $line3["posizione"]="da definire";
      }
      if($line1["esame"]!=null && $line1["data_esame"]==null){
        $line1["data_esame"]="da definire";
      }
      if($line2["esame"]!=null && $line2["data_esame"]==null){
        $line2["data_esame"]="da definire";
      }
      if($line3["esame"]!=null && $line3["data_esame"]==null){
        $line3["data_esame"]="da definire";
      }
      if($line1["esame"]!=null){
        array_push($to_insert,$line1,$line2,$line3);
      }
    }
}
  }

  elseif($_POST["urltype"]=="excel"){
    $inputFiles = [new InputFile($_POST["urlcorso"])];

$converter = new Converter();
$database = $converter->convertToDatabase($inputFiles);
$tables = $database->getTables();

foreach ($tables as $table) {

  $values = $table->getRowsIterator();
  foreach ($values as $row) {
    //inizializzazioni
    $line1=array();
    $line2=array();
    $line3=array();
    $line1["esame"]=null;
    $line2["esame"]=null;
    $line3["esame"]=null;
    $line1["posizione"]=null;
    $line1["data_esame"]=null;
    $line2["data_esame"]=null;
    $line3["data_esame"]=null;
    //per quelli che non hanno canale
    $line1["canale"]=null;
    $line2["canale"]=null;
    $line3["canale"]=null;
  foreach ($row as $key=>$value) {
    if($value=="PRIMO ANNO" || $value=="SECONDO ANNO" || $value=="TERZO ANNO" || $value=="" || $value==null){
      break;
    }
    
    if($controllo_header){
      if($key==$iesame){
        $line1["esame"]=$value;
        $line2["esame"]=$value;
        $line3["esame"]=$value;
      }
      if($key==$icanale){
        $line1["canale"]=$value;
        $line2["canale"]=$value;
        $line3["canale"]=$value;
      }
      if($key==$iprof){
        $line1["professore"]=$value;
        $line2["professore"]=$value;
        $line3["professore"]=$value;
      }
      if($key==$ipos){
        $line1["posizione"]=$value;
        $line2["posizione"]=$value;
        $line3["posizione"]=$value;
      }
      if($key==$idata1){
        $line1["data_esame"]=$value;
      }
      if($key==$idata2){
        $line2["data_esame"]=$value;
      }
      if($key==$idata3){
        $line3["data_esame"]=$value;
      }
    }
    if($value=="INSEGNAMENTO"){
      $iesame=$key;
      $fineheader=true;
    }
    if($fineheader){
    if($value=="CAN." || $value=="CAN" || $value=="CANALE"){
      $icanale=$key;
    }
    if($value=="DOCENTE"){
      $iprof=$key;
    }
    if($value=="DATA" || strpos($value,"MAGGIO")!=false || strpos($value,"GIUGNO")!=false || strpos($value,"LUGLIO")!=false || strpos($value,"SETTEMBRE")!=false){
      if($value=="DATA"){
        if($idata1==-1){
          $idata1=$key;
        }
        elseif($idata2==-1){
          $idata2=$key;
        }
        else{
          $idata3=$key;
        }
      }
      else{
        if(strpos($value,"MAGGIO")!=false || strpos($value,"GIUGNO")!=false){
          $idata1=$key;
        }
        elseif(strpos($value,"LUGLIO")!=false){
          $idata2=$key;
        }
        else{
          $idata3=$key;
        }
      }
    }
    if($value=="AULA"){
      $ipos=$key;
    }
  }
}
if($fineheader){
  $controllo_header=true;
}
//controlli vari
if($line1["esame"]!=null && $line1["posizione"]==null){
  $line1["posizione"]="da definire";
  $line2["posizione"]="da definire";
  $line3["posizione"]="da definire";
}
if($line1["esame"]!=null && $line1["data_esame"]==null){
  $line1["data_esame"]="da definire";
}
if($line2["esame"]!=null && $line2["data_esame"]==null){
  $line2["data_esame"]="da definire";
}
if($line3["esame"]!=null && $line3["data_esame"]==null){
  $line3["data_esame"]="da definire";
}
if($line1["esame"]!=null){
  array_push($to_insert,$line1,$line2,$line3);
}
  }
}
  }

  //salvo su db
$dbconn = pg_connect ( " host = localhost port =5433
dbname = postgres user = postgres password = password " )
or die ( ' Could not connect : ' . pg_last_error ());
foreach($to_insert as $v){
  try{
$query = "INSERT INTO esami VALUES ('$v[esame]','$v[data_esame]','$v[posizione]','$v[professore]','$v[canale]')";
$res = pg_query($query); 
if (!$res) {
  //echo "error db\n";
} 
  }catch(Warning $w){
    //do nothing
  }
}
pg_close ( $dbconn );

/* $dbconn = pg_connect ( " host = localhost port =5433
dbname = postgres user = postgres password = password " )
or die ( ' Could not connect : ' . pg_last_error ());
$query = ' SELECT * FROM esami ';
$result = pg_query ( $query ) or die ( ' Query failed : ' . pg_last_error ());
// Printing results in HTML
echo " < table >\ n " ;
while ( $line = pg_fetch_array ( $result , null , PGSQL_ASSOC )) {
echo " \t < tr >\ n " ;
foreach ( $line as $col_value ) {
echo " \ t \t < td > $col_value </ td > " ;
}
echo " \t </ tr >\ n " ;
}
echo " </ table >\ n " ;
pg_free_result ( $result );
pg_close ( $dbconn ); */


}

?>
</body>

</html>