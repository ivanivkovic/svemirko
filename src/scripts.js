$(document).ready(function()
{
	$('#insert-form-toggle').on('click', function()
	{
		var form = $('#insert-form');

		if(form.is(':visible'))
		{
			form.fadeOut();
		}
		else
		{
			form.fadeIn();
		}
	});

	// Modal verification
	// We copy the href value from delete buttons to the modal "OK" button
	$('#confirm-delete').on('show.bs.modal', function(e)
	{
	    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).attr('href'));
	});
});
