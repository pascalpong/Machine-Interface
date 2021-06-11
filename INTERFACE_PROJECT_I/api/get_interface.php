<?php
require_once '../classes/Connect.php';
$conn = new Connect();

$sql = " SELECT * FROM project_interface_i GROUP BY mc_code ORDER BY id ASC ";
$rs = $conn->query($sql);
$i =0;
while ($row = $conn->parseArray($rs)) {
    
    $data[$i] = array(
        'machine'=>$row['mc_code'],
        'temp'=>$row['temp'],
        'x'=>$row['x'],
        'y'=>$row['y'],
        'z'=>$row['z'],
        'ts'=>$row['ts'],
        
    );
    
$i++ ; }

echo json_encode(array('data'=>$data,'count'=>count($data)));
?>

