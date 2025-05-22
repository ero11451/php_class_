<?php

$server = "localhost"; //"tcp:neeboh-server.database.windows.net,1433";
$username = "root";
$password = "fedgac11451"; // Replace with your actual password

try {

  $conn = new PDO("mysql:host=$server", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // $sql = "CREATE DATABASE  IF NOT EXISTS  beauty_store";
  // $conn->exec($sql);
  // $tablePath  = __DIR__ . '/tables.sql';
  // $table = file_get_contents( $tablePath  );
  // $conn->exec( $table );

  $conn->exec("USE beauty_store");
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}



function query($sql, $params = [])
{
  try {

    global $conn; // ✅ Access global PDO connection

    $stmt =  $conn->prepare($sql);

    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo '<pre> err' . "<br>" . $e->getMessage() . '</pre>';
  }
}

function initialTableSetup($conn){
  $tablePath  = __DIR__ . '/tables.sql';
  $table = file_get_contents( $tablePath  );
  $conn->exec( $table );
}


// function getDatabase(): PDO {
//     $dsn = 'mysql:host=localhost;dbname=todo';
//     $user = 'db_user';
//     $pass = 'db_pass';
//     $pdo = new PDO($dsn, $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $pdo;
// }
// try {  
// $conn;
// $servername = "localhost";
// $username = "root";
// $password = "";
//   $conn = new PDO("mysql:host=$servername", $username, $password);
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $sql = "CREATE DATABASE  IF NOT EXISTS  benin";
//   $conn->exec($sql);
//   $conn->exec("USE benin");
// } catch(PDOException $e) {
//   echo $sql . "<br>" . $e->getMessage();
// }

// function initalValueSetup($conn){

//   $tablePath  =  basePath('db/initailData.sql');

//   $table = file_get_contents( $tablePath  );

//   $conn->exec( $table );

// }
