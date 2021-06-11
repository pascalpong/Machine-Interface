<html>
    <?php
require_once 'classes/Connect.php';
$conn = new Connect();

    
            $sql = " INSERT INTO project_interface_i (mc_code,temp,x,y,z,ts,inserted_by) "
                    . "VALUES('TEST-001','333','10','20','30',now(),'random') ";
            $rs = $conn->query($sql);
            
            echo $rs;
    ?>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="api/jquery.js" type="text/javascript"></script>
        <meta http-equiv="refresh" content="5">
        <title>INTERFACE PROJECT I</title>
    </head>
    <body>
        <script>
            var stat = "<?php echo $_GET['stat'] ?>";
            $( document ).ready(function() {
                
                start(stat);
                
            });
            function start(stat){
                
                if(stat=='on'){
                    
                            $.get("api/insert_interface.php",{mc_code:'TEST-001',temp:'111',x:'15',y:'20',z:'25', },function(data){
                    json = $.parseJSON(data);
                            if(json == 1){
                                    $("#uploadingNo").val('insert');
                            }
                });
            }else{
                $("#statusBtn").prop('hidden');
                $("#statusBtnOff").prop('hidden');
            }
            
    }
            
            
                function seeInfo(machine){
                window.location.assign("interface_info.php?mc_code="+machine);
                }
            
        </script>
        
        <div class="container" style="margin-top: 3rem">
            
            <a href="index.php" >back</a>
        </div>
    </body>
</html>
