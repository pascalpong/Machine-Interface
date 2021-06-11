<?php
require_once '../classes/Connect.php';
$conn = new Connect();

$mc_code = $_GET['mc_code'];

$sql = " SELECT * FROM project_interface_i WHERE mc_code = '{$mc_code}' ORDER BY id DESC ";
$rs = $conn->query($sql);
$i =0;
while ($row = $conn->parseArray($rs)) {
    
    $data[$i] = array(
        'machine'=>$row['mc_code'],
        'temp'=>$row['temp'],
        'id'=>$row['id'],
        'x'=>$row['x'],
        'y'=>$row['y'],
        'z'=>$row['z'],
        'ts'=>$row['ts'],
    );

$i++ ; }

echo json_encode(array('data'=>$data,'count'=>count($data)));
?>

