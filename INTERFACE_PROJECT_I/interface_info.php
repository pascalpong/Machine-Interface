<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="api/jquery.js" type="text/javascript"></script>
        <meta http-equiv="refresh" content="10">
        <title>INTERFACE PROJECT I</title>
    </head>
    <body>
        <script>
            
            $( document ).ready(function() {
                var machine = "<?php echo $_GET['mc_code'] ?>";
                getInfoOf(machine);
            });
            
            function getInfoOf(machine){
                $.get("api/get_interface_details",{mc_code:machine,limit:100},function(data){
                    json = $.parseJSON(data);
                    for(i=0;i<json.count;i++){
                        
                        $("#tbodie").append("<tr>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['id']+"</td>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['temp']+"</td>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['x']+"</td>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['y']+"</td>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['z']+"</td>");
                        $("#tbodie").append("<td style='text-align:center'>"+json.data[i]['ts']+"</td>");
                        $("#tbodie").append("</tr>");
                    }
                });
                }

        </script>
        
        <div class="container" style="margin-top: 3rem">
            
            <div>
                <span><b style="">MACHINE : </b><?php echo $_GET['mc_code'] ?></span><br>
                <span><a href="index.php">BACK</a></span>
            </div>
            
            <table class="table table-bordered">
                <thead class="thead-light">
                  <tr>
                      <th scope="col" style="text-align:center; ">#</th>
                    <th scope="col" style="text-align:center; ">Temperature</th>
                    <th scope="col" style="text-align:center; ">X</th>
                    <th scope="col" style="text-align:center; ">Y</th>
                    <th scope="col" style="text-align:center; ">Z</th>
                    <th scope="col" style="text-align:center; ">TS</th>
                  </tr>
                </thead>
                <tbody id="tbodie">
                </tbody>
              </table>
            
        </div>
    </body>
</html>
