<? include('all.inc') ?>
<html>
<title>My Licenses</title>
<body>
<? printmenu() ?>

<h1>My Licenses</h1>

<table frame="1" border="1">

<tr>
 <td><b>Product</b>
 <td><b>Version</b>
 <td><b>License</b>
 <td><b>Status</b>

<?
        $res=pg_exec("select * from product,version,license,status where ".
                        "product.productid=version.productid AND ".
                        "version.versionid=license.versionid AND ".
                        "status.statusid=license.statusid AND ".
                        "license.adminid='".$user->getusername()."' ".
                        "ORDER BY product.product,version.version,status.status");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<tr>");
                print("<td>".db2html($ar["product"]));
                print("<td>".db2html($ar["version"]));
                print("<td>".db2html($ar["licensenumber"]));
                print("<td>".db2html($ar["status"]));
                print("</tr>\n");
        }
        pg_freeresult($res);
?>
</table>


<? printfooter() ?>