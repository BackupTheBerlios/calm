<?

        include('config.inc');

        include('db.inc');
        include('user.inc');



        function printmenu()
        {
                global $user;

                print("[<a href=\"start.php\">Index</a>]\n");
                print("[<a href=\"licenses.php\">My&nbsp;licenses</a>]\n");
                print("[<a href=\"newlicense.php\">Enter&nbsp;new&nbsp;License</a>]\n");
                print("[<a href=\"product.php\">Products</a>]\n");
                print("[<a href=\"searchspare.php\">Search&nbsp;spare&nbsp;licenses</a>]\n");

                if($user->isadmin()){
                        print("[<a href=\"admin.php\">Admin<sup>2</sup></a>]\n");
                        print("[<a href=\"overview.php\">Company&nbsp;Overview</a>]\n");

                }

                print("[<a href=\"help/\" target=\"_new\">Help/About</a>]\n");

                print("<hr>\n");
        }


        function printfooter()
        {
                global $user;
                print("\n<hr>\nUser: ".($user->getusername())."<p>\n</body>\n</html>");
        }



        function db2html($str)
        {
                return nl2br(htmlentities($str));
        }

      //merge GET/POST variables
        unset($HTTP_VARS);
        foreach($HTTP_POST_VARS as $k => $v){
                $HTTP_VARS[$k] = $v;
        }
        foreach($HTTP_GET_VARS as $k => $v){
                $HTTP_VARS[$k] = $v;
        }
        unset($k,$v);


?>