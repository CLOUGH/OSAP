<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>View Recommended Courses</title>
	<link rel ="stylesheet" type="text/css" href="stylesheet/view_recommended_courses.css" />
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/
	main_style.css" />	
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/navigation_bar.css" />
	<script src="../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js">
	
	</script>
	
</head>
<body>
	<div class="wrapper">
		<div class="header" >
			<div class="notification">
				<spam id="user_name"><?php echo 'ID#:'.$_SESSION['username'];?></spam>
				<a href="#" ><img id="mail_img" src="../common/images/e_mail_16x16.png" /></a>
			</div>
			<h1 id="test">Student Online Advisory Portal</h1>
			<nav>
				<ul>
					<li><a href="">Home</a></li>
					<li><a href="">Profile Management</a>
						<ul class="drop_down_list">
							<li><a href="">View Student Profile</a></li>
							<li><a href="">Edit Personal Profile</a></li>
							<li><a href="">Update Security</a></li>
						</ul>
					</li>
					<li><a href=""  >Course Advisory</a>
						<ul class="drop_down_list" >
							<li><a href="">Get Recommended</a></li>
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
			</nav>
		</div>
		<div class="content" >
			<dl>
				<dt>
					<h3 >Search Course</h3>
				</dt>
					<dd>Searches for courses based on the critera entered.</dd>
			</dl>
			<p style="text-align:center;"><img src="../common/images/fleron-byline.gif" style="margin-top:50px;" /></p>

			<form action="list_course/index.php" method="post">
				<dl class="field_title">
					<dt><h4>Basic Search</h4></dt>
					<dd>Specific details about courses.</dd>
				</dl>
				<div class="left_column">
					<p>
						<label for="course_name">Course Name</label>
						<br/>
						<input type="text" class="text" name="course_name"/>	
					</p>
					<p>
						<label for="course_code">Course Code</label>
						<br/>
						<input name="course_code" type="text" class="text" style="width:120px"/>
					</p>
					<p>
						<label for="subject">Subject</label>
						<br />
						<input name="subject" type="text" class="text" />
					</p>
										
				</div>
				<div class="right_column">
					<p>
						<label for="credit_range">Credit Range</label>
						<br />
						<input type="text" class="text"name="credit_range_min"  style="width: 50px;" />
						to 
						<input type="text" class="text" name="credit_range_max" style="width: 50px;margin-left:10px" />			
					</p>
					<p>
						<label for="faculty">Faculty</label></label> <br/>
						<select class="select" name="faculty">
							<option>ALL</option>
							<option>Pure and Applied Sciences</option>
							<option>Humanities</option>
							<option>Social Sciences</option>
						</select>
					</p>
					<p>
						<label>Days of The Week</label>
						<br>
						<input type="checkbox" checked = "checked" value="mon"/>Mon
						<input type="checkbox" checked = "checked" value="tue"/>Tue
						<input type="checkbox" checked = "checked" value="wen"/>Wen
						<input type="checkbox" checked = "checked" value="thur"/>Thur
						<input type="checkbox" checked = "checked" value="fri"/>Fri
						<input type="checkbox" checked = "checked" value="sat"/>Sat
					</p>
				</div>
				<p style="text-align:center;">
					<img src="../common/images/fleron-byline.gif" style="margin-top:50px;" />
				</p>
				<dl class="field_title">
					<dt><h4>Detailed Search</h4></dt>
					<dd>Generates search based of personal perference</dd>
				</dl>

					<h4 style="margin-left:80px">Personal</h4>
					
				<div id="personal_prefrence">
					<p>
						<label for="degree_name">Degree Name</label><br/>
						<input name="degree_name"type="text" class="text"/>
					</p>
					<p>
						<label for="simester">Simester</label>
						<label for="year_of_degree"style="margin-left:100px;">Year/Level of Degree</label>
						<br/> 
						<select name="simester" class="select" style="width:150px;">
							<option>ALL</option>
							<option>First Simester</option>
							<option>Second Simester</option>
							<option value="3">Summer</option>
						</select>
						<select name="year_of_degree"class="select">
							<option>ALL</option>
							<option>1st</option>
							<option>2nd</option>
							<option>3rd</option>
							<option>4th</option>
							<option>5th</option>
							<option>6th</option>
							<option>7th</option>
						</select>
					</p>
				</div>
				<h4 style="margin-left:80px">Other </h4>
				<div  id="other">
					<p>
						<label for="lecture_name">Lecturer's Name </label>
						<br/>
						<input name="lecture_name" type="text" class="text"/>
					</p>
					<p>
						<label for="time_range">Course Time </label>
						<br/>
						<input name="time_range_min" type="text" class="text" style="width:70px;margin-right:10px;"/> 
						to <input name="time_range_max" type="text" class="text" style="width:70px;margin-left:10px;" />
					</p>
					<p>
						<label for="max_class_duration">Max Class Duration</label> 
						<br/>
						<input name="max_class_duration" type="text" class="text" style="width:100px;">
					</p>
					<p>
						<label for="lecture_gender">Lecture's Gender </label>
						<br/>
						<input type="checkbox" name="gender" checked = "checked">Male
						<input type="checkbox" name="gender" checked = "checked">Female
					</p>
					<p>
						<label>Type of Course</label> 
						<br />
						<input type="checkbox" checked = "checked" value="theoretical"/>Theoretical
						<input type="checkbox" checked = "checked" value="practical"/>Practical
						<input type="checkbox" checked = "checked" value="technical"/> Technical
					</p>
					<p>
						<label for="schedule_type">Schedule Type </label>
						<br/>
						<select class="select" name="schedule_type">
							<option>ALL</option>
							<option>Lab</option>
							<option>Lecture</option>
							<option>Tutorial</option>
						</select>
					</p>
				</div>
				
				<input type="submit" value="submit" class="submit" /> 
			</form>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>
	

</body>
</html>