 
	$(document).ready(function() {
		$("#cart-form").validate({
            
			messages: {
				name: {
					required: 'Pole wymagane!',
					minlength: 'Wpisz conajmniej {2} znaki.',
				},
				email: {
					required: 'Pole wymagane!',
					email: 'Wpisz poprawny adres email.',
				},
				s_name: {
					required: 'Pole wymagane!',
					minlength: 'Wpisz conajmniej {2} znaki.',
				},
                adres: {
					required: 'Pole wymagane!'
                },
                "post_index": {
					required: 'Pole wymagane!'
                },
			}
		});
	});

    
  
    
