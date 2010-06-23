<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Mentoring Program</title>
    
	<style type="text/css">
	<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333;
	background-color: #739112;
	margin: 0;
	padding: 0;
}
p {
	max-width: 600px;
}
#container {
	background-color: #FFF;
	background-image: url(images/column_background.jpg);
	background-repeat: repeat-y;
	background-position: right;
	width: 90%;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
}
#sidebar {
	float: right;
	width: 195px;
	margin-right: 10px;
}
#content {
	margin-top: 0px;
	margin-right: 240px;
	margin-left: 25px;
}
#content h1 {
	margin: 0px;
	padding-top: 10px;
}
#footer {
	clear: both;
}
#sidebar p {
}
#header {
	background-color: #9FCC41;
	background-image: url(images/mentoring.jpg);
	background-position: right;
	background-repeat: no-repeat;
}
#sidebar div dl dt {
	text-transform: uppercase;
	color: #000;
	margin-top: 15px;
}
#sidebar div dl dd {
	margin-top: 3px;
	margin-bottom: 3px;
	margin-right: 0px;
	margin-left: 20px;
}
#header img {
	margin: 0px;
	padding: 2em;
}
.headline {	color: #88B036;
	font-weight: bold;
	font-size: 18px;
	margin-bottom: -2px;
}
#menu {
	background-color: #1A6116;
	color: #FFF;
	height: 30px;
	width: 100%;
}
#header h1 {
	font-size: xx-large;
	font-style: normal;
	font-family: "Comic Sans MS", cursive;
}
#content #TabbedPanels1 .TabbedPanelsContentGroup .TabbedPanelsContent.TabbedPanelsContentVisible img  {
	float: left;
	margin-right: 10px;
	margin-bottom: 10px;
	margin-top: 0px;
	margin-left: 0px;
}

	-->
	</style>
    <script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
    <script src="SpryAssets/xpath.js" type="text/javascript"></script>
    <script src="SpryAssets/SpryData.js" type="text/javascript"></script>
    <link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
    <link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
<!--
var events = new Spry.Data.XMLDataSet("data/events.xml", "calendar/event");
//-->
    </script>
</head>
	<body>
	<div id="container">
      <div id="header">
        <img src="images/mentoring_logo.png" width="240" height="41" alt="mentoring program" />
      </div>
      <div id="menu">
        <ul id="MenuBar1" class="MenuBarHorizontal">
          <li><a href="#">About Us</a>          </li>
          <li><a href="#" class="MenuBarItemSubmenu">Join Us</a>
            <ul>
              <li><a href="#">Mentor</a></li>
              <li><a href="#">Mentee</a></li>
            </ul>
          </li>
          <li><a href="#">Album</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">LogOn</a></li>
        </ul>
      </div>
      <div id="sidebar">

<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 1</div>
    <div class="AccordionPanelContent">
      <ul>
      	<li>link1</li>
        <li>link2</li>
        <li>link3</li>
        <li>link4</li>
        <li>link5</li>
      </ul>
    </div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 2</div>
    <div class="AccordionPanelContent">Content 2</div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 3</div>
    <div class="AccordionPanelContent">Content 3</div>
  </div>
  <div class="AccordionPanel">
    <div class="AccordionPanelTab">Label 4</div>
    <div class="AccordionPanelContent">Content 4</div>
  </div>
</div>
<p>&nbsp;</p>
        
        <div spry:region="events">
        <p><span class="headline">Events
        </span>&nbsp;</p>
          <dl spry:repeatchildren="events">
            <dt>{date}:{time}</dt>
            <dd><strong>{title}</strong></dd>
            <dd>{caption}</dd>
          </dl>
        </div>
      </div>
      <div id="content">
        <h1 >Welcome to Mentoring Program </h1>
        <div id="TabbedPanels1" class="TabbedPanels">
          <ul class="TabbedPanelsTabGroup">
            <li class="TabbedPanelsTab" tabindex="0">About Us</li>
            <li class="TabbedPanelsTab" tabindex="0">Students Say</li>
            <li class="TabbedPanelsTab" tabindex="0">About Being Matched</li>
            <li class="TabbedPanelsTab" tabindex="0">What's Next...</li>
            <li class="TabbedPanelsTab" tabindex="0">Ideas?</li>
          </ul>
          <div class="TabbedPanelsContentGroup">
            <div class="TabbedPanelsContent">
              <p><img src="images/littlementor.jpg" width="33" height="130" alt="little mentor" />The <span style="color:#009"><strong>Student Mentoring Program</strong></span> is all about students helping students.</p>
              <p>It connects a student commencing their first semester of undergraduate study with another student who is further along in the same course. This helps the new student, studying either on-campus or at distance, to quickly and successfully settle into university life and there is no charge involved.</p>
              <p>New students benefit from the experience of their mentor, who help the new student adjust and guide them to appropriate support services available at Southern Cross University.</p>
              <p>The program is available for all new undergraduate students, studying by distance or on-campus at Lismore, Coffs Harbour or Tweed Gold Coast.</p>
            </div>
            <div class="TabbedPanelsContent">
              <p><img src="images/whatMentorSay.png" width="596" height="107" alt="whatMentorSay" />Listen to what a previous Student Mentor says about the program.</p>
              <p>more text mentor say</p>
<p>more text mentee say</p>
              <p>more pages</p>
            </div>
            <div class="TabbedPanelsContent">
              <p><img src="images/mentor.jpg" width="209" height="204" alt="mentor" />We aim to  match you with someone studying the same course and, preferably, of a  similar age range. Where possible, similarities in your work situation,  family circumstances, hobbies and interests will also be considered.              </p>
              <p>We  do our best to match people. But if you find that, for whatever  reason, the relationship is not working out, please don’t hesitate to  contact your coordinator. We’ll try to make another match as soon as  possible.</p>
            </div>
            <div class="TabbedPanelsContent">Content 4</div>
            <div class="TabbedPanelsContent">
              <p>If you have any suggestions for this site, we would love to hear from you. Please <a href="mailto:mentor@scu.edu.au?subject=Student%20e-Mentor%20Blackboard%20site%20suggestion%20or%20feedback"><em>contact us</em></a>.</p>
            </div>
          </div>
        </div>
        <p >&nbsp;</p>
       
  <h2>&nbsp;</h2>
              <p>&nbsp;</p>
      </div>
           
              <h2>&nbsp;</h2>
<p>&nbsp;</p>
        <h2>&nbsp;</h2>
<h2>&nbsp;</h2>
        <h2>&nbsp;</h2>
        <h2>&nbsp;</h2>
<p>&nbsp;</p>
    </div>
    <div id="footer"><em>&copy;2010.footer goes here</em>
    <?php
    	print date('g:i a l F j');
    ?></div>
	</div>
    <script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
    </script>
</body>
</html>
