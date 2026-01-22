<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0D2940" />
    <title>Globalpundits Inc.</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/main-mobile.css">
    <link rel="stylesheet" type="text/css" href="css/sal.css">
    <link rel="stylesheet" href="css/bxSlider.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins:700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="js/sal.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="js/anime.min.js"></script>
    <script src="js/rellax.min.js"></script>

</head>
<body>
<?php
include("header.html");
?>
<!-- content starts here -->
<div id="section-1" class="container-fluid">
    <div data-sal="slide-up" data-sal-duration="500" class="container">
         <div id="first-section" class="row align-items-center justify-content-center">
            <div data-rellax-speed="3" id="illus-container" class="col-lg-7 rellax"
                data-friction-x="0.1"
                data-friction-y="0.1"
                data-scalar-x="10"
                data-scalar-y="10">              

                <svg data-depth="0.6" id="svg" viewBox="0 0 1600 320" xmlns="http://www.w3.org/2000/svg">
  <style type="text/css">
    .st0 {
      fill: none;
      stroke: #00467F;
      stroke-width: 3;
      stroke-miterlimit: 10;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 700;
      letter-spacing: 1.2px;
    }
  </style>

  <g fill="none" fill-rule="evenodd" stroke="#00467F" stroke-width="3" class="layer1">
    <text
      class="st0"
      x="800"
      y="115"
      text-anchor="middle"
      font-size="92"
    >
      The Specialized Talent You Need
    </text>
    <text
      class="st0"
      x="800"
      y="245"
      text-anchor="middle"
      font-size="92"
    >
      The Speed You Demand
    </text>
  </g>
</svg>
            </div>
            <div data-rellax-speed="5" id="info-container" class="col-lg-5 rellax">
                <div id="landing-info">
                    <p> We bridge the gap between complex projects and elite expertise. Globalpundits provides top-tier staff augmentation for <b>Nuclear engineering</b>, <b>Data Center management</b>, and <b>ERP implementation</b> across the US and UAE.
                       <br>
                    </p>
                    <input id="servicesScrollBtn" type="button" value="Our Services" class="solid-btn">
                </div>
            </div>
        </div>
    </div>
    <div id="pent-scene">
        <div data-depth="0.2" class="pent-container"><img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-1"></div>
        <div data-depth="0.4" class="pent-container"><img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-2"></div>
        <div data-depth="0.6" class="pent-container"><img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-3"></div>
    </div>
</div>

<div id="section-2" class="container-fluid">
    <div data-sal="slide-up" data-sal-duration="500" class="container">
        <div class="row justify-content-center align-items-center rounded">
            <div id="aboutimg-container" class="col-lg-4">
                <img id="about-img" src="images/about2.png" alt="About Us">
            </div>
            <div id="about-desc" class="col-lg-7">
                <h1>Who are we?</h1>
                <p>Founded in 2000, Globalpundits is uniquely qualified to partner with you for your ERP services and staffing needs. Globalpundits proven resources are comprised of an experienced base of solution experts with a proven methodology that enables us to support the most diverse solutions on a global basis.</p>
                <a href="about.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>
            </div>
        </div>
        <br><br>
    </div>
</div>

<div id="section-3" class="container-fluid">
    <div id="services-container" class="container">
         <h1 class="text-center acc-color h1-center">Our Services</h1>
        <br>
		<div class="row align-items-top services-area">
			<div class="col-lg" id="services-display">
			
				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/eps.png" alt=" Technical & Professional Staffing">
					</div>
					<div class="col-lg-8">
						<p>Finding specialized talent shouldn’t be a bottleneck for your growth. We connect you with vetted experts in AI, Nuclear Engineering, and IT who are ready
to hit the ground running. From short-term projects in the US to long-term digital initiatives in the UAE, we provide the reliable professionals you need to
get the job done right.</p>
						<!--<a href="erp.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
					</div>
				</div>
				
				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/ems.png" alt="Defense IT & Cybersecurity">
					</div>
					<div class="col-lg-8">
						<p>Security is non-negotiable, especially in defense. We provide IT specialists who understand the strict requirements of the US Department of Defense and
UAE national security projects. Our team helps you stay compliant with the latest regulations while ensuring your data and infrastructure remain protected
against modern threats.</p>
	<!--<a href="education.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
					</div>
				</div>
				
				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/staff.png" alt=" Nuclear & Energy Engineering">
					</div>
					<div class="col-lg-8">
						<p>The energy industry is changing, and we’re helping lead the way. We provide the engineering talent needed for traditional nuclear plants and the new wave
of Small Modular Reactors (SMRs). Whether you are managing an energy grid in the US or supporting the UAE’s clean energy goals, we offer the technical
expertise to power your project safely.</p>
						<!--<a href="staff.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
					</div>
				</div>
			
				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1" >
						<img src="images/ems.png" alt="Data Centers & AI Support">
					</div>
					<div class="col-lg-8">
						<p>Data centers and AI are the engines of the modern economy. We help you build and manage these criƟcal hubs by providing the right staff—from
