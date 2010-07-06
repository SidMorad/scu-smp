
				<ul id="MenuBar1" class="MenuBarHorizontal">
					<li><a href="index.php?cmd=public/home">Home</a></li>
	<?php 
		if (VH::isUserGrantedWith('ROLE_ADMIN')) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Admin</a>
						<ul>
							<li><a href="#">SubAdmin1</a></li>
							<li><a href="#">SubAdmin2</a></li>
							<li><a href="#">SubAdmin3</a></li>
							<li><a href="#">SubAdmin...</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith('ROLE_MANAGER')) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Manager</a>
						<ul>
							<li><a href="#">Manager1</a></li>
							<li><a href="#">Manager2</a></li>
							<li><a href="#">Manager3</a></li>
							<li><a href="#">Manager...</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith('ROLE_COORDINATOR')) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Coordinator</a>
						<ul>
							<li><a href="#">Coordinator1</a></li>
							<li><a href="#">Coordinator2</a></li>
							<li><a href="#">Coordinator3</a></li>
							<li><a href="#">Coordinator...</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith('ROLE_MENTOR')) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentor</a>
						<ul>
							<li><a href="#">Mentor1</a></li>
							<li><a href="#">Mentor2</a></li>
							<li><a href="#">Mentor3</a></li>
							<li><a href="#">Mentor...</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith('ROLE_MENTEE')) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentee</a>
						<ul>
							<li><a href="#">Mentee1</a></li>
							<li><a href="#">Mentee2</a></li>
							<li><a href="#">Mentee3</a></li>
							<li><a href="#">Mentee...</a></li>
						</ul>
					</li>
	<?php		
		}
	?>
	
					<li><a href="index.php?cmd=public/album">Album</a></li>
					<li><a href="index.php?cmd=public/about">About Us</a></li>
					<li><a href="index.php?cmd=public/contact">Contact Us</a></li>
	<?php 
		if (VH::isUserAuthenticated()) {
	?>
	
					<li><a href="index.php?cmd=public/logout">Logout</a></li>
	<?php 
		} else {
	?>
					<li><a href="index.php?cmd=public/login">Login</a></li>
					<li><a href="#" class="MenuBarItemSubmenu">Join Us</a>
						<ul>
							<li><a href="index.php?cmd=signup/mentor">Mentor</a></li>
							<li><a href="index.php?cmd=signup/mentee">Mentee</a></li>
						</ul>
					</li>
	<?php		
		}
	?>
	
				</ul>
