<?php 
    require_once 'vendor/autoload.php';
    use Clases\Database;
    use Models\City;
    use Models\Region;
    use Models\Country;
    $db = new Database();
    $conn = $db->getConnection('mysql');
    City::setConn($conn);
    Region::setConn($conn);
    Country::setConn($conn);
?>