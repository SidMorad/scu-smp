
				<ul id="MenuBar1" class="MenuBarHorizontal">
					<li><a href="index.php?cmd=public/home">Home</a></li>
	<?php 
		if (VH::isUserGrantedWith(Constants::ROLE_ADMIN)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Admin</a>
						<ul>
							<li><a href="index.php?cmd=user/list">User List</a></li>
							<li><a href="index.php?cmd=log/list">Biz Log</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MANAGER)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Manager</a>
						<ul>
							<li><a href="index.php?cmd=coordinator/list">Coordinator List</a></li>
							<li><a href="index.php?cmd=mentor/listAllMentor">Mentor List</a></li>
							<li><a href="index.php?cmd=mentee/listAllMentee">Mentee List</a></li>
							<li><a href="index.php?cmd=course/list">Course List</a></li>
							<li><a href="index.php?cmd=mentee/listMenteesThatWantToBeMentor">Mentee->Mentor</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_COORDINATOR)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Coordinator</a>
						<ul>
							<li><a href="index.php?cmd=matching/listNonTrainedMentor">Active Mentors</a></li>
							<li><a href="index.php?cmd=matching/listNewMentees">Matching Mentee</a></li>
							<li><a href="index.php?cmd=mentor/listMatchedMentor">Matched Mentors</a></li>
							<li><a href="index.php?cmd=mentee/listMatchedMentee">Matched Mentees</a></li>
							<li><a href="index.php?cmd=mentor/listActiveMentor">Mentor set Limit</a></li>
							<li><a href="index.php?cmd=mentormentee/listAllMentorMentee">Contact confirmed ?</a></li>
							<li><a href="index.php?cmd=mentee/listMenteesThatWantToBeMentor">Mentee->Mentor</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MENTOR)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentor</a>
						<ul>
							<li><a href="index.php?cmd=mentor/showProfile">Profile</a></li>
							<li><a href="index.php?cmd=mentor/showProfileMentees">my Mentee(s) info</a></li>
							<li><a href="index.php?cmd=message/messageMentorForm">Send Message</a></li>
						</ul>
					</li>
	<?php		
		}
		if (VH::isUserGrantedWith(Constants::ROLE_MENTEE)) {
	?>
					<li><a href="#" class="MenuBarItemSubmenu">Mentee</a>
						<ul>
							<li><a href="index.php?cmd=mentee/showProfile">Profile</a></li>
							<li><a href="index.php?cmd=mentee/showProfileMentor">my Mentor info</a></li>
							<li><a href="index.php?cmd=message/messageMenteeForm">Send Message</a></li>
						</ul>
					</li>
	<?php		
		}
	?>
						
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
