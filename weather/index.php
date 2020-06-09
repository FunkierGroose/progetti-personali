<?php

    function curl($url) {
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);       //questa funzione ci consente di effettuare il collegamento 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);           //per prelevare dati in formato get e post dall'url
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        }

      if (isset($_GET['city'])) {   //evento

        $city = $_GET['city'];

        $urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$city."&type=accurate&appid=45c7545362f721b479b2d3dab82fb4b0");
        
        $weatherArray = json_decode($urlContents, true);
        
        $weather = "The weather a  ".$city." is currently ".$weatherArray['weather'][0]['description'].".";
        
        $tempInFahrenheit = intval($weatherArray['main']['temp']* 9/5 - 459.67);
        
        $speedInMPH = intval($weatherArray['wind']['speed']*2.24);

        $cels = intval(($tempInFahrenheit - 32) *5 / 9);
        
        $weather .=" <br>The temperature is of  ".$cels."&deg; C with a wind speed of ".$speedInMPH." MPH.";

    
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Weather!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      
     <div class="container">  
        <h1>What's the Weather?</h1>

         <form method="get" action="index.php">
          <div class="form-group">
            <label for="city">Enter the name of the city.</label>
            <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo">
            <button type="submit" style="cursor: pointer;" name="event" class="btn btn-primary">Sent!</button>
          </div>
        </form>
         
         <div id="weather">
          
          <?php 
            if($weather) {
                
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                
            } else {
                
                if ($city !="") {
                    
                    echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
                }
            }
          ?>
      
      </div>
     </div> 
 
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
  </body>
</html>