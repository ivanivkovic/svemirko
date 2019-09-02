$(document).ready(function(){

	$('#form-submit').click(function(e)
	{
		// Prevent the static form submission and replace it with AJAX.
		e.preventDefault();
		e.stopImmediatePropagation();

		$("html").css("cursor", "progress");

		var url = $('#form-element').attr('action') + '/' + $('#ship-type-select').val() + '/' + $('#ship-name').val();

		$.ajax({url: url, success: function(result)
		{	
			let element = $("#search-results");
		    
		    element.empty().fadeIn(200, 'swing', function()
		    {
		    	element.html(result);
		    });

			// Modal verification
			// We copy the href value from delete buttons to the modal "OK" button
			$('#confirm-delete').on('show.bs.modal', function(e)
			{
				console.log($(e.relatedTarget).attr('href'));
			    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).attr('href'));
			});
			
			$('html').css('cursor', 'default');
		}});
	});
});