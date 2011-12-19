<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
     Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en" />
    <link rel="alternate" type="application/rss+xml" href="/feed/" title="RSS" />
    <title>[SCSS]Summer Camp Scheduling System</title>
    <meta name="description" content="summer camp scheduling system">
    <meta name="author" content="vendetta solutions">
<!--  Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
<!-- CSS : implied media="all" -->
    <?php use_stylesheet('reset.css') ?>
<!-- CSS : custom styles -->
    <?php echo stylesheet_assets() ?>
    <script src="/js/libs/modernizr-1.6.min.js"></script>
</head>
<body>
  <div id="header">
    <div class="container">
      <ul id="top-links">
        <?php if($sf_user->isAuthenticated(true)): ?>
        <li>
          <?php include_component('troopEnrollment','renderActiveTroopList',array('request'=>$sf_request)) ?>                  
        </li>
        <?php endif; ?>
        <li><?php echo link_to('Help','/help/dashboard') ?></li>
        <li><?php echo link_to('Settings','/settings/account') ?></li>
        <li><?php  echo ($sf_user->isAuthenticated(true))?link_to('Log Out','@sf_guard_signout') : link_to('Sign Up','@sf_guard_signup') ?></li>
      </ul>
      <div id="logo">
        <?php echo link_to('summercamp<span>schedulingsystem</span>',($sf_user->isAuthenticated()?'@dashboard':'@homepage'))?><sup>BETA</sup>
      </div>
      <?php $menu = load_menu('menu.php'); $menu->render(); ?>
    </div>
  </div>
  <div id="main-content" class="container">
    <?php echo $sf_content ?><br /> <br /> <br /><br /><br /><br />
  </div>
  <div id="footer">
    <div class="copyright">&copy; 2010, 2011 SCSS; all rights reserved</div>
    <div class="footer-links">
      <span class="about-tab">About SCSS</span>&nbsp;|&nbsp;
      <span class="privacy-tab">Privacy Policy</span>&nbsp;|&nbsp;
      <span class="donate-tab">Donate</span>
    </div>
  </div>
  <div id="donate-window" class="window">
    <span class="window-close"></span>
    <div>
      <form>
        <table>
          <thead>
            <tr>
              <th>Donate To Scss</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <label for="name">Name</label>
                <input type="text" name="name" class="donate-form-input text-input" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="name">Email</label>
                <input type="text" name="email" class="donate-form-input text-input" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="name">Amount</label>
                <input type="text" name="amount" class="donate-form-input text-input" />
              </td>
            </tr>
            <tr>
              <td>
                <button type="submit" class="btn-main btn">Donate</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <div id="privacy-window" class="window">
    <span class="window-close"></span>
    <div>
      <table >
        <thead>
          <tr>
            <th>Privacy Policy</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
<!-- START PRIVACY POLICY CODE -->
              <div style="font-family:verdana">
                <strong>What information do we collect?</strong> 
                <br /><br />
                We collect information from you when you register on our site or subscribe to our newsletter.  
                <br /><br />
                When ordering or registering on our site, as appropriate, you may be asked to enter your: name, e-mail address, mailing address, phone number or david.durost@gmail.com. You may, however, visit our site anonymously.
                <br /><br />
                Google, as a third party vendor, uses cookies to serve ads on your site.
