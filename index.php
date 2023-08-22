<?php
require_once __DIR__ . "/functions/functions.php";

require_once __DIR__ . "/parts/header.php";
require_once __DIR__ . "/parts/navbar.php";
cantAccess();
?>

<section class="w-100" id="heroSection">
  <div class="container-lg w-75 d-flex text-center text-lg-start justify-content-between align-items-center flex-wrap">

    <div class="col-lg-4 col-md-12 col-sm-12 pb-5 order-1 order-lg-0">
      <h1 class="display-3 my-5">
        <strong>Digital Menu for Restaurants</strong>
      </h1>
      <h5 class="mb-5">Create your digital menus with included QR Code, letting your customers view the menu on thier devices.</h5>
      <div class="d-flex justify-content-center justify-content-lg-start flex-wrap">
        <a type="button" class="btn orangeBtn fw-bold w-75 mb-2 rounded-4 py-2 col-12">Start Your Free Trial</a>
        <a href='./figma.html' class="btn whiteBtn fw-bold w-75 rounded-4 py-2 col-12">Try NextMenu</a>
      </div>
    </div>

    <div class="col-lg-7 col-md-12 col-sm-12 order-0 order-lg-1">
      <img src="./images/hero-img.png" class="img-fluid" id="heroImg" alt="">
    </div>
  </div>
</section>

<section class="w-100 mt-3 d-flex" id="features">
  <div class="container-fluid w-75">
    <div class="row pt-5">
      <div class="text-center">
        <span class="h3 border-2 border-bottom pb-2 border-black">FEATURES</span>
      </div>
      <div class="row mt-5 pt-5 justify-content-between">
        <div class="col-lg-3 py-3 rounded-4 text-center featuresDiv">
          <h5 class="pb-1">PRODUCT SHOWCASE</h5>
          <p>Good quality photos without background that show the product clearly and detail description with a price after every photo.</p>
        </div>
        <div class="col-lg-3 py-3 rounded-4 text-center featuresDiv">
          <h5 class="pb-1">EASY UPDATES</h5>
          <p>Update your menu instantly with just a few clicks. Make real-time changes to prices, descriptions, and availability. Ensure customers always see the most up-to-date offerings.</p>
        </div>
        <div class="col-lg-3 py-3 rounded-4 text-center featuresDiv">
          <h5 class="pb-1">CUSTOMIZATON</h5>
          <p>Possibility to choose whether there will be a section for drinks only or if there will also be a section for food.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="w-100 pt-3" id="howItWorks">
  <div class="container-fluid">
    <div class="row pt-5">
      <div class="d-flex justify-content-center text-center">
        <h3 class="border-2 border-bottom pb-2 border-black">HOW IT WORKS</h3>
      </div>
    </div>

    <div class="row">
      <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner container-fluid w-75">
          <div class="carousel-item active my-5">
            <div class="row d-flex align-items-center">
              <div class="col-md-6 d-flex justify-content-center">
                <img src="./images/homescreenexample.png" alt="" class="img-fluid exampleImg">
              </div>
              <div class="col-md-6">
                <h3>Home screen</h3>
                <p>Home screen is compact and optimized. Actions and needs are straightforward to manage. There are all the options a customer needs (all the basic information). Unhelpful details are denied that would make the client feel upset. Food and drink are clearly separated and visible. The accent is on Promotions. That’s good for the marketing of the business.</p>
                <!-- <p>You can just simply show your menu digitally in the best possible way, by showcasing your food and beverages with beautiful photos and videos. Take advantage of our other features that will guarantee an increase in sales and guest satisfaction while being more personalized with your guests by still providing physical table service.</p> -->
              </div>
            </div>
          </div>
          <div class="carousel-item my-5">
            <div class="row d-flex align-items-center">
              <div class="col-md-6 d-flex justify-content-center">
                <img src="./images/foodproductsexample.png" alt="" class="img-fluid exampleImg">
              </div>
              <div class="col-md-6">
                <h3>Food products</h3>
                <p>Every product has a good-quality photo that is eye-catching for the customer. Some information in the description is given to arouse the customer's curiosity and a button to see more about it.</p>
              </div>
            </div>
          </div>
          <div class="carousel-item my-5">
            <div class="row d-flex align-items-center">
              <div class="col-md-6 d-flex justify-content-center">
                <img src="./images/productexample.png" class="img-fluid exampleImg" alt="">
              </div>
              <div class="col-md-6">
                <h3>Product screen</h3>
                <p>The primary mission of this QR menu is to clearly show the real photos of the products it offers. Additionally, to facilitate easy navigation to the drink section, there is a button that leads there.</p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

    </div>
  </div>
</section>

<section class="w-100 py-3" id="aboutUs">
  <div class="container-lg">
    <div class="text-center pt-5">
      <span class="h3 border-2 border-bottom pb-2 border-black">ABOUT US</span>
    </div>

    <div class="row d-flex my-5 justify-content-center text-center">
      <div class="col-lg-7 mt-lg-0 mt-2">

        <p>
          At Brainster Next College, we are a team of ambitious students driven by a common goal: to find innovative solutions that benefit both businesses and the environment. Our latest project focuses on revolutionizing the way menus are presented, eliminating the need for printed menus and reducing paper waste.
        </p>
        <p>
          Our motivation stems from witnessing the significant environmental impact of traditional printed menus. Each time prices change or menus need updating, countless sheets of paper are wasted, contributing to deforestation and increased carbon footprint. We believe there is a better, more sustainable way to approach menu distribution.
        </p>
        <p>
          Introducing our solution: the optimized and easy-to-navigate QR menu. By leveraging the power of QR codes, we offer restaurant owners a digital alternative that is not only eco-friendly but also enhances the dining experience for their customers.
        </p>
        <p>
          With our QR menu, restaurant managers can make instant updates and changes to their menu, ensuring that customers always have access to the most accurate and up-to-date information. Eliminating the need for physical menus, our solution reduces paper waste and promotes a greener, more sustainable dining environment.
        </p>
        <p>
          We are dedicated to continuous improvement, and we value feedback from restaurant managers like you. Your insights and opinions are vital in shaping the future of our QR menu product. Together, we can create a solution that not only meets your needs but also exceeds your expectations.
        </p>
        <p>
          Join us on this journey towards a more eco-friendly and efficient dining industry. Together, we can make a positive impact on the environment while enhancing the dining experience for customers and streamlining operations for restaurant managers.
        </p>
        <p>
          We are here to listen to your opinions, answer any questions you may have, and collaborate with you to create a better future. Contact us today to learn more about how our QR menu solution can benefit your establishment.
        </p>
        <p>
          Together, let's embrace sustainability and innovation for a brighter tomorrow.
        </p>
      </div>
    </div>

  </div>
</section>

<?php
getEnd(1);
?>