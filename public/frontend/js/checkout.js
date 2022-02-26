$(document).ready(function () {

    

    var error=$('.error');

    $('.razorpay_btn').click(function (e) { 
        e.preventDefault();
        var l_name=$('#lname').val();
        var f_name=$('#fname').val();
        var email=$('#email').val();
        var phone=$('#phone').val();
        var addr1=$('#address1').val();
        var addr2=$('#address2').val();
        var city=$('#city').val();
        var country=$('#country').val();
        var pin=$('#pin').val();

        if(
            !f_name || f_name=='' ||
            !l_name || l_name=='' ||
            !email || email=='' ||
            !phone || phone=='' ||
            !addr1 || addr1=='' ||
            !addr2 || addr2=='' ||
            !city || city=='' ||
            !country || country=='' ||
            !pin || pin==''
        ){
            error.removeAttr('hidden');
        }else{
            error.attr('hidden','true');

            var data={
                'lname':l_name,
                'fname':f_name,
                'email':email,
                'phone':phone,
                'addr1':addr1,
                'addr2':addr2,
                'city':city,
                'country':country,
                'pin':pin
            };
            $.ajax({
                type: "POST",
                url: "url",
                data: data,
                dataType: "dataType",
                success: function (response) {
                    
                
                    var options = {
                        "key": "YOUR_KEY_ID", // Enter the Key ID generated from the Dashboard
                        "amount": "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": "Acme Corp",
                        "description": "Test Transaction",
                        "image": "https://example.com/your_logo",
                        "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (response){
                            alert(response.razorpay_payment_id);
                            alert(response.razorpay_order_id);
                            alert(response.razorpay_signature)
                        },
                        "prefill": {
                            "name": "Gaurav Kumar",
                            "email": "gaurav.kumar@example.com",
                            "contact": "9999999999"
                        },
                        "notes": {
                            "address": "Razorpay Corporate Office"
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    // rzp1.on('payment.failed', function (response){
                            // alert(response.error.code);
                            // alert(response.error.description);
                            // alert(response.error.source);
                            // alert(response.error.step);
                            // alert(response.error.reason);
                            // alert(response.error.metadata.order_id);
                            // alert(response.error.metadata.payment_id);
                    // });
                    // document.getElementById('rzp-button1').onclick = function(e){
                        rzp1.open();
                        // e.preventDefault();
                    }
                });   // }
        }
                
    });
    
  
});