Google's use of the DART cookie enables it to serve ads to your users based on their visit to your sites and other sites on the Internet.
Users may opt out of the use of the DART cookie by visiting the Google ad and content network privacy policy..
                <br /><br />
                <strong>What do we use your information for?</strong> 
                <br /><br />
                Any of the information we collect from you may be used in one of the following ways: 
                <br /><br />;
                To personalize your experience<br />(your information helps us to better respond to your individual needs)
                <br /><br />;
                To improve our website<br />(we continually strive to improve our website offerings based on the information and feedback we receive from you)
                <br /><br />;
                To improve customer service<br />(your information helps us to more effectively respond to your customer service requests and support needs)
                <br /><br />; 
                To process transactions<br />
                <blockquote>Your information, whether public or private, will not be sold, exchanged, transferred, or given to any other company for any reason whatsoever, without your consent, other than for the express purpose of delivering the purchased product or service requested.</blockquote>
                <br />; 
                To send periodic emails
                <br /><br />
                The email address you provide may be used to send you information, respond to inquiries, and/or other requests or questions.
                <br /><br />
                <strong>How do we protect your information?</strong> 
                <br /><br />
                We implement a variety of security measures to maintain the safety of your personal information when you enter, submit, or access your personal information. 
                <br /> <br />
                We offer the use of a secure server. All supplied sensitive/credit information is transmitted via Secure Socket Layer (SSL) technology and then encrypted into our Database to be only accessed by those authorized with special access rights to our systems, and are required to?keep the information confidential. 
                <br /><br />
                After a transaction, your private information (credit cards, social security numbers, financials, etc.) will not be stored on our servers.
                <br /><br />
                <strong>Do we use cookies?</strong> 
                <br /><br />
                Yes (Cookies are small files that a site or its service provider transfers to your computers hard drive through your Web browser (if you allow) that enables the sites or service providers systems to recognize your browser and capture and remember certain information
                <br /><br /> 
                We use cookies to help us remember and process the items in your shopping cart and understand and save your preferences for future visits.
                <br /><br />
                <strong>Do we disclose any information to outside parties?</strong> 
                <br /><br />
                We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential. We may also release your information when we believe release is appropriate to comply with the law, enforce our site policies, or protect ours or others rights, property, or safety. However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses.<br /><br /><strong>Third party links</strong> <br /><br /> Occasionally, at our discretion, we may include or offer third party products or services on our website. These third party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.
                <br /><br />
                <strong>California Online Privacy Protection Act Compliance</strong>
                <br /><br />
                Because we value your privacy we have taken the necessary precautions to be in compliance with the California Online Privacy Protection Act. We therefore will not distribute your personal information to outside parties without your consent.
                <br /><br />
                As part of the California Online Privacy Protection Act, all users of our site may make any changes to their information at anytime by logging into their control panel and going to the 'Edit Profile' page.
                <br /><br />
                <strong>Childrens Online Privacy Protection Act Compliance</strong> 
                <br /><br />
                We are in compliance with the requirements of COPPA (Childrens Online Privacy Protection Act), we do not collect any information from anyone under 13 years of age. Our website, products and services are all directed to people who are at least 13 years old or older.
                <br /><br />
                <strong>Online Privacy Policy Only</strong> 
                <br /><br />
                This online privacy policy applies only to information collected through our website and not to information collected offline.
                <br /><br />
                <strong>Terms and Conditions</strong> 
                <br /><br />
                Please also visit our Terms and Conditions section establishing the use, disclaimers, and limitations of liability governing the use of our website at <a href="tos.com">tos.com</a>
                <br /><br />
                <strong>Your Consent</strong> <br /><br />
                By using our site, you consent to our <a style='text-decoration:none; color:#3C3C3C;' href='http://www.freeprivacypolicy.com/' target='_blank'>online privacy policy</a>.
                <br /><br />
                <strong>Changes to our Privacy Policy</strong> 
                <br /><br />
                If we decide to change our privacy policy, we will update the Privacy Policy modification date below. 
                <br /><br />
                This policy was last modified on 3/20/2011
                <br /><br />
                <strong>Contacting Us</strong> 
                <br /><br />
                If there are any questions regarding this privacy policy you may contact us using the information below. 
                <br /><br />
                scss.daviddurost.com<br />
                53 Evans St<br />
                s portland, me 04106<br />
                United States<br />
                david.durost@gmail.com<br />
                <center>
                  <div style='font-size: 7pt; font-family: Arial; color: gray; text-decoration: none;'>
                    Privacy Policy Created by <a style='color:#3C3C3C; text-decoration:none;' href='http://www.freeprivacypolicy.com'target='_blank'>Free Privacy Policy</a>
                </center>
              </div>               
<!-- END PRIVACY POLICY CODE -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div id="about-window" class="window">
    <span class="window-close"></span>
    <div>
      <table>
        <thead>
          <tr>
            <th>About SCSS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah <br />
              blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah <br />
              blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah <br />
              blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah <br/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <br /><br />
<?php echo javascript_assets() ?>
<!-- end concatenated and minified scripts-->
<!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->
</body>
</html>