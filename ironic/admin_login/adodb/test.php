<?php 
    include('adodb.inc.php'); # load code common to ADOdb 
    $conn = &ADONewConnection('mysql'); # create a connection 
    //$conn->PConnect('root','',);

    /*$recordSet = &$conn->Execute('select * from products'); 

    if (!$recordSet) 
        print $conn->ErrorMsg(); 
    else 
        while (!$recordSet->EOF) { 
            print $recordSet->fields[0].' '.$recordSet->fields[1].'<BR>'; 
            $recordSet->MoveNext(); 
        }    $recordSet->Close(); # optional 
    $conn->Close(); # optional */

?> 