<? include('all.inc');

      if(!$user->isadmin()){
                Header("Location: start.php");
                exit;
        }
      if(isset($HTTP_VARS["loginname"])&&$HTTP_VARS["passwd"]==$HTTP_VARS["passwd2"]){
                $rnd="".(rand()%10000);
                pg_exec("insert into admin(loginname,passwd,email,fname,name,comment) values('".
                addslashes($HTTP_VARS["loginname"])."','".
                $rnd." ".md5($rnd.$HTTP_VARS["passwd"])."','".
                addslashes($HTTP_VARS["email"])."','".
                addslashes($HTTP_VARS["fname"])."','".
                addslashes($HTTP_VARS["name"])."','".
                addslashes($HTTP_VARS["comment"]).
                "')");
        }

?>
<html>
<title>Administration</title>
<body>
<? printmenu() ?>

<h1>Administration of Accounts</h1>

<form action="admin.php" method="POST">
<table frame="1" border="1">
<tr>
 <td><b>X</b>
 <td><b>Username</b>
 <td><b>eMail</b>
 <td><b>Name</b>
 <td><b>Comment</b>
 <td><b>Level</b>

<?
        $res=pg_exec("select * from admin order by loginname");
        $ln=pg_numrows($res);
        for($i=0;$i<$ln;$i++){
                $ar=pg_fetch_array($res,$i);
                print("<tr>");
                print("<td><input type=\"checkbox\" name=\"user[]\" value=\"".$ar["loginname"]."\">");
                print("<td>".$ar["loginname"]);
                print("<td><a href=\"mailto:".db2html($ar["email"])."\">".db2html($ar["email"])."</a>");
                print("<td>".db2html($ar["name"]).", ".db2html($ar["fname"]));
                print("<td>".db2html($ar["comment"]));
                print("<td>".(($user->isadmin($ar["loginname"]))?"admin ":"").(($ar["passwd"]=="")?"locked":""));
                print("</tr>\n");
        }
        pg_freeresult($res);

?>
</table><br>

<input type="submit" name="action" value="Lock"><br>
<input type="submit" name="action" value="Set Password"><br>
<input type="submit" name="action" value="Delete"><br>

</form>
<p>

[<a href="admin.php?newuser=1">New User</a>]


<? if(isset($HTTP_VARS["newuser"])){ ?>

<h2>New User</h2>

<form action="admin.php" method="POST">
<table>
<tr><td>Login Name:<td><input type="text" name="loginname">
<tr><td>Password:<td><input type="password" name="passwd">
<tr><td> Repeat:<td><input type="password" name="passwd2">
<tr><td>eMail:<td><input type="text" name="email">
<tr><td>Family Name:<td><input type="text" name="name">
<tr><td>First Name:<td><input type="text" name="fname">
</table><br>
Comment:<br>
<textarea name="comment" rows="5" cols="40">
</textarea><p>

<input type="submit" name="action" value="Create User">
</form>

<? } /*endif newuser*/ ?>


<? printfooter() ?>
