<?php




include("security.php");
include("security_level_check.php");
include("selections.php");
include("connect_i.php");

$message = "";

if(isset($_REQUEST["action"]) && isset($_REQUEST["password_new"]) && isset($_REQUEST["password_conf"]))
{
    
    $password_new = $_REQUEST["password_new"];
    $password_conf = $_REQUEST["password_conf"];
    
    if($password_new == "")
    {
        
        $message = "<font color=\"red\">Please enter a new password...</font>";       
        
    }
    
    else
    {

        if($password_new != $password_conf)
        {

            $message = "<font color=\"red\">The passwords don't match!</font>";       

        }

        else            
        {

            $login = $_SESSION["login"];
            
            $password_new = mysqli_real_escape_string($link, $password_new);
            $password_new = hash("sha1", $password_new, false);    

            if($_COOKIE["security_level"] != "1" && $_COOKIE["security_level"] != "2") 
            {

                $sql = "UPDATE users SET password = '" . $password_new . "' WHERE login = '" . $login . "'";

                // Debugging
                // echo $sql;      

                $recordset = $link->query($sql);

                if(!$recordset)
                {

                    die("Connect Error: " . $link->error);

                }
                
                $message = "<font color=\"green\">The password has been changed!</font>";

            }

            else
            {
                
                if(isset($_REQUEST["password_curr"]))
                {
                              
                    $password_curr = $_REQUEST["password_curr"];
                    $password_curr = mysqli_real_escape_string($link, $password_curr);
                    $password_curr = hash("sha1", $password_curr, false);                

                    $sql = "SELECT password FROM users WHERE login = '" . $login . "' AND password = '" . $password_curr . "'";

                    // Debugging
                    // echo $sql;    

                    $recordset = $link->query($sql);             

                    if(!$recordset)
                    {

                        die("Connect Error: " . $link->error);

                    }

                    // Debugging                
                    // echo "<br />Affected rows: ";                
                    // printf($link->affected_rows);

                    $row = $recordset->fetch_object();   

                    if($row)
                    {

                        // Debugging
                        // echo "<br />Row: ";
                        // print_r($row);

                        $sql = "UPDATE users SET password = '" . $password_new . "' WHERE login = '" . $login . "'";

                        // Debugging
                        // echo $sql;

                        $recordset = $link->query($sql);

                        if(!$recordset)
                        {

                            die("Connect Error: " . $link->error);

                        }

                        // Debugging              
                        // echo "<br />Affected rows: ";         
                        // printf($link->affected_rows);

                        $message = "<font color=\"green\">The password has been changed!</font>";

                    }

                    else
                    {

                        $message = "<font color=\"red\">The current password is not valid!</font>";

                    }
                
                }
                
            }
                           
        } 
    
    }
    
}

?>
<!DOCTYPE html>
<html>
    
<head>
        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Architects+Daughter">-->
<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

<!--<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script src="js/html5.js"></script>

<title>bWAPP - CSRF</title>

</head>

<body>
    
<header>

<h1>bWAPP</h1>

<h2>an extremely buggy web app !</h2>

</header>    


<div id="main">
    
    <h1>CSRF (Change Password)</h1>

    <p>Change your password.</p>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="GET">
        
<?php

        if($_COOKIE["security_level"] == "1" or $_COOKIE["security_level"] == "2")
        {

?>
        <p><label for="password_curr">Current password:</label><br />
        <input type="password" id="password_curr" name="password_curr"></p>

<?php        

        }

?>
        <p><label for="password_new">New password:</label><br />
        <input type="password" id="password_new" name="password_new"></p>

        <p><label for="password_conf">Re-type new password:</label><br />
        <input type="password" id="password_conf" name="password_conf"></p>  

        <button type="submit" name="action" value="change">Change</button>   

    </form>

    <br />
    </div>
    
    

    

      
</body>
    
</html>