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

<style type="text/css">
    .st0 {
    fill: none;
    stroke: #00467F;
    stroke-width: 5;
    stroke-miterlimit: 10;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 700;
    letter-spacing: 1.2px;
    }
</style>

<?php
    include "header.html";
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

        <svg data-depth="0.6" id="svg" viewBox="0 0 1600 520" xmlns="http://www.w3.org/2000/svg">
           <g fill="none" fill-rule="evenodd" stroke="#00467F" stroke-width="3" class="layer1">

                <text class="st0" x="1580" y="115" text-anchor="end" font-size="125">
                    The Specialized Talent
                </text>

                <text class="st0" x="1580" y="245" text-anchor="end" font-size="125">
                    You Need
                </text>

                <text class="st0" x="1580" y="375" text-anchor="end" font-size="125">
                    The Quality You Demand
                </text>
            </g>
        </svg>

            </div>
            <div data-rellax-speed="5" id="info-container" class="col-lg-5 rellax">
                <div id="landing-info">
                    <!--<h1>Who are we?</h1>-->
                    <p style="text-align: justify; font-size: 14px;">Globalpundits is a U.S. based engineering and technical consulting firm, located in Aiken, South Carolina, supporting nuclear and mission-critical programs through high-assurance staffing and compliance-aligned program support. Founded in 2000, we operate in environments where regulatory discipline, technical rigor, and execution integrity are fundamental.
                       <br>
                    </p>
                  <a href="about.php"> <input id="servicesScrollBtn" type="button" value="Read More" class="solid-btn"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="pent-scene">
        <div data-depth="0.2" class="pent-container">
<img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-1"></div>
        <div data-depth="0.4" class="pent-container"><img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-2"></div>
        <div data-depth="0.6" class="pent-container"><img src="images/pentagon.png" alt="" class="pentagon" id="pentagon-3"></div>
    </div>
</div>

<div id="section-2" class="container-fluid">
    <div data-sal="slide-up" data-sal-duration="500" class="container">
        <div class="row justify-content-center align-items-center rounded">
            <!-- <h1>Our Services</h1> -->
            <!-- <div id="servicesScrollBtn" class="col-lg-12">

            </div> -->
            <!-- <div id="aboutimg-container" class="col-lg-4">
                <img id="about-img" src="images/about2.png" alt="About Us">
            </div>
            <div id="about-desc" class="col-lg-7">
                <h1>Who are we?</h1>
                <p>Founded in 2000, Globalpundits is uniquely qualified to partner with you for your ERP services and staffing needs. Globalpundits proven resources are comprised of an experienced base of solution experts with a proven methodology that enables us to support the most diverse solutions on a global basis.</p>
                <a href="about.php"><input class="outline-btn-orange" type="button" value="Read more" /></a>
            </div> -->
        </div>
        <br><br>
    </div>
</div>

