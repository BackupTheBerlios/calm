<?

        class User
        {
                var $username;

                function User()
                {
                        global $PHP_AUTH_USER,$PHP_AUTH_PW,$CONFIG,$db;

                        if(!isset($PHP_AUTH_USER) && !isset($PHP_AUTH_PW)){
                                $this->fail();
                        } else {
                                $res=pg_exec("select passwd from admin where loginname='".addslashes($PHP_AUTH_USER)."'");
                                if(pg_numrows($res)<1)$this->fail();
                                $dpw=explode(" ",pg_result($res,0,0));
                                pg_freeresult($res);
                                $pw=md5($dpw[0].$PHP_AUTH_PW);
                                if($pw!=$dpw[1]){
                                        $this->fail();
                                }
                        }



                        $this->username=$PHP_AUTH_USER;
                }

                function fail()
                {
                        Header("WWW-Authenticate: Basic realm=\"CALM Login\"");
                        Header("HTTP/1.0 401 Unauthorized");
                        echo "Login failed.";
                        exit;
                }


                function getusername()
                {
                        return $this->username;
                }

                function isadmin($usr=false)
                {
                        global $CONFIG;
                        if($usr==false)$usr=$this->username;
                        $isa=false;
                        $ad=$CONFIG["admin"];
                        reset($ad);
                        while(list($k,$v)=each($ad))
                                if($v==$usr)
                                        $isa=1;

                        return $isa;
                }


        };

        $user=new User;

?>