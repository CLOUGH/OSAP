<?php

function get_navigation_bar($type)
{
	$main_location = $_SESSION['main_location'];
	if($type=='student')
	{
		$navigation_html_markup =
			'<nav>
				<ul>
					<li><a href="'.$main_location.'/home">Home</a></li>
					<li><a href="">Profile Management</a>
						<ul class="drop_down_list">
							<li><a href="'.$main_location.'/profile">View Student Profile</a></li>
						</ul>
					</li>
					<li><a href=""  >Course Advisory</a>
						<ul class="drop_down_list" >
							<li><a href="'.$main_location.'/view_recommended_courses">Get Recommended</a></li>
							<li><a href="">Review Course</a></li>
							<li><a href="">Compare Course Timetables</a></li>
						</ul>
					</li>
					<li><a href="">Register</a>
						<ul class="drop_down_list">
							<li><a href="">Register Course</a></li>
							<li><a href="">Request Override</a></li>
						</ul>
					</li>
				</ul>
			</nav>';
	}
	return $navigation_html_markup;
}

?>
