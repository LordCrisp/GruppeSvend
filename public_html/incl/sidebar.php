<aside class="sidebar__main">
	<!-- Collection Area (start) -->
	<section class="sidebar__collections">
		<?php
		$collection = new collection();
		$i = 1;
		foreach ($collection->sidebarCollection() as $collections) {

			echo "<figure>
					<img src='/assets/img/collections/" . ($size = ($i == 1) ? "big" : "small") . "/$collections[thumbnail]' alt='$collections[name] image' >
					<figcaption>$collections[name]</figcaption>
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
        <button type="submit">Signup</button>
    </form>
	<!-- Collection Area (start) -->
</aside>