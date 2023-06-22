<?php
$vin_Number = $_GET['vinNumber'];
//print($vin_Number);
$dirPath = '../carDetails';

if (!empty($vin_Number)) {
    $filePath = $dirPath . '/' . $vin_Number . ".json";
    //print($filePath);
    $car_DetailJson = file_get_contents($filePath);
    //print(json_encode($car_DetailJson, JSON_PRETTY_PRINT));
    if ($car_DetailJson) {
        $carDetails = json_decode($car_DetailJson, true);
        // echo $carDetails['props']['pageProps']['numberDoors'].'<br/>';
        //echo json_encode($carDetails);
        $daraArray = array(
            'noOfDoors' => $carDetails['props']['pageProps']['numberDoors'],
            'condition' => $carDetails['props']['pageProps']['newUsed'],
            'pictures' => json_encode($carDetails['props']['pageProps']['photo'],JSON_PRETTY_PRINT),
            'makeYear' => $carDetails['props']['pageProps']['makeYear'],
            'exteriorCondition' => $carDetails['props']['pageProps']['exteriorCondition'],
            'interiorCondition' => $carDetails['props']['pageProps']['interiorCondition'],
            'state' => $carDetails['props']['pageProps']['initialReduxState']['vdp']['listing']['state']
        );
        //echo json_encode($daraArray);
        $arr = array('data' => json_encode($daraArray), 'code' => 200);
        header('HTTP/1.1 200 OK');
        echo json_encode($arr);
    }
} else {
    $arr = array('message' => 'Invalid VIN Number', 'code' => 400);
    header('HTTP/1.1 400 Bad Request');
    echo json_encode($arr);
}
?>