infrastructure engineers to AI specialists. Our services support the booming tech landscape in the US and the UAE's vision to become a global leader in
Artificial Intelligence.</p>
						<!--<a href="taas.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
					</div>	
                </div>
                
                <div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1" >
						<img src="images/ems.png" alt="Higher Education & University Systems">
					</div>
					<div class="col-lg-8">
						<p>We help universities upgrade their technology to better serve students and staff. Our consultants specialize in ERP systems (like Oracle and Workday) that
manage everything from admissions to finances. We make sure higher education institutions in the US and UAE have the modern, easy-to-use tools they
need to thrive in a digital world.</p>
						<!--<a href="education.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
					</div>	
				</div>
				
			</div>
			
			<div class="col-lg-4" id="services-selector">
				<ul>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="" class="selected" onclick="changeService(0)">Technical &amp; Professional Staffing</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" onclick="changeService(1)">Defense IT &amp; Cybersecurity</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" onclick="changeService(2)">Nuclear &amp; Energy Engineering</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" onclick="changeService(3)">Data Centers &amp; AI Support </li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="400" onclick="changeService(4)">Higher Education &amp; University Systems</li>
				</ul>
			</div>
		</div>
		
		<!-- /New services block -->

        <span id="mobile-services-block">
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/eps.png" alt="Enterprise Professional Services">
            </div>
             <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/staff.png" alt="Technical &amp; Professional Staff Augmentation">
            </div>
            <div class="col-lg-8">
                <h2>Technical & Professional Staffing</h2>
                <p>"Finding specialized talent shouldn’t be a bottleneck for your growth. We connect you with vetted experts in AI, Nuclear Engineering, and IT who are ready
to hit the ground running. From short-term projects in the US to long-term digital initiatives in the UAE, we provide the reliable professionals you need to
get the job done right."
</p>
               <!-- <a href="staff.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
            </div>
        </div>
        <br>
            <div class="col-lg-8">
                <h2>Defense IT & Cybersecurity</h2>
                <p>"Security is non-negotiable, especially in defense. We provide IT specialists who understand the strict requirements of the US Department of Defense and
UAE national security projects. Our team helps you stay compliant with the latest regulations while ensuring your data and infrastructure remain protected
against modern threats."
</p>
               <!-- <a href="erp.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
            </div>
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
			<div class="col-lg-3 section-3-img-block mobile-block">
               <img src="images/ems.png" alt="Enterprise Managed Services">
            <div class="col-lg-8">
                <h2 class="align-right">Nuclear & Energy Engineering</h2>
                <p class="align-right">"The energy industry is changing, and we’re helping lead the way. We provide the engineering talent needed for traditional nuclear plants and the new wave
of Small Modular Reactors (SMRs). Whether you are managing an energy grid in the US or supporting the UAE’s clean energy goals, we offer the technical
expertise to power your project safely."</p>
                <!-- <a href="erp.php"><input class="outline-btn-orange align-right" type="button" value="Read more" /></a> -->
            </div>
            <div class="col-lg-3 section-3-img-block non-mobile-block">
                <img src="images/ems.png" alt="Enterprise Managed Services">
            </div>
        </div> 
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
			<div class="col-lg-3 section-3-img-block mobile-block">
                <img src="images/ems.png" alt="Testing As A Services">
            </div>
            <div class="col-lg-8">
                <h2 class="align-right">Data Centers & AI Support </h2>
                <p class="align-right">"Data centers and AI are the engines of the modern economy. We help you build and manage these critical hubs by providing the right staff—from
infrastructure engineers to AI specialists. Our services support the booming tech landscape in the US and the UAE's vision to become a global leader in
Artificial Intelligence."
</p>
               <!-- <a href="taas.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
            </div>
            <div class="col-lg-3 section-3-img-block non-mobile-block">
                <img src="images/ems.png" alt="Testing As A Services">
            </div>
        </div>
        <br>

        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/ems.png" alt="Technical &amp; Higher Education Services">
            </div>
            <div class="col-lg-8">
                <h2>Higher Education & University Systems</h2>
                <p>"We help universities upgrade their technology to better serve students and staff. Our consultants specialize in ERP systems (like Oracle and Workday) that
manage everything from admissions to finances. We make sure higher education institutions in the US and UAE have the modern, easy-to-use tools they
need to thrive in a digital world." </p>
                <!--<a href="taas.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>-->
            </div>
        </div>

        </span>
    </div>
</div>

