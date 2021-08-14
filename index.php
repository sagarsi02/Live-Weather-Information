<?php

$status = "";
$msg = "";
if(isset($_POST['submit'])){
    $city = $_POST['city'];

    $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=c6701ffec63413cfd930a967c9aee70a";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if($result['cod']==200){
        $status = "yes";
    }
    else{
        $msg = $result['message'];
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather - Application</title>
</head>
<style>
    body {
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .container {
        /* width: 100%; */
    }
    
    .asdf {
        width: 50vw;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    input {
        width: 100%;
        margin-right: 5px;
        height: 30px;
    }
    
    form {
        display: flex;
    }
    
    #submit {
        padding: 5px 20px;
        font-size: 18px;
        font-family: emoji;
        cursor: pointer;
    }
    
    hr {
        display: block;
        background: red;
        height: 1px;
        margin: 0px 0px;
        width: 100%;
    }
    
    .card {
        border-radius: 25px;
        border: 2px solid red;
        margin-top: 15px;
        overflow: hidden;
    }
    
    .details {
        display: flex;
        margin: auto;
        justify-content: center;
        background-color: #72577b;
    }
    
    .img {
        background-color: #fff;
        padding: 20px;
    }
    
    .img img {
        width: 80px;
        border-radius: 50%;
        display: flex;
        margin: auto;
    }
    
    .degree {
        border-right: 2px solid red;
        border-left: 2px solid red;
        text-align: center;
        width: 20%;
        background-color: #55b3b3;
    }
    
    .city {
        border-right: 2px solid red;
        text-align: center;
        background-color: #60aace;
        width: 20%;
    }
    
    .wind {
        border-right: 2px solid red;
        text-align: center;
        background-color: #9ac2f5;
        width: 20%;
    }

    h3{
        font-size: 20px;
        color: #fff;
        text-shadow: 3px 3px 2px #502525;
    }

    p{
        font-size: 18px;
        font-family: sans-serif;
        color: #fff;
        text-shadow: 2px 2px 2px #000;
    }
    
    .date {
        width: 20%;
        background-color: #55b3b3;
        text-align: center;
        align-items: center;
        display: flex;
        justify-content: center;
        border-right: 2px solid red;
    }

    .message{
        text-align: center;
        font-size: 25px;
        text-shadow: 2px 3px 3px #94ec06;
        background-color: #502525;
        width: 50%;
        display: flex;
        margin: 15px auto;
        justify-content: center;
    }

    h2{
        text-align: center;
        color: #fff;
    }
</style>

<body>
    <div class="container">
        <div class="asdf">
            <h2>Live Weather Information</h2>
            <form method="post">
                <input type="text" class="text" name="city" id="city" placeholder="Enter Your City">
                <button type="submit" value="submit" name="submit" id="submit">Search</button>
            </form>


                <p class="message"><?php echo $msg; ?></p>

            
           <?php if($status=="yes"){ ?>
                <div class="card">
                    <div class="img">
                        <img src="https://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']; ?>@4x.png" alt="Weather-Img">
                    </div>
                    <hr>
                    <div class="details">
                        <div class="degree">
                            <h3><?php echo round($result['main']['temp']-273.15); ?>°</h3>
                            <p>Tempreture</p>
                        </div>
                        <div class="city">
                            <h3><?php echo $result['name']; ?></h3>
                            <p>City</p>
                        </div>
                        <div class="wind">
                            <h3><?php echo $result['wind'] ['speed']; ?></h3>
                            <p>Wind</p>
                        </div>
                        <div class="date">
                            <h3><?php echo date('d M', $result['dt']); ?></h3>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</body>

</html>