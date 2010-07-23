
				<ul id="MenuBar1" class="MenuBarHorizontal">
					<li><a href="index.php?cmd=public/home">Home</a></li>
	<?php 
		if (VH::isUserGrantedWith(Constants::ROLE_ADMIN)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Admin</a>
						<ul>
							<li><a href="#">List all users</a></li>
							<li><a href="#">Add new User</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MANAGER)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Manager</a>
						<ul>
							<li><a href="#">All Coordinators</a></li>
							<li><a href="index.php?cmd=student/listMentor">List all Mentors</a></li>
							<li><a href="index.php?cmd=student/listMentee">List all Mentees</a></li>
							<li><a href="#">ReportPerCampus</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_COORDINATOR)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Coordinator</a>
						<ul>
							<li><a href="#">Current Mentors</a></li>
							<li><a href="#">Current Mentees</a></li>
							<li><a href="#">Active Mentors</a></li>
							<li><a href="index.php?cmd=matching/listNewMentees">Matching Mentee</a></li>
							<li><a href="#">Send Message</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MENTOR)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentor</a>
						<ul>
							<li><a href="#">Profile</a></li>
							<li><a href="#">my Mentee(s) info</a></li>
							<li><a href="#">Send Message</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MENTEE)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentee</a>
						<ul>
							<li><a href="#">Profile</a></li>
							<li><a href="#">my Mentor info</a></li>
							<li><a href="#">Send Message</a></li>
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
