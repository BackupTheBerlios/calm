<?
        $db=pg_pconnect($CONFIG["pgsql"]);

        if($db==FALSE) die("<html><body>Unable to connect to Database, please contact the Administrator: ".$CONFIG["adminemail"]);


?>