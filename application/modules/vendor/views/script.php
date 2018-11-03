
$(function() {
    $('#buttonAdd').click(function() {
        let urlPath = $(this).data('url');
        window.location = urlPath;
    });

    $('#dataTable.dataLapangan > tbody > tr').click(function(){
        var hallId=$(this).data('id');
        var hallName=$(this).data('name');
        var dataImage= $(this).data('image');
        var hallImage='<?= base_url() . "media/" ?>' + dataImage;
     
        var url = '<?= base_url(); ?>' + 'vendor/jadwal_lapangan/detail/' + hallId;
        $.get(url)
        .done(function(schedules) {
            console.log(hallImage);
            $('.card-block .card-subtitle').html(hallName);
            $('.card .card-img-top').remove();
            if(dataImage) {
                $('.card.detail').prepend('<img class="card-img-top" src="' + hallImage +'">');
            } 
           
            var schedulesEl = '<ul style="list-style-type: none; padding-left:0;">';
            schedules.forEach(function(item) {
                schedulesEl += '<li>' + item['range_time'] + '</li>';
            })
            schedulesEl + '</ul>';
            $('.card-block .schedules').html(schedulesEl);
            console.log(schedulesEl );
        })
        .fail(function() {
            console.log( "error" );
        })
        .always(function() {
            console.log( "finished" );
        });

        $('.card').removeClass('d-none');
    })

    $('#checkAll').change(function() {
        if( $(this).is(':checked') ) {
            $('.form-check input').slice(1).prop('checked', true);
        } else {
            $('.form-check input').slice(1).prop('checked', false);
        }  
    });

    $('select[name="hall"]').change(function() {
        if($(this).val() !== '') {
            $('.form-check-label').removeClass('color-disable');
            $('.form-check-input').removeAttr('disabled');

            showSchedule();
            
        } else {
            $('.form-check-label').addClass('color-disable');
            $('.form-check-input').attr('disabled');
            $('.form-check input').each(function() {
                $(this).prop('checked', false)
            })

        }
        
    });

    $("#halldate").change(function() {
        showSchedule();
    });

    function showSchedule() {
        var halldate = $("#halldate").val();
        halldate = halldate.split("/");
        halldate = halldate[2] + "-" + halldate[1] + "-" + halldate[0];

        var url = '<?= current_url(); ?>' + '/detail/' + $('select[name="hall"]').val() + '/' + halldate;
        console.log("URL " + url);
            $.get(url)
            .done(function(data) {
                console.log(data);
                data.forEach(function(dt) {
                    var el = $("#checkbox" + dt['id']);
                    if(dt['checked']) {
                        el.prop('checked', true);
                    } else {
                        el.prop('checked', false);
                    }

                    if (dt['booked']) {
                        el.prop('disabled', true);
                    } else {
                        el.prop('disabled', false);
                    }
                });
            })
            .fail(function() {
                console.log( "error" );
            })
            .always(function() {
                console.log( "finished" );
            });
    }

    $('form[name="hallSchedules"]').submit(function(e){
        e.preventDefault();
        var hallId = $(this).find('select[name="hall"]').val();
        var halldate = $(this).find('#halldate').val();

        halldate = halldate.split("/");
        halldate = halldate[2] + "-" + halldate[1] + "-" + halldate[0];

        var schedules= [];
        $('input.schedule:checked').each(function(){
            schedules.push($(this).val()) // This is the jquery object of the input, do what you will
        });
        var payload = {
            'hallId': hallId,
            'halldate': halldate,
            'schedules': schedules
        }
        console.log(payload)
        var url = $(this).attr('action');

        $.post( url, payload)
        .done(function() {
            swal(
                'Success!',
                'Data berhasil disimpan',
                'success'
            )
        })
        .fail(function() {
            swal(
                'Error!',
                'Data gagal disimpan',
                'error'
            )
        })
        .always(function() {
            console.log( "finished" );
        });
    });

    $('#halldate').datepicker({
        "format": "dd/mm/yyyy",
    });

});
