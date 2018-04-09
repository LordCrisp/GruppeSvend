<aside class="sidebar__main">
	<!-- Collection Area (start) -->
	<section class="sidebar__collections">
        <h2>Collections</h2>
		<?php
		$collections = new collections();
		$i = 1;
		foreach ($collections->sidebarCollection() as $collection) {

			echo "<figure class='sidebar__collections--image'>
					<img src='/assets/img/collections/" . ($size = ($i == 1) ? "big" : "small") . "/$collection[thumbnail]' alt='$collection[name] image' >
				</figure>";
			$i++;
		}?>
	</section>
    <form method="post">
        <h2>Signup to newsletter</h2>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" required>
        </div>
        <button type="submit" name="submit">Signup</button>
    </form>
	<?php 
		if (isset($_POST['submit'])) {
			$email = $_POST['email'];
			$name = $_POST['name'];

			$params = array(
				$email
			);
			$sql = "SELECT * FROM newsletter WHERE email = ?";
			$emailCheck = $db->fetch_array($sql, $params);

			if (!empty($emailCheck)) {
				$msg = "This email is already signed up for our newsletters";
			} elseif (empty($emailCheck)) {
				$params = array(
					$name,
					$email
				);
				$sql = "INSERT INTO newsletter (name, email) VALUES (?,?)";
				$db->query($sql, $params);

				$msg = "Thank you ".$_POST['name'].", you have signed up for our newsletters with email ".$_POST['email']."";
			}
		?>

			<!-- POPUP MODUL HER -->
			<?=$msg?>

		<?php
		}
	?>
	<!-- Collection Area (start) -->
</aside>