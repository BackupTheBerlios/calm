<? include('all.inc');

        if(!isset($HTTP_VARS["product"])){
                Header("Location: product.php");
                exit;
        }

        $res=pg_exec("select * from product where productid=".($HTTP_VARS["product"]+0));
        if(pg_numrows($res)<1){
                Header("Location: product.php");
                exit;
        }
        $prod=pg_fetch_array($res,0);
        pg_freeresult($res);

?>
<html>
<title>Versions</title>
<body>

<? printmenu() ?>

<h1>Versions of <? echo $prod["product"] ?></h1>

<table>
<tr><td bgcolor="#c0c0c0"><? print(db2html($prod["description"])) ?>
</table><p>



<table frame="1" border="1">
<tr>
 <td><b>Version</b>
 <td><b>Initial Costs ($)</b>
 <td><b>Fix Costs/Value ($)</b>
 <td><b>Variable Costs ($/d)</b>
 <td><b>Supported</b>
 <td><b>Comment</b>

<?

        $res=pg_exec("select * from version where productid=".$prod["productid"]." order by version");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<tr>");
                print("<td>".db2html($ar["version"]));
                print("<td>".$ar["costs_initial"]);
                print("<td>".$ar["costs_fix"]);
                print("<td>".$ar["costs_bytime"]."/".$ar["costs_timeframe"]);
                print("<td>".($ar["supported"]?"yes":"no"));
                print("<td>".db2html($ar["comment"]));
                print("</tr>\n");
        }
        pg_freeresult($res);

?>

</table><br>

[<? print("<a href=\"version.php?newversion=1&product=".$prod["productid"]."\">New Version</a>"); ?>]<p>

<? if(isset($HTTP_VARS["newversion"])){ ?>

<h2>New Version</h2>

<form action="version.php" method="POST">
<? print("<input type=\"hidden\" name=\"product\" value=\"".$prod["productid"]."\">"); ?>

<table>
<tr><td>Version:<td><input type="text" name="version">
<tr><td>Initial Costs:<td><input type="text" name="costs_initial">
<tr><td>Fix Costs:<td><input type="text" name="costs_fix">
<tr><td>Variable Costs:<td><input type="text" name="costs_bytime">
        per <input type="text" name="costs_timeframe" size="4">days
<tr><td>Supported:<td><input type="checkbox" name="supported">
</table><br>
Comment:<br>
<textarea name="comment" rows="5" cols="40">
</textarea><p>

<input type="submit" name="donewversion" value="Create new Version">

</form>

<? } /*endif newversion*/ ?>

<? printfooter() ?>