   $(document).ready(function () {

  
        //$(".getUserId").click(function () {

		 $('body').on('click', '.viewUser',function(e){
		    e.preventDefault();
			console.log('user view');
            var uId = $(this).val();
            var url = "http://127.0.0.1/admin/user/getUserDetail/"+uId;
            $.ajax({
                type: "POST",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });

       $('body').on('click', '.edituser',function(e){
			e.preventDefault();
            var uId = $(this).attr('value');
            url = "http://127.0.0.1/admin/user/add_edit_user/"+uId;
            $.ajax({
                type: "GET",
                url: url,
                data: {'layout_type':'popup'},
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
      
    });
	
	$('body').on('submit', '#add_edit_user_form',function(e){
		    e.preventDefault();
				console.log( 'xyz' );
            var form = $('#add_edit_user_form');
		    var url = form.attr('action')+ '?layout_type=popup';
			console.log( url );
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize() ,
                success: function (data) {
                    $("#model_data_ajax").html(data);
                },
                 beforeSend: function () {
                    $("#model_data_ajax").html('Please wait...');
                 },
                failure: function (data) {
                    alert('Failure!');
                }
            });

        });
	//}
	
    /* Get District List Based On State ID code ended */
