<?php
require "incl/cms_init.php";

	if ($auth->auth_role == 'admin' || 'retailer') {
		$user_id = $auth->auth_user_id;
		$user = new user();


		$mode = isset($_REQUEST["mode"]) && !empty($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";

		switch(strtoupper($mode)) {

			// RETAILER DETAILS
			default:
			case "LIST":
				require DOCROOT . "/cms/incl/header.php";
				$user->fetch_retailer($user_id);

				echo "<h3>$user->name</h3>
					<p>$user->address</p>
					<a href='?mode=edit'>Edit Address</a>";

				break;

			//EDIT ADDRESS
			case "EDIT":
				require DOCROOT . "/cms/incl/header.php";
				$user->fetch_retailer($user_id);
				//Form (start)
				echo "<form action='?mode=save' method='POST'>
					<input type='hidden' name='id' value='$user_id'>
					<div class='form-group'>
						<label for='address'>Address</label>
						<input type='text' name='address' value='$user->address'>
					</div>
					
					<input type='submit' name='submit'>
				</form>";
				// Form (end)

				break;


			//  UPDATE ADDRESS
			case "SAVE":

				$user->retail_address($_POST['address'], $user_id);

				header("Location: retail_address.php");
				break;
		}
	}
	else {
	header("Location: index.php");
	}