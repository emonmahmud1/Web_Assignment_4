<?php

$url = "https://api.openweathermap.org/data/2.5/forecast?q=dhaka&appid=392a5b7b5dedae30cb288cc99934e10b";

$content= file_get_contents($url);
$clima = json_decode($content);




?>

<!doctype html>
<html lang="en">

<head>
<style>
    body{
        background-image: url(images/blur.png);
    }
.bg{
    background-color: rgba(244, 249, 247, 0.4);
    padding: 10px;
    border-radius:20px;  
    min-height: 90vh;
   margin:auto;
   width: 50%;
   
   
   
    
}
.daily{
    position: absolute;
    bottom: 0;
    right: 0;
   
}
.card{
    background-color: rgba(244, 249, 247, 0.3) !important;
    box-shadow: rgba(40, 9, 9, 0.3) 15px 20px 10px !important;


    
}
.location{
    position: absolute;
    text-align: center;
    left: 0;
    display:flex;
    justify-content:center;

}
.city{
    display: inline-block;
    color:green;
    text-transform: uppercase;

}

.current {
   gap: 30px;  
  
 
  
}
.nextDays img{
    height: 70px;
    width: 70px;
    
}
h5{
    text-transform: uppercase;
}


</style>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="">
    <title>Weather</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container">

    <div class="container mt-3 row bg">
      
        <div class="container location">
          

       

    <div class="city">
        <h3><?php echo $clima-> city -> name ?></h3>
    </div>
        </div>
        <!-- <div class="container today"> -->
            <div class="container current col-md-12 col-lg-12 col-sm-12 d-flex">
                <div class="col-lg-2 col-md-2 col-4 col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <h4><?php echo round($clima->list[0]->main->temp_max-273.15). "-".round($clima->list[0]->main->temp_min-273.15)."°C"; ?></h4>
                            <span class="card-text">Today</span>
                            <p class="card-text"><?php echo date("D-d-M", strtotime($clima->list[0]->dt_txt)); ?></p>
                        </div>
                    </div>
    
                </div>

                <div class="col-lg-2 col-md-2 col-4 col-sm-4">
                    <div class="card">
                        <div class="card-body">
                        <h5><?php echo $clima->list[0]->weather[0]->description  ?></h5>

                            <span class="card-text">Feels Like: <?php echo $clima->list[0]->main->feels_like-273.15."°C"; ?> </span> </br>
                            <span class="card-text">Humidity: <?php echo $clima->list[0]->main->humidity."%"; ?> </span>
                        </div>
                    </div>
    
                </div>
                
                <div class="status">
                <img src="https://openweathermap.org/img/wn/<?php echo $clima->list[0]->weather[0]->icon  ?>@2x.png" class="rounded float-end" alt="...">
               
            </div>

        </div>



<!-- next 5 days  -->
<?php
$date = strtotime($clima->list[0]->dt_txt);
$previous_date = date("d-M",$date) ."<br/>";
?>
<div class="container daily col-md-12 col-lg-12 col-sm-12 d-flex justify-content-evenly">

<?php for ($key = 0; $key <40 ; $key++){ ?>
  <?php  $dt_txt = $clima->list[$key]->dt_txt;

   $date = strtotime($clima->list[$key]->dt_txt);
   $current_date = date("d-M",$date) ."<br/>";
   if ($current_date != $previous_date) { ?>
            <div class="col-lg-2 col-md-2 col-2 col-sm-2 mb-4">
                <div class="card">
                    <div class="nextDays d-flex justify-content-center">
                        <img src="https://openweathermap.org/img/wn/<?php echo $clima->list[$key]->weather[0]->icon  ?>@2x.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h6><?php  echo round($clima->list[$key]->main->temp_max-273.15)."-". round($clima->list[$key]->main->temp_min-273.15)."°C"; ?></h6>
                        <h1><?php ?></h1>

                        <p class="card-text"><?php echo $current_date ?></p>
                    </div>
                </div>

            </div>
            <?php } ?>
          <?php  $previous_date = $current_date; ?>
            <?php } ?>

            </div>
       
    </div>

  







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>