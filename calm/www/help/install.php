<html>
<title>Installing CALM</title>
<body>
<? include('menu.inc') ?>

<h1>Installing CALM</h1>

<h2>Preparation</h2>


<ol>
<li>Install a Linux or Unix or get an installed box...

<li>This box needs to be at the LAN of the Company, reachable by all Admins. Preferably not visible from outside the Intranet.<p>

<li>Ensure <a href="http://www.apache.org">Apache</a> (>=1.2), <a href="http://www.php.net">PHP</a> (4.x)
and <a href="http://www.postgresql.org">Postgres</a> (7.x) are installed. See the notes below if you have trouble with that,
otherwise go on with installing CALM. If you can install Apache with SSL-Support - each page impression in CALM will transport your
unencrypted CALM-Password - you don't want it to be seen by others.
</ol>

<h3>On installing Apache and PHP</h3>

This is normally no problem with Linux'es, since they carry preconfigured packages, which you just need to install.

....[to be finished]

<h3>On configuring Apache for PHP</h3>


<h2>CALM</h2>


<ol>
<li>Get the <a href="http://calm.rosenbaum.myip.org">CALM source package</a>.

<li>Edit the Makefile in it according to the Values you want for the Database.

<li>Call <tt>make</tt> to let the script create the database. <b>Important:</b> this must be run as database
admin (one who is allowed to create new DB's and Users) and  should <b>never</b> be run on an already created database.

<li>Copy the subdirectory <tt>www</tt>'s content to the location you want to have the server run. This can be a
subdirectory of an existing Apache-Documentroot or the Documentroot of it.

<li>Rename <tt>config.inc.sample</tt> to <tt>config.inc</tt> and customize it.

<li>When CALM is configured and reachable (no more Database errors in <tt>start.php</tt>), log in as the initial
User. Username is 'hello' Password is 'wall'.

<li>Create new users, make sure that you create at least one new admin (see <tt>config.inc</tt>). Try to log in
as this new admin and make sure this account has all desired privileges.

<li>Delete the user 'hello'.

<li>Ready.
</ol>








<? include('footer.inc') ?>