<div id="section-3" class="container-fluid">
    <div id="services-container" class="container">
         <h1 class="text-center acc-color h1-center">Industries</h1>
        <br>
		<div class="row align-items-top services-area">
			<div class="col-lg" id="services-display">

				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/Nuclear.jpeg" alt=" Technical & Professional Staffing">
					</div>
					<div class="col-lg-9">
						<p style="text-align: left; font-size: 14px;">Globalpundits supports nuclear and regulated energy programs by supplying experienced engineering and technical professionals who operate effectively within highly controlled, compliance-driven environments. Our teams have supported U.S. Department of Energy (DOE)–regulated programs and DOE/NRC-aligned nuclear initiatives, contributing to engineering, licensing, quality assurance, and program execution activities where safety, documentation, and regulatory discipline are paramount.</p>
                        <p style="text-align: left;font-size: 14px;">As a DOD Joint Certification Program (JCP)–certified organization, Globalpundits brings a security-aware delivery model that aligns with the access controls, export considerations, and quality frameworks commonly required in nuclear and advanced energy programs. Our professionals embed within client and prime contractor teams to support long-term program objectives without disrupting established governance structures.</p>
					</div>
				</div>

				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/ai.jpeg" alt="Defense IT & Cybersecurity">
					</div>
					<div class="col-lg-9">
						<p style="text-align: left;font-size: 14px;">Globalpundits supports AI data center and digital infrastructure programs by providing engineering and IT talent experienced in large-scale, mission-critical environments where power reliability, system integration, and operational continuity are essential. Our support spans energy-adjacent engineering, infrastructure systems, and enterprise IT roles that underpin high-density computing and AI-enabled platforms.</b>
                        </p>
                        <p style="text-align: left;font-size: 14px;">Drawing on experience from DOE- and DOD-regulated environments, Globalpundits applies disciplined delivery practices well suited to infrastructure programs that demand rigorous change control, documentation, and operational reliability. Our DOD JCP certification further reinforces our ability to support programs involving sensitive technical data and controlled information within complex, multi-stakeholder ecosystems.</p>
					</div>
				</div>

				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/defense.jpeg" alt=" Nuclear & Energy Engineering">
					</div>
					<div class="col-lg-9">
						<p style="text-align: left;font-size: 14px;">Globalpundits provides technical staffing and consulting support for defense, government, and secure IT systems operating under DOD-aligned and federally regulated frameworks. Our professionals support enterprise IT platforms, digital modernization initiatives, and mission systems that require structured processes, compliance awareness, and secure operational practices.</p>
                        <p style="text-align: left;font-size: 14px;">With active DOD Joint Certification Program (JCP) status and prior experience supporting DOE and defense-adjacent programs, Globalpundits is well-positioned to deliver talent that understands the expectations of regulated government environments. We emphasize embedded support models that integrate seamlessly into client teams while maintaining alignment with security, documentation, and audit requirements.</p>
					</div>
				</div>

				<div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1" >
						<img src="images/higher education.jpeg" alt="Data Centers & AI Support">
					</div>
					<div class="col-lg-9">
						<p style="text-align: left;font-size: 14px;">Globalpundits provides specialized ERP and enterprise systems consulting for higher education institutions, including state universities, technical colleges, and Ivy League schools. We support the implementation, upgrades, optimization, and sustainment of platforms such as Oracle ERP, Workday, and Banner, supplying experienced professionals who integrate directly within campus IT and administrative teams. From core financials and HR systems to large-scale modernization initiatives, Globalpundits delivers disciplined, systems-focused talent to ensure operational continuity, data integrity, and long-term platform stability.</p></div>
                </div>

                <div class="row justify-content-center align-items-top services-blocks">
					<div class="col-lg-3 section-3-img-block1" >
						<img src="images/staffing.jpeg" alt="Higher Education & University Systems">
					</div>
					<div class="col-lg-9">
						<p style="text-align: left;font-size: 14px;">Globalpundits delivers technical and professional staffing through flexible, program-aligned engagement models designed for regulated and mission-critical environments. Our approach emphasizes embedded support, where professionals integrate directly into client and prime contractor teams to provide continuity, domain expertise, and long-term value.</p>
                        <p style="text-align: left;font-size: 14px;">With experience supporting DOE and DOD programs and active DOD JCP certification, Globalpundits applies a security-conscious, compliance-ready staffing model. Our professionals are accustomed to operating within controlled access environments, adhering to quality systems, and supporting audits and regulatory reviews as part of day-to-day program execution.</p>
                    </div>
				</div>

			</div>

			<div class="col-lg-4" id="services-selector">
				<ul>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="" class="selected" onclick="changeService(0)">Nuclear & Regulated Energy</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" onclick="changeService(1)">AI Data Centers & Digital Infrastructure</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" onclick="changeService(2)">Defense, Government & Secure IT Systems</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" onclick="changeService(3)">Higher Education & University Systems</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="400" onclick="changeService(4)">Technical & Professional Staffing Models</li>
				</ul>
			</div>
		</div>

		<!-- /New services block -->

        <span id="mobile-services-block">
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/Nuclear.jpeg" alt="Technical & Professional Staffing">
            </div>
            <div class="col-lg-8">
                <h2>Nuclear & Regulated Energy</h2>
               <p style="text-align: left; font-size: 14px;">Globalpundits supports nuclear and regulated energy programs by supplying experienced engineering and technical professionals who operate effectively within highly controlled, compliance-driven environments. Our teams have supported U.S. Department of Energy (DOE)–regulated programs and DOE/NRC-aligned nuclear initiatives, contributing to engineering, licensing, quality assurance, and program execution activities where safety, documentation, and regulatory discipline are paramount.</p>
                        <p style="text-align: left;font-size: 14px;">As a DOD Joint Certification Program (JCP)–certified organization, Globalpundits brings a security-aware delivery model that aligns with the access controls, export considerations, and quality frameworks commonly required in nuclear and advanced energy programs. Our professionals embed within client and prime contractor teams to support long-term program objectives without disrupting established governance structures.</p>
					</div>
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
			<div class="col-lg-3 section-3-img-block mobile-block">
                <img src="images/ai.jpeg" alt="Defense IT & Cybersecurity">
            </div>
            <div class="col-lg-8">
                
         
                 <h2>AI Data Centers & Digital Infrastructure</h2>
                 <p style="text-align: left;font-size: 14px;">Globalpundits supports AI data center and digital infrastructure programs by providing engineering and IT talent experienced in large-scale, mission-critical environments where power reliability, system integration, and operational continuity are essential. Our support spans energy-adjacent engineering, infrastructure systems, and enterprise IT roles that underpin high-density computing and AI-enabled platforms.</b>
                        </p>
                        <p style="text-align: left;font-size: 14px;">Drawing on experience from DOE- and DOD-regulated environments, Globalpundits applies disciplined delivery practices well suited to infrastructure programs that demand rigorous change control, documentation, and operational reliability. Our DOD JCP certification further reinforces our ability to support programs involving sensitive technical data and controlled information within complex, multi-stakeholder ecosystems.</p>
            </div>
          
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/defense.jpeg" alt="Defense IT & Cybersecurity">
            </div>
            <div class="col-lg-8">
                <h2>Defense, Government & Secure IT Systems</h2>
              <p style="text-align: left;font-size: 14px;">Globalpundits provides technical staffing and consulting support for defense, government, and secure IT systems operating under DOD-aligned and federally regulated frameworks. Our professionals support enterprise IT platforms, digital modernization initiatives, and mission systems that require structured processes, compliance awareness, and secure operational practices.</p>
                        <p style="text-align: left;font-size: 14px;">With active DOD Joint Certification Program (JCP) status and prior experience supporting DOE and defense-adjacent programs, Globalpundits is well-positioned to deliver talent that understands the expectations of regulated government environments. We emphasize embedded support models that integrate seamlessly into client teams while maintaining alignment with security, documentation, and audit requirements.</p>
					</div>
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
			<div class="col-lg-3 section-3-img-block mobile-block">
                <img src="images/higher education.jpeg" alt="Nuclear & Energy Engineering">
            </div>
            <div class="col-lg-8">
                <h2>Higher Education & University Systems</h2>
               <p style="text-align: left;font-size: 14px;">Globalpundits provides specialized ERP and enterprise systems consulting for higher education institutions, including state universities, technical colleges, and Ivy League schools. We support the implementation, upgrades, optimization, and sustainment of platforms such as Oracle ERP, Workday, and Banner, supplying experienced professionals who integrate directly within campus IT and administrative teams. From core financials and HR systems to large-scale modernization initiatives, Globalpundits delivers disciplined, systems-focused talent to ensure operational continuity, data integrity, and long-term platform stability.</p></div>
        <br>

        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
            <div class="col-lg-3 section-3-img-block">
                <img src="images/staffing.jpeg" alt="Higher Education & University Systems">
            </div>
            <div class="col-lg-8">
                <h2>Technical & Professional Staffing Models</h2>
              <p style="text-align: left;font-size: 14px;">Globalpundits delivers technical and professional staffing through flexible, program-aligned engagement models designed for regulated and mission-critical environments. Our approach emphasizes embedded support, where professionals integrate directly into client and prime contractor teams to provide continuity, domain expertise, and long-term value.</p>
                        <p style="text-align: left;font-size: 14px;">With experience supporting DOE and DOD programs and active DOD JCP certification, Globalpundits applies a security-conscious, compliance-ready staffing model. Our professionals are accustomed to operating within controlled access environments, adhering to quality systems, and supporting audits and regulatory reviews as part of day-to-day program execution.</p>
                     </div>
        </div>
        

        </span>
    </div>
