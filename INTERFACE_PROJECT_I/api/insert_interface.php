<?php
require_once '../classes/Connect.php';
$conn = new Connect();

$mc_code = $_GET['mc_code'];
$temp = $_GET['temp'];
$x_val = $_GET['x'];
$y_val = $_GET['y'];
$z_val = $_GET['z'];

$sql = " INSERT INTO project_interface_i (mc_code,temp,x,y,z,ts) "
        . "VALUES('$mc_code','$temp','$x_val','$y_val','$z_val',now()) ";
$rs = $conn->query($sql);

echo json_encode($rs);

?>
<!--   192.168.1.90\PMII_INTERFACE_PROJECT_I\api\insert_interface.php?mc_code=TEST-001&temp=99&x=10&y=20&z=30   -->
