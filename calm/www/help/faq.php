<html>
<title>CALM - FAQ</title>
<body>
<? include('menu.inc') ?>

<h1>CALM - FAQ</h1>

<h2>What...</h2>

<h3>What is CALM?</h3>

CALM is a License Management System, aimed on solving the problems of the license purchaser
and especially the administrators in a company.<p>

The goal is to give the admin an overview over all programs/licenses installed in the
companies network. To see when to buy new licenses. When to upgrade them. And most important:
where spare lincenses lie around while other departments/users need them.

<h3>What is needed to install it?</h3>

A Linux or Unix Box with <a href="http://www.apache.org">Apache</a> (>=1.2), <a href="http://www.php.net">PHP</a> (4.x)
and <a href="http://www.postgresql.org">Postgres</a> (7.x).<p>

Any Linux Distribution should suffice (We tested Debian and SuSE). HP-UX is ok (although you need to compile
PHP statically into your Apache - HP-UX' DLL support s*cks).<p>

See our <a href="install.php">Install</a> Page for details.

<h2>The big WHY's</h2>

<h3>Why License Management?</h3>

We discovered that our company might have a problem with too high license costs. Since
most commercial License Management systems solve the sellers problems, we needed our
own one: to solve the customers problems.


<h3>Why GPL as the License of CALM?</h3>

We wanted to solve License Problems, not to create ones.<p>

GPL gives us the possibility to develop this system openly together with everybody who
has the same problems and knows how to program PHP.<p>

It enables everybody to use the system without solving the problems first (after
solving them it would be worthless).

<h3>Why based on PHP, Apache, and Postgres? Why not Oracle/Informix/Sybase/MSSQL, IIS/...?</h3>

See above: we wanted to solve problems, not to produce ones.<p>

Besides: these three are among the best and most professional systems one can find.


<h2>The little why's</h2>

<h3>Why call it CALM?</h3>

It sounds funny.

<h3>Weird, don't you have better things to do?</h3>

Sure.

<h3>Why bother?</h3>

Oh, shut up!


<? include('footer.inc') ?>