<? include('all.inc') ?>
<html>
<title>Products</title>
<body>
<? printmenu() ?>
<h1>Products</h1>

<? if(isset($HTTP_VARS["donewproduct"])){
        pg_exec("insert into product(product,supplier,description)values('".addslashes($HTTP_VARS["product"])."','".
                addslashes($HTTP_VARS["supplier"])."','".addslashes($HTTP_VARS["description"])."')");
 } /*endif donewproduct*/ ?>

<table frame=1 border=1>

<tr>
 <td><b>Product</b>
 <td><b>Supplier</b>
 <td><b>Description</b>
</tr>

<?
        $res=pg_exec($db,"select * from product order by product");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<tr><td><a href=\"version.php?product=".$ar["productid"]."\">".db2html($ar["product"])."</a>");
                print("<td>".db2html($ar["supplier"])."<td>".db2html($ar["description"])."</tr>\n");
        }
        pg_freeresult($res);
?>

</table><p>

[<a href="product.php?newproduct=1">New Product</a>]<p>


<? if(isset($HTTP_VARS["newproduct"])) { ?>
<form action="product.php" method="POST">
<input type="hidden" name="donewproduct" value="1">
<table>
<tr><td align="right">Product Name:<td><input type="text" name="product">
<tr><td align="right">Supplier:<td><input type="text" name="supplier">
</table><br>
Description:<br>
<textarea cols="80" rows="15" name="description"></textarea><p>
<input type="submit" value="Add">
</form>

<? } /*endif newproduct*/ ?>





<? printfooter() ?>