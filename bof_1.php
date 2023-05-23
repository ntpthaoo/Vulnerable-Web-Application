<div id="menu">

    <table>

        <tr>

            <td><a href="portal.php">Bugs</a></td>
            <td><a href="password_change.php">Change Password</a></td>
            <td><a href="user_extra.php">Create User</a></td>
            <td><a href="security_level_set.php">Set Security Level</a></td>
            <td><a href="reset.php" onclick="return confirm('All settings will be cleared. Are you sure?');">Reset</a></td>
            <td><a href="credits.php">Credits</a></td>
            <td><a href="http://itsecgames.blogspot.com" target="_blank">Blog</a></td>
            <td><a href="logout.php" onclick="return confirm('Are you sure you want to leave?');">Logout</a></td>
            <td><font color="red">Welcome <?php if(isset($_SESSION["login"])){echo ucwords($_SESSION["login"]);}?></font></td>

        </tr>

    </table>

</div>

<div id="main">

    <h1>Buffer Overflow (Local)</h1>

    <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="POST">

        <p>

        <label for="title">Search for a movie:</label>
        <input type="text" id="title" name="title" size="25">    

        <button type="submit" name="action" value="search">Search</button> &nbsp;&nbsp;(<a href="http://sourceforge.net/projects/bwapp/files/bee-box/" target="_blank">bee-box</a> only)

        </p>

    </form>
    <?php

    if(isset($_POST["title"]))
    {

        $title = $_POST["title"];
	$title = commandi($title);

        if($title == "")
        {

            echo "<p><font color=\"red\">Please enter a title...</font></p>";

        }

        else
        {

            echo shell_exec("./apps/movie_search " . $title);

        }

    }

    else
    {

        echo "<p>HINT: \\x90*354 + \\x8f\\x92\\x04\\x08 + [payload]</p>";
        echo "<p>Thanks to David Bloom (@philophobia78) for developing the C++ BOF application!</p>";

    }
    ?>

</div>
