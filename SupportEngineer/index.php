<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test Page</title>
        <script src="https://js.stripe.com/v3/"></script>
       <link rel="stylesheet" type="text/css" href="stripeForm.css">
    </head>
    <body>
        <form action="/public/card" method="post" id="payment-form">
            <div class="form-row">
              <label for="card-element">
                Credit or debit card
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors. -->
              <div id="card-errors" role="alert"></div>
            </div>

            <button>Submit Payment</button>
          </form>
    </body>
    <footer>
        <script src="stripeForm.js"></script>
    </footer>
</html>
