<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="margin: 15px auto;">Wellcome to Weather App</h2>
    
    @foreach ($userCities as $city)
        <div style="width: 500px; background-color: beige; margin: 15px auto; padding: 10px;">
            <h3>{{$city->name}}</h3>
                
            @if (!empty($city->weatherToday[0]))
                <ul>
                    <li><b>Temperature:</b> {{$city->weatherToday[0]->temp}}</li>
                    <li><b>Main:</b> {{$city->weatherToday[0]->main}}</li>
                    <li><b>Description:</b> {{$city->weatherToday[0]->description}}</li>
                    <li><b>Pressure:</b> {{$city->weatherToday[0]->pressure}}</li>
                    <li><b>Humidity:</b> {{$city->weatherToday[0]->humidity}}</li>
                    <li><b>Wearing advice:</b> {{$city->advice}}</li>
                </ul>
            @else
                <h3>No data for this day.</h3>
            @endif
        </div>
    @endforeach 
</body>
</html>