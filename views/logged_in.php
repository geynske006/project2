
<?php
    $url="http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&latlng=51.022350;4.547600!1km&format=json";
    $events = json_decode(file_get_contents($url)); //file open, alle events in een variabele stockeren.
  ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventfeeder</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Jura:300,400,500,600' rel='stylesheet' type='text/css'>
</head>
    <body>
        <div id="container">        
            <a href="index.php"><img id="logo" src="img/logo.png" alt="Eventfeeder"></a>
            <div id="logout">
                <div id="username"><?php echo $_SESSION['user_name'];?></div>
                <a href="index.php?logout">Afmelden</a>
            </div>
            <!--IMPLEMENTATIE geolocatie--> 
            <div id="locatie">Uw huidige locatie is </div>
            <div>
            <div id="contentwrapper">
                <div id="aanbevolen">
                    <h2>Voor u aanbevolen!</h1>
                </div> 
                <div> 
                    <?php //oproepen lijst van alle evenementen  
                         echo "<ul id='lijst'>";
                            foreach ($events as $e) {
                                echo "<li class='lijstTitel'><a href='../project2/views/listDetails.php?id=".$e->cdbid."'>". $e->title . "</a></li>";
                                echo "<li> <img class='afbeelding' src='$e->thumbnail' alt=''></li>";
                                echo "<li class='beschrijf'>$e->shortdescription</li>";
                                echo "<a href='../project2/views/listDetails.php?id=".$e->cdbid."'>meer info<br/></a>";
                                echo "";  
                                echo "  <li>
                                            <div id='bar'>   </div>
                                        </li>";
                            }                  
                        echo "</ul>";
                    ?>
                </div>
            </div>
        </div>
        </div>
        <!--benodigde scripts voor locatiebepaling-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeLzjWfDaqBze8j7qKJL17XH4ZsMjsTx0&sensor=true"></script>
        <script type="text/javascript" src="js/geolocation.js"></script>
    </body>
</html>