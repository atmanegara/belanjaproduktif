$(function(){
	  $(document).on('click', '.showModalButton', function(){
        $('#modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});

