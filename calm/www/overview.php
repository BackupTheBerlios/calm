<? include('all.inc');


        if(!$user->isadmin()){
                Header("Location: start.php");
                exit;
        }
?>
<html>
<title>Company License Overview</title>
<body>

<? printmenu() ?>

<h1>Company License Overview</h1>

<h2>Statistics</h2>

<table frame=1 border=1>
<tr>
 <td><b>Category</b>
 <td><b>Amount</b>
 <td><b>Value ($)</b>

<?

        $stati=pg_exec($db,"select * from status order by statusid");
        $ln=pg_numrows($stati);
        for($i=0;$i<$ln;$i++){
                $stat=pg_fetch_array($stati,$i);
                $amtr=pg_exec("select count(licenseid) from license where statusid=".$stat["statusid"]);
                $amt=pg_result($amtr,0,0);
                pg_freeresult($amtr);
                print("<tr><td><font color=\"".$stat["colordef"]."\">".($amt>0?"<b>":"").$stat["status"].($amt>0?"</b>":"")."</font><td>");
                print($amt."</tr>\n");
        }

        pg_freeresult($stati);

?>

</table>


<h2>Filter/Search</h2>

<b>Please select Filter criteria:</b><br>
Wildcard=%<br>

<form action="overview.php" method="GET">
<table>
<tr><td align="right">Status:<td><select name="f_status"><option value="all">---all---</select>
<tr><td align="right">Admin:<td><select name="f_admin"><option value="all">-----all-----</select>
<tr><td align="right">Project:<td><input type="text" name="f_project" value="%">
<tr><td align="right">Possessor:<td><input type="text" name="f_possessor" value="%">
<tr><td align="right">License Number:<td><input type="text" name="f_licensenumber" value="%">
<tr><td align="right">Expiration within the next:<td><input type="text" name="f_project" value="--">days
</table><p>

<b>Select grouping:</b> <select name="group"><option value="none">None</select><p>

<b>Select Sorting:</b><br>
1. <select name="sort1">
 <option value="status">Status
 <option value="admin">Admin
 <option value="project">Project
 <option value="posessor">Possessor
 <option value="licensenumber">License Number
 <option value="expiration">Expiration
 </select>
 <input type="checkbox" name="ascend1">Descending<br>
2. <select name="sort2">
 <option value="-">None
 <option value="status">Status
 <option value="admin">Admin
 <option value="project">Project
 <option value="posessor">Possessor
 <option value="licensenumber">License Number
 <option value="expiration">Expiration
 </select>
 <input type="checkbox" name="ascend2">Descending<br>
3. <select name="sort3">
 <option value="-">None
 <option value="status">Status
 <option value="admin">Admin
 <option value="project">Project
 <option value="posessor">Possessor
 <option value="licensenumber">License Number
 <option value="expiration">Expiration
 </select>
 <input type="checkbox" name="ascend3">Descending<p>

<input type="submit" name="search" value="Search">
</form>

<? printfooter() ?>