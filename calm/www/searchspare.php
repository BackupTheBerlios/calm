<? include('all.inc') ?>
<html>
<title>Search spare Licenses</title>
<body>

<? printmenu() ?>

<h1>Search spare Licenses</h1>

<? if(!isset($HTTP_VARS["stage"])){ ?>
<form action="searchspare.php" method="GET">
<input type="hidden" name="stage" value="vers">
Product: <select name="productid">
<?
        $res=pg_exec("select * from product order by product");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<option value=\"".$ar["productid"]."\">".$ar["product"]."\n");
        }
?>
</select><p>
<input type="submit" value="Next>>">
</form>

<? } /*endif stage*/ ?>

<? printfooter() ?>