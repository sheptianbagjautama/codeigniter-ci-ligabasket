
$(function() {
    $('#buttonAdd').click(function() {
        let urlPath = $(this).data('url');
        window.location = urlPath;
    });

    $('#dataTable > tbody > tr').click(function(){
        var eventId = $(this).data('id');
        var status = $(this).data('status');
        var eventDate = $(this).data('date');
        var eventName = $(this).data('name');
        var banner = $(this).data('image');
        var description = $(this).data('description');
        var phone = $(this).data('phone');
        var vendor = $(this).data('vendor');
        var address = $(this).data('address');

        $('.card .card-img-top').remove();
        $('.card.detail').prepend('<img class="card-img-top" src="' + banner +'">');
        $('.card.detail .card-title').text(eventName);
        $('.card.detail .card-subtitle').text(description);
        $('.card.detail .content #vendor').text(vendor);
        $('.card.detail .content #address').text(address);
        $('.card.detail .content #date').text(eventDate);
        //$('.card.detail .content #contact').text(phone);

        $('.card.detail .content .action').hide();
        if(status == 'archive') {
            $('.card.detail .content .action #eventPublishBtn').data("eventId", eventId);
            $('.card.detail .content .action').show();
        }

        $('.card.detail').fadeIn('slow');
    });

    $('#eventPublishBtn').click(function() {
        var eventId = $(this).data('eventId');
        var url = '<?= base_url() ?>' + 'commite/event/publish/' + eventId;


        $.post(url)
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


    $('#event_date').datepicker();


});

$(function(){
    $("#geocomplete").geocomplete({
      map: ".map_canvas",

      markerOptions: {
        draggable: true
      }
    });

    $("#geocomplete").bind("geocode:result", function(event, result){
        console.log(result);
        var latLng = result.geometry.location;

        $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
          $("#reset").show();

          console.log("lat: " + latLng.lat() + " lng: " + latLng.lng());
      });
    
    $("#geocomplete").bind("geocode:dragged", function(event, latLng){
      $("input[name=lat]").val(latLng.lat());
      $("input[name=lng]").val(latLng.lng());
      $("#reset").show();
    });
    
    
    $("#reset").click(function(){
      $("#geocomplete").geocomplete("resetMarker");
      $("#reset").hide();
      return false;
    });
    
    $("#find").click(function(){
      $("#geocomplete").trigger("geocode");
    }).click();
  });
