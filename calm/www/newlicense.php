<? include('all.inc') ?>
<html>
<title>New License</title>
<body>
<? printmenu() ?>

<h1>New License</h1>


<?
//Stage 0: Request Product:
if(!isset($HTTP_VARS["stage"])){
?>
<form action="newlicense.php">
<input type="hidden" name="stage" value="vers">
Product: <select name="productid">
<?
        $res=pg_exec("select * from product order by product.product");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<option value=\"".$ar["productid"]."\">".$ar["product"]."\n");
        }
        pg_freeresult($res);
?>
</select><p>

<input type="submit" value="Next>>">
</form>


<? } else //stage 1: version and amount
   if($HTTP_VARS["stage"]=="vers"){
?>

<form action="newlicense.php">
<input type="hidden" name="stage" value="fill">
<input type="hidden" name="productid" value=<? print("\"".$HTTP_VARS["productid"]."\"") ?>>
<table>
<tr><td>Version:<td><select name="versionid">
<?
        $res=pg_exec("select * from version order by version.version");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<option value=\"".$ar["versionid"]."\">".$ar["version"]."\n");
        }
        pg_freeresult($res);
?>
</select>
<tr><td>Amount:<td><input type="text" name="amount" value="1">
</table><p>

<input type="submit" value="Next>>">
</form>

<? } else //stage 2: Fill in values:
   if($HTTP_VARS["stage"]=="fill"){
?>

<form action="newlicense.php">
<input type="hidden" name="stage" value="finish">
<input type="hidden" name="productid" value=<? print("\"".$HTTP_VARS["productid"]."\"") ?>>
<input type="hidden" name="versionid" value=<? print("\"".$HTTP_VARS["versionid"]."\"") ?>>
<input type="hidden" name="amount" value=<? print("\"".$HTTP_VARS["amount"]."\"") ?>>

<table frame=1 border=1>
<tr>
 <td><b>Project</b>
 <td><b>Possessor</b>
 <td><b>Status</b>
 <td><b>License Number</b>
 <td><b>Expiration</b>
 <td><b>Comment</b>

<?
        $res=pg_exec("select * from status order by status");
        $sln=pg_numrows($res);
        $stat=array();
        for($j=0;$j<$sln;$j++)$stat[]=pg_fetch_array($res,$j);
        pg_freeresult($res);

        for($i=0;$i<($HTTP_VARS["amount"]+0);$i++){
                print("<tr>");
                print("<td><input type=\"text\" name=\"project\">");
                print("<td><input type=\"text\" name=\"possessor\">");
                print("<td><select name=\"statusid\">");
                for($j=0;$j<$sln;$j++)
                        print("<option value=\"".$stat[$j]["statusid"]."\">".$stat[$j]["status"]);
                print("<td><input type=\"text\" name=\"licensenumber\">");
                print("<td><input type=\"text\" name=\"expiration\">");
                print("<td><textarea name=\"comment\" rows=\"4\" cols=\"20\"></textarea>");
                print("</tr>\n");
        }
?>

</table><p>

<input type="submit" value="Finish">
</form>

<? } else //stage 3: Finish
   if($HTTP_VARS["stage"]=="finish"){

        pg_exec("insert into license(versionid,project,adminid,statusid,possessor,licensenumber,expiration,comment)values(".
          ($HTTP_VARS["versionid"]+0).",'".
          addslashes($HTTP_VARS["project"])."','".
          $user->getusername()."',".
          
        );
?>

Done.

<? } /*endif*/ ?>


<? printfooter() ?>