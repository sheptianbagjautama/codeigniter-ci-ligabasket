$(function() {
    $(".mapcontainer").hide();

    $("#dataTable").on('click',"tr",function() {



        $('.card.detail .confirmation').hide();
        $('.mapcontainer').hide();

        var invoiceId = $(this).data('id');

        var rentDate = $(this).data('orderDate');

        var customer = $(this).data('customer');

        var bill = $(this).data('total');

        var hall = $(this).data('hall');

        var rentHour = $(this).data('rentHour');

        var status = $(this).data('status');

        var latitude = $(this).data('lat');
        var longitude = $(this).data('lng');

        console.log("lat: " + latitude + " lng: " + longitude);



        console.log("inv id " + invoiceId);



        $('.card.detail .card-subtitle').text(invoiceId + ' | ' + status);

        $('.card.detail #rentDate').text(rentDate);

        $('.card.detail #customer').text(customer);

        $('.card.detail #hall').text(hall);

        $('.card.detail #rentHour').text(rentHour + " jam");

        $('.card.detail #bill').text('Rp' + bill);

        var mapProp = {
            center:new google.maps.LatLng(latitude, longitude),
            zoom:16,
        };

        if (latitude != '' && longitude != '') {


            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

            var uluru = {lat: latitude, lng: longitude};
            var marker = new google.maps.Marker({
              position: uluru,
              map: map,
            });
        }


        if(status == 'order' || status == 'transfer') {

            $('.card.detail .confirmation #orderAcceptBtn').data("invoiceId", invoiceId);

            $('.card.detail .confirmation #orderAcceptBtn').data("status", status);

            $('.card.detail .confirmation #orderAcceptBtn').text('Konfirmasi Order');

            $('.card.detail .confirmation').show();

        }



         if(status == 'confirmed' || status == 'transfer' || status == 'paid') {

             var imageReceipt = $(this).data('receipt');

             console.log(imageReceipt);

             $('.card.detail #buktiBayar').empty();

             if(imageReceipt != '') {

                $('.card.detail #buktiBayar').append('<p>Bukti Bayar</p><img class="img-receipt" src="' + imageReceipt +'">');

             }

           }



       

        

        $('.card.detail').hide();
        $('.mapcontainer').hide();

        $('.card.detail').fadeIn('slow');
        $('.mapcontainer').fadeIn('slow');

    });



    $('#orderAcceptBtn').click(function() {

        var url = '<?= base_url() ?>' + 'vendor/data_penyewaan/update';

        var invoiceId = $(this).data('invoiceId');

        var status = $(this).data('status');



        if(status == 'paid') {

            status = 'confirmed';

        }



        if(status == 'order') {

            status = 'accepted';

        }

        if(status == 'transfer') {

            status = 'paid';

        }



        var payload = {

            'invoiceId': invoiceId,

            'status': status

        }



        $.post( url, payload)

        .done(function() {

            swal(

                'Success!',

                'Status order ' + status,

                'success'

            ).then((result) => {

                if (result.value) {

                    location.reload();

                }

            })

        })

        .fail(function() {

            swal(

                'Error!',

                'Server error',

                'error'

            )

        })

        .always(function() {

            console.log( "finished" );

        });

        

    });

});