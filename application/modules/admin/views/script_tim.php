$(function() {
    $('#dataTable > tbody > tr').click(function(){
        $('.card.detail').hide();

        let logo = $(this).data('image');
        let name = $(this).data('name');
        let description = $(this).data('description');
        let address = $(this).data('address');
        let phone = $(this).data('phone');
        let email = $(this).data('email');

        $('.card-block #logo').html('<img src="'+ logo +'" />');
        $('.card-block #name').text(name);
        $('.card-block .card-subtitle').text(description)

        $('.card-block #address').text(address)
        $('.card-block #phone').text(phone)
        $('.card-block #email').text(email)
        
        $('.card.detail').fadeIn('slow');

    });
})