</div>
<!--<div id="section-capabilities" class="container-fluid">
    <div id="capabilities-container" class="container">
         <h1 class="text-center acc-color h1-center">Capabilities</h1>
        <br>
		<div class="row align-items-top capabilities-area">
			<div class="col-lg" id="capabilities-display">

				<div class="row justify-content-center align-items-top capabilities-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/eps.png" alt=" Technical & Professional Staffing">
					</div>
					<div class="col-lg-9">
						<p style="text-align: justify; font-size: 14px;">Globalpundits supplies engineering and technical talent across nuclear, energy, infrastructure, and advanced engineering disciplines. Our professionals support design, analysis, licensing, quality assurance, and program execution functions where technical accuracy and regulatory alignment are essential.</p>
                        <p style="text-align: justify;font-size: 14px;">Our engineering support is informed by experience within DOE-regulated and defense-adjacent programs, enabling us to deliver talent that understands the expectations of safety-focused, documentation-intensive environments. This discipline allows our teams to contribute effectively without introducing compliance or process risk.</p>
					</div>
				</div>

				<div class="row justify-content-center align-items-top capabilities-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/ems.png" alt="Defense IT & Cybersecurity">
					</div>
					<div class="col-lg-9">
						 <p style="text-align: justify;font-size: 14px;">Globalpundits provides IT and digital systems expertise for organizations operating within regulated and security-conscious environments. Our support includes enterprise systems, digital platforms, and infrastructure-aligned IT roles that require structured delivery and controlled system access.</b>
                        </p>
                        <p style="text-align: justify;font-size: 14px;">Through prior work supporting DOE and DOD programs and holding DOD JCP certification, Globalpundits brings an understanding of secure IT operations and compliance-aligned delivery. Our professionals are experienced in working within governance frameworks that emphasize system integrity, traceability, and operational reliability.</p>
            </div>
				</div>

				<div class="row justify-content-center align-items-top capabilities-blocks">
					<div class="col-lg-3 section-3-img-block1">
						<img src="images/staff.png" alt=" Nuclear & Energy Engineering">
					</div>
					<div class="col-lg-9">
						<p style="text-align: justify;font-size: 14px;">Quality and compliance are embedded into Globalpundits’ delivery approach across all programs we support. We provide professionals experienced in quality assurance, independent verification and validation (IV&V), and compliance-driven program environments where adherence to standards is non-negotiable.</p>
                        <p style="text-align: justify;font-size: 14px;">Our background supporting DOE-regulated programs and operating as a DOD JCP-certified organization reinforces our alignment with structured quality systems and audit expectations. This capability enables Globalpundits to support clients and prime contractors in maintaining program integrity, regulatory confidence, and long-term operational success.</p>
                     </div>
				</div>

			</div>

			<div class="col-lg-4" id="capabilities-selector">
				<ul>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="" class="selected" onclick="changeCapabilities(0)">Engineering & Technical Disciplines</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" onclick="changeCapabilities(1)">IT, Digital & Secure Systems Expertise</li>
					<li data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" onclick="changeCapabilities(2)">Quality, Compliance & Assurance</li>
				</ul>
			</div>
		</div>-->

		<!-- /New services block -->

        <span id="mobile-services-block">
              <div id="services-container" class="container">
         <h1 class="text-center acc-color h1-center">Capabilities</h1>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
          
            <div class="col-lg-8">
                <h2>Engineering & Technical Disciplines</h2>
               <p style="text-align: left; font-size: 14px;">Globalpundits supplies engineering and technical talent across nuclear, energy, infrastructure, and advanced engineering disciplines. Our professionals support design, analysis, licensing, quality assurance, and program execution functions where technical accuracy and regulatory alignment are essential.</p>
                        <p style="text-align: left;font-size: 14px;">Our engineering support is informed by experience within DOE-regulated and defense-adjacent programs, enabling us to deliver talent that understands the expectations of safety-focused, documentation-intensive environments. This discipline allows our teams to contribute effectively without introducing compliance or process risk.</p>
					</div>
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
			
            <div class="col-lg-8">
                 <h2>IT, Digital & Secure Systems Expertise</h2>
                 <p style="text-align: left;font-size: 14px;">Globalpundits provides IT and digital systems expertise for organizations operating within regulated and security-conscious environments. Our support includes enterprise systems, digital platforms, and infrastructure-aligned IT roles that require structured delivery and controlled system access.</b>
                        </p>
                        <p style="text-align: left;font-size: 14px;">Through prior work supporting DOE and DOD programs and holding DOD JCP certification, Globalpundits brings an understanding of secure IT operations and compliance-aligned delivery. Our professionals are experienced in working within governance frameworks that emphasize system integrity, traceability, and operational reliability.</p>
            </div>
            
        </div>
        <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
           
            <div class="col-lg-8">
                <h2>Quality, Compliance & Assurance</h2>
              <p style="text-align: left;font-size: 14px;">Quality and compliance are embedded into Globalpundits’ delivery approach across all programs we support. We provide professionals experienced in quality assurance, independent verification and validation (IV&V), and compliance-driven program environments where adherence to standards is non-negotiable.</p>
                        <p style="text-align: left;font-size: 14px;">Our background supporting DOE-regulated programs and operating as a DOD JCP-certified organization reinforces our alignment with structured quality systems and audit expectations. This capability enables Globalpundits to support clients and prime contractors in maintaining program integrity, regulatory confidence, and long-term operational success.</p>
                     </div>
        </div>
             <br>
        <div data-sal="slide-up" data-sal-duration="500" class="row justify-content-center align-items-center">
           
            <div class="col-lg-8">
                <h2>NAIC CODES</h2>
                <ul>
                    <li>541330 – Engineering Services</li>
                    <li>541611 – Administrative & General Management Consulting Services</li>
                    <li>541512 – Computer Systems Design Services </li>
                    <li>541511 – Custom Computer Programming Services</li>
                    <li>541513 – Computer Facilities Management Services</li>
                    <li>541612 – Human Resources Consulting Services</li>
                    <li>541614 – Process, Physical Distribution, and Logistics Consulting Services</li>
                    <li>561320 – Temporary Help Services</li>
                    <li>541990 – All Other Professional, Scientific, and Technical Services</li>

                </ul>
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
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" class="col-lg-4 services-block">
                    <img class="services-images" src="images/util.png" alt="Financial Services">
                    <h3 class="h3-center">Nuclear & SMR Energy</h3>
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" class="col-lg-4 services-block">
                    <img class="services-images" src="images/aero.png" alt="Public Sector">
                    <h3 class="h3-center">Universities & Research</h3>
                </div>

            </div>
        <br>
        <br>
            <div class="row">
                  <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="400" class="col-lg-4 services-block">
                    <img class="services-images" src="images/eng.png" alt="Engineering Services">
                    <h3 class="h3-center">Data Centers & Infrastructure</h3>
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-4 services-block">
                    <img class="services-images" src="images/manu.png" alt="Higher Education">
                    <h3 class="h3-center">Emerging Tech & AI</h3>
                </div>
                <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="200" class="col-lg-4 services-block">
                    <img class="services-images" src="images/edu.png" alt="Financial Services">
                    <h3 class="h3-center">Critical Infrastructure</h3>
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
                <h3>Our Values</h3>
                <p style="font-size:16px;">At Globalpundits, our values are the foundation of every partnership. We uphold a standard of excellence that guides how we serve our clients, support our people, and engage with communities worldwide.</p>
            </div>
        </div>
        <div class="row justify-content-around align-items-bottom">
            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-3">
                 <h3>Uncompromising Integrity & Security</h3>
                 <p style="font-size:16px;">
                    In mission-critical sectors like Defense IT and Nuclear Energy, trust is everything. We operate with total transparency, ensuring that every consultant and
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

        <div class="row justify-content-around align-items-bottom">
            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="300" id="testimonials-container" class="col-lg-12">
                <h3>What our clients say about us</h3>
                <br>
                <div class="slider">
                    <div class="test-slides">“ I find that Globalpundits representatives were friendly, and thorough in their approach with a genuine desire to help us find the right solution </div>
                    <div class="test-slides">“ Your candidate is a slam dunk, highly motivated and possessing all the skills we need in Project Management, Engineering and Energy Management, could fit in any of the three groups ”</div>
                    <div class="test-slides">“ Globalpundits is one our top suppliers, both in terms of headcount and in terms of responsiveness. They provide quality candidates for our openings and really listen to our needs and the needs of their contractors ”</div>
                    <div class="test-slides">“ Globalpundits found the right candidate with the right skill set very quickly. Thanks for the great match! ”</div>
                    <div class="test-slides">“ Through the guidance and leadership of Globalpundits, I was placed at a company that values the opinions of their employees and allows me the opportunity to gain experience in areas that will further enhance my long term career goals! ”</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content ends here -->

<?php
    include "footer.html";
?>
 <!-- <a href="referral.php" class="float">     
        <i class="material-icons">military_tech</i>       
        Get Rewarded  </a> -->
</body>
<script src="js/header.js"></script>
<script src="js/index.js"></script>
</html>
