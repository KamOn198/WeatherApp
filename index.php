<?php

    if($_POST){
        $city = $_POST['city'];
        $apiKey = "";
        $request = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$apiKey."&units=metric";

        if(file_get_contents($request)){
            $weather = file_get_contents($request);
            $weather = json_decode($weather);
            $code = $weather->cod;

            if($code == '404'){

                $weatherResult = "<div class=\"alert alert-danger\">City not found!</div>";
            }else{
                $main = $weather->weather[0]->main;
                $description = $weather->weather[0]->description;
                $windSpeed = $weather->wind->speed." meter/sec";
                $minTemp = $weather->main->temp_min.'&degC';
                $maxTemp = $weather->main->temp_max.'&degC';

                $weatherResult = "<div class=\"alert alert-success\"><strong>Weather for ".$city."</strong><br>
                Weather: ".$main."<br>
                Description: ".$description."<br>
                Wind speed: ".$windSpeed."<br>
                Temp. min.: ".$minTemp."<br>
                Temp. max.: ".$maxTemp."<br></div>";
            }
        }else{
            $weatherResult = "<div class=\"alert alert-danger\">City not found!</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style type="text/css">
        body{
            background: none;
        }
        .container{
            width: 40%;
            margin-top: 60px;
            text-align: center;
        }
        html {
            background: url("sunset.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        p{
            margin-bottom: 20px;
        }
        #submitBtn{
            margin: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>What's The Weather?</h1>
    <p>Enter the name of a city.</p>
    <form method="post">
        <div class="form-group row">
            <div class="col-sm-12">
                <input type="text" class="form-control" id="cityField" name="city">
                <input type="submit" id="submitBtn" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </form>
<?php if(isset($weatherResult)): ?>
        <?php echo $weatherResult; ?>
<?php endif; ?>
</div>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>