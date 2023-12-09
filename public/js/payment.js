

class Payment {

    stripe;

    cardNumber;
    cardExpiry;
    cardCvc;

    cardNumber_div = '#cardNumber';
    cardExpiry_div = '#expiryDate';
    cardCvc_div = '#cvv';

    payment_form = '#payment-form';

    constructor(publishable_key) {

        const self = this;
        self.publishable_key = publishable_key;
        self.stripe = Stripe(self.publishable_key);
        var elements = self.stripe.elements();

        self.cardNumber = elements.create('cardNumber');
        self.cardExpiry = elements.create('cardExpiry');
        self.cardCvc = elements.create('cardCvc');

        self.mount();
        self.event();

        self.submitForm();


    }

    mount() {
        // mount the stripe iframes into divs
        this.cardNumber.mount(this.cardNumber_div);
        this.cardExpiry.mount(this.cardExpiry_div);
        this.cardCvc.mount(this.cardCvc_div);
    }

    event() {
        // add validation for card details
        this.cardNumber.addEventListener('change', function (event) { Payment.handleCardChange(event); });
        this.cardExpiry.addEventListener('change', function (event) { Payment.handleCardChange(event); });
        this.cardCvc.addEventListener('change', function (event) { Payment.handleCardChange(event); });

    }

    submitForm() {

        const self = this;

        // submit payment form
        $(this.payment_form).on('submit', function (event) {
            event.preventDefault();

            var loader = '<i class="fa fa-circle-o-notch fa-spin"></i>';
            $("#submit_payment").attr('disabled', true).append(loader);

            self.stripe.createToken(self.cardNumber).then(function (result) {
                if (result.error) {
                    self.enableSubmit();
                    var displayError = document.getElementById('card-errors');
                    displayError.textContent = result.error.message;
                } else {

                    var obj = {
                        stripeToken: result.token,
                        amount: $("#amount").val(),
                        card_holder: $("#cardHolder").val()
                    }

                    $.ajax({
                        data: obj,
                        type: "POST",
                        url: '/payment/submitPayment',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        complete: function (data) {
                            Payment.NotificationMessage(data.responseJSON.message, data.responseJSON.type);
                            self.clearForm();
                        }
                    });
                }
            });
        });
    }

    clearForm() {
        //clear form inputs
        this.cardNumber.clear();
        this.cardExpiry.clear();
        this.cardCvc.clear();
        $("#cardHolder").val('');
        $("#amount").val('');
        this.enableSubmit();
    }

    enableSubmit()
    {
        //re-enable submit button
        $("#submit_payment").removeAttr('disabled');
        $("#submit_payment i").remove();
    }

    static NotificationMessage(msg, type) {
        //show notification message
        DevExpress.ui.notify({
            message: function () { return msg; },
            shading: false,
            position: { my: "center top", at: "center top" },
        }, type, 3000);
    }

    static handleCardChange(event) {
        // show errors of card details
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    }
}

$(document).ready(function () {
    var payment = new Payment(publishable_key);
});

