<?php  
/*  
=============  
This file is part of a Microsoft SQL Server Shared Source Application.  
Copyright (C) Microsoft Corporation.  All rights reserved.  
  
THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY  
KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE  
IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A  
PARTICULAR PURPOSE.  
=============  
*/  


try
{  
    $conn = new PDO( "sqlsrv:server=".getenv('DB_HOST')." ; Database=".getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));  
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
}  
catch(Exception $e){   
    die( print_r( $e->getMessage() ) );   
}  
  
/* Get the product picture for a given product ID. */  
try  
{  
    $tsql = "SELECT * FROM ".getenv('DB_TABLE');  
    $stmt = $conn->prepare($tsql);  
    $stmt->execute();  
    while ($row = $stmt->fetch()) {
        print_r($row);
    }
}  
catch(Exception $e)  
{   
    die( print_r( $e->getMessage() ) );   
}  
?>  