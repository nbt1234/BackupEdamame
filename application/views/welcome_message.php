

 <!-- <div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'demo_sandbox_client_id',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
 color: 'blue',
 shape: 'pill',
 label: 'checkout',
 tagline: 'true'
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: '19',
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      });
    }
  }, '#paypal-button');

</script> 

<!-- 
<script>
paypal.Button.render({
  env: 'production', // Optional: specify 'sandbox' environment
  client: {
    sandbox:    'AZ3SOjGXMtfiG1v8Ylat5KjvR61S8PJG3Psl1ar5RFYUxfjIpOz2vD-uQZFOKwGUvPnFkSHUsiGvH3bR',
    production: 'xxxxxxxxx'
  },
  commit: true, // Optional: show a 'Pay Now' button in the checkout flow
  payment: function (data, actions) {
    return actions.payment.create({
      payment: {
        transactions: [
          {
            amount: {
              total: '11',
              currency: 'USD'
            }
          }
        ]
      }
    });
  },
  onAuthorize: function (data, actions) {
    // Get the payment details
    return actions.payment.get()
      .then(function (paymentDetails) {
        // Show a confirmation using the details from paymentDetails
        // Then listen for a click on your confirm button
        document.querySelector('#confirm-button')
          .addEventListener('click', function () {
            // Execute the payment
            return actions.payment.execute()
              .then(function () {
                // Show a success page to the buyer
              });
          });
      });
  }
}, '#paypal-button');

</script> --> -->
