<? include('all.inc') ?>
<html>
<title>License Index</title>
<body>
<? printmenu() ?>


<h1>License Index</h1>


<h2>Overview</h2>

<table frame=1 border=1>
<tr>
 <td><b>Category</b>
 <td><b>Amount</b>

<?

        $stati=pg_exec($db,"select * from status order by statusid");
        $ln=pg_numrows($stati);
        for($i=0;$i<$ln;$i++){
                $stat=pg_fetch_array($stati,$i);
                $amtr=pg_exec("select count(licenseid) from license where adminid='".$user->getusername()."' and statusid=".$stat["statusid"]);
                $amt=pg_result($amtr,0,0);
                pg_freeresult($amtr);
                print("<tr><td><font color=\"".$stat["colordef"]."\">".($amt>0?"<b>":"").$stat["status"].($amt>0?"</b>":"")."</font><td>");
                print($amt."</tr>\n");
        }

        pg_freeresult($stati);

?>

</table>

<h2>Expirations</h2>

(yet not working)<p>

<table frame=1 border=1>
<tr>
 <td><b>Product</b>
 <td><b>Version</b>
 <td><b>Licensenumber</b>
 <td><b>Possessor</b>


</table>

<?
        printfooter();
?>