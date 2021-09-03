<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Geocode</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <script type="text/javascript" src="js/map.js"></script>
        <script type="text/javascript" src="js/jQuery.js"></script>



        

        
        <style type="text/css">
           
            .error{
                color:red;
                text-align:center;
            }
        </style>
       

        
    </head>
    <body>
        <div class="container">
            <div id="map"></div>
        </div>
        
        <table class="table">
            <tr>
                <th colspan="2" style="text-align:center;">Adress Finder</th>
            </tr>
            <tr> 
                    <td>
                        <input type="text" id="adress_field" class="form-control" placeholder="Adress" autocomplete="off"> 
                    </td>
                    <td>
                        <button type="button" onclick="Adress.converter()" class="btn btn-primary">Find</button>
                    </td>
                
            </tr>
            <tr>
                <tr>
                    <th colspan="2" style="text-align:center;">GPS Finder</th>
                </tr>
                <td>
                    Lat:<input type="text" id="lat_field"  class="form-control" placeholder="Latitude" autocomplete="off">
                </td>
                <td>
                    Long:<input type="text" id="long_field"  class="form-control" placeholder="Longitude" autocomplete="off">
                </td>
                <td>
                    <button type="button" onclick="LatLong.converter()" class="btn btn-primary">Find</button>
                </td>
            </tr>
        </table>
        <div id="message"></div>
    </body>
    
    
</html>