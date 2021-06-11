<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="api/jquery.js" type="text/javascript"></script>
        <title>INTERFACE PROJECT I</title>
    </head>
    <body>
        <script>
        
            $( document ).ready(function() {
                
                set();

            });
            
            function set(){
            $.get("api/get_interface.php",{ },function(data){
                    json = $.parseJSON(data);
                        for(i = 0 ; i < json.count ; i++ ){
                            
                            var onclick = "seeInfo('"+json.data[i]['machine']+"')";
                            var numRow = i +1 ;
                            $("#tbodie").append("<tr>");
                            $("#tbodie").append("<td scope='row' style='text-align:center'>"+numRow+"</td>");
                            $("#tbodie").append("<td scope='row'>"+json.data[i]['machine']+"</td>");
                            $("#tbodie").append("<td scope='row'>"+json.data[i]['temp']+"</td>");
                            $("#tbodie").append("<td scope='row'>"+json.data[i]['x']+"</td>");
                            $("#tbodie").append("<td scope='row'>"+json.data[i]['y']+"</td>");
                            $("#tbodie").append("<td scope='row'>"+json.data[i]['z']+"</td>");
                            $("#tbodie").append("<td scope='row' style='text-align:center'>"+json.data[i]['ts']+"</td>");
                            $("#tbodie").append("<td scope='row' style='text-align:center'><button class='btn-primary' onclick="+onclick+" >SEE INFO</button></td>");
                            $("#tbodie").append("</tr>");
                        }
 
                });
            }
            
                function seeInfo(machine){
                window.location.assign("interface_info.php?mc_code="+machine);
                }
            
        </script>
        
        <div class="container" style="margin-top: 3rem">
            
            <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="text-align:center; width: 5%">#</th>
                    <th scope="col" style="text-align:center; ">MACHINE</th>
                    <th scope="col" style="text-align:center; ">Temperature</th>
                    <th scope="col" style="text-align:center; ">X</th>
                    <th scope="col" style="text-align:center; ">Y</th>
                    <th scope="col" style="text-align:center; ">Z</th>
                    <th scope="col" style="text-align:center; ">Time</th>
                    <th scope="col" style="text-align:center; "></th>
                  </tr>
                </thead>
                <tbody id="tbodie">
                </tbody>
              </table>
            <div>
                <span><a href="send_details.php">Random Sending</a></span>
            </div>
            
        </div>
    </body>
</html>
