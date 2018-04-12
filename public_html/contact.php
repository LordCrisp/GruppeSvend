<?php
require  "incl/init.php";
/* - Head, Header & Body (start) - */
require "incl/header.php";
?>

<main class="alt__container">
  <header>
    <div>
      <h1>Contact us</h1>
      <small>Write us a message here</small>
    </div>
    <div></div>
  </header>
  <form class="contact__form">
    <div class="form__group">
      <input type="text" name="name" id="name" placeholder="NAME" />
    </div>
    <div class="form__group">
      <input type="email" name="email" id="email" placeholder="EMAIL" />
    </div>
    <div class="form__group">
      <textarea name="message" id="message" placeholder="MESSAGE" rows="8"></textarea>
    </div>
    <div class="form__group--submit">
      <button type="submit">SEND US THE MESSAGE</button>
    </div>
  </form>
  <article class="contact__info">
    <h2>Fashion Online</h2>
    <ul>
      <li>address: lindholm brygge 9</li>
      <li>zipcode: 9400 norresundby</li>
      <li>country: denmark</li>
      <li>phone: +45 12 34 56 78</li>
    </ul>
  </article>
  <div>

  </div>
</main>

<?php
require "incl/footer.php";
?>