<div id="section-4" class="container-fluid">
    <div id="clients-container" class="container">
        <br>
        <h1 class="text-center acc-color h1-center">Our Clients</h1>
        <br>

             <div class="row">
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-4 services-block">
                    <img class="services-images" src="images/public.png" alt="Higher Education">
                    <h3 class="h3-center">Defense & Government</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" class="col-lg-4 services-block">
                    <img class="services-images" src="images/util.png" alt="Financial Services">
                    <h3 class="h3-center">Nuclear & SMR Energy</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" class="col-lg-4 services-block">
                    <img class="services-images" src="images/aero.png" alt="Public Sector">
                    <h3 class="h3-center">Universities & Research</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
              
            </div>
             <br>
            <br>
             <div class="row">
                  <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="400" class="col-lg-4 services-block">
                    <img class="services-images" src="images/eng.png" alt="Engineering Services">
                    <h3 class="h3-center">Data Centers & Infrastructure</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-4 services-block">
                    <img class="services-images" src="images/manu.png" alt="Higher Education">
                    <h3 class="h3-center">Emerging Tech & AI</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" class="col-lg-4 services-block">
                    <img class="services-images" src="images/edu.png" alt="Financial Services">
                    <h3 class="h3-center">Critical Infrastructure</h3>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet dolorem ullam, ab quidem nobis facilis.</p> -->
                </div>
            </div>
    </div>
    <br><br>
</div>

<div id="section-5" class="container-fluid">
    <div class="container">
		
	</div>
</div>

<div id="section-6" class="container-fluid">
    <div class="container">
        <div class="row justify-content-around align-items-bottom">
            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-12">
                <center><h3>Our Values</h3></center>
                 <center><p>At Globalpundits, our values are the foundation of every partnership. As we expand our reach from the United States to the UAE and Saudi Arabia, we
remain committed to a standard of excellence that serves our clients, our employees, and our global community.</p> </center>
            </div>
            <div class="row justify-content-between about-values">
                            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-3">
                               
                                <h3>Uncompromising Integrity & Security</h3>
                                <p style="font-size:16px;">In mission-critical sectors like Defense IT and Nuclear Energy, trust is everything. We operate with total transparency, ensuring that every consultant and
solution meets the highest regulatory and safety standards, including CMMC and NIST compliance.
</p>
                            </div>
                            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-3">
                               
                                <h3> Innovation with Purpose</h3>
                                <p style="font-size:16px;">We don't just provide staff; we provide progress. Whether it is implementing AI-driven solutions or supporting the next generation of Small Modular
Reactors (SMRs), we embrace cutting-edge technology to solve the world’s most complex challenges.
</p>
                            </div>
                            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-3">
                              
                                <h3>Global Excellence, Local Expertise</h3>
                                <p style="font-size:16px;">We bridge the gap between North American technical rigor and the visionary growth of the Middle East. Our value lies in our ability to deliver worldclass ERP and IT expertise while respecting and supporting the local goals of the regions where we operate.</p>
                            </div>
                            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-3">
                                <h3>Commitment to People</h3>
                                <p style="font-size:16px;">Our greatest asset is our talent. We foster a culture of continuous learning and professional growth, ensuring our experts are always equipped to lead Digital
Transformations in higher education and beyond.</p>
                            </div>
                    
                        </div>

        </div>
    </div>
</div>
<div id="section-6" class="container-fluid" >
    <div class="container" style="background-color:white;">
        <div class="row justify-content-center align-items-bottom">
           
            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" id="testimonials-container" class="col-lg-12">
              <center>  <h3>What our clients say about us</h3> </center>
                <br>
               <center> <div class="slider">
                    <div class="test-slides" style="color:black;">“ I find that GlobalPundits representatives were friendly, and thorough in their approach with a genuine desire to help us find the right solution "</div>
                    <div class="test-slides" style="color:black;">“ Your candidate is a slam dunk, highly motivated and possessing all the skills we need in Project Management, Engineering and Energy Management, could fit in any of the three groups ”</div>
                    <div class="test-slides" style="color:black;">“ GlobalPundits is one our top suppliers, both in terms of headcount and in terms of responsiveness. They provide quality candidates for our openings and really listen to our needs and the needs of their contractors ”</div>
                    <div class="test-slides" style="color:black;">“ GlobalPundits found the right candidate with the right skill set very quickly. Thanks for the great match! ”</div>
                    <div class="test-slides" style="color:black;">“ Through the guidance and leadership of Globalpundits, I was placed at a company that values the opinions of their employees and allows me the opportunity to gain experience in areas that will further enhance my long term career goals! ”</div>
                </div></center>
            </div>
        </div>
    </div>
</div>

<!-- content ends here -->

<?php
include("footer.html");
?>
 <a href="referral.php" class="float"> 
        <!-- <img src="https://www.globalpundits.com/images/Integrity.png" style="width: 50px; height: auto"> -->
        <i class="material-icons">military_tech</i>
        <!-- <i class="material-icons">card_giftcard</i> -->
        Get Rewarded  </a>
</body>
<script src="js/header.js"></script>
<script src="js/index.js"></script>
</html>