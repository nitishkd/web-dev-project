<?php
// configuration
require("../includes/config.php");
// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
// else render form
render("change_password_form.php", ["title" => "Change Password"]);
}
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$result=query("SELECT * FROM users WHERE id = ?",$_SESSION["id"]);
	$row=$result[0]["hash"];
	if (empty($_POST["current_password"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["new_password"]))
        {
            apologize("You must provide your password.");
        }
	 else if (empty($_POST["confirm_new_password"]))
        {
            apologize("You must provide your password.");
        }
 	else if ($_POST["new_password"]!=$_POST["confirm_new_password"])
        {
            apologize("Confirmation password dows not match. Try again");
        }
	//update password
	$cpr=query("UPDATE users set hash = ? WHERE id = ?", crypt($_POST["new_password"]), $_SESSION["id"]);
	if($cpr === false)
	{
	    apologize("Something Went wrong. Try again");
	}
	else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
	
}
else
    {
        // else render form
        render("portfolio.php", ["title" => "Portfolio"]);
    }
?>
