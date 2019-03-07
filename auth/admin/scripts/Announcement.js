$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	var text1;
	var text2;
	var xhr = new XMLHttpRequest();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><input type="text" class="form-control" name="announcementid" id="announcement_id"></td>' + 
			'<td><a class="add" title="Add" name="add_announcement" id="add_announcement" data-toggle="tooltip"><i class="material-icons"></i></a>' + '<a class="delete" title="Delete" data-toggle="tooltip" name="cancel_add_announce" id="cancel_add_announce"><i class="material-icons"></i></a></td>'+
        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
    });
    //name="add_announcement" id="add_announcement">
    $(document).on('click','#cancel_add_announce',function(e)
	{
        fetch_data();
	});
    
    $(document).on('click','#add_announcement',function(e)
	{	
		var text = $('#announcement_id').val();
		$.ajax({
			url:'php/announcement_add.php',
			data:{text:text},
			method:'post',
			success: function(data)
			{
				alert('Success');
                fetch_data();
			}
		});
	});
    
	// Add row on add button click
	$(document).on("click", ".add2", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
				text1 = $(this).val();
			
			
			
			});	
			document.location.href="/pupwebdev/auth/admin/php/EditAnnouncement.php?name=" + text2 + "&text=" + text1;			
			$(this).parents("tr").find(".add2, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}
		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" id="textinput" class="form-control" value="'+$(this).text()+'">');
			text2 = $('#textinput').val();
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	// $(document).on("click", ".delete", function(){
    //     $(this).parents("tr").remove();
	// 	$(".add-new").removeAttr("disabled");
    // });
    
    function fetch_data()
        {
            $.ajax({
                url:'announcement_load.php',
                method:'post',
                success:function(data)
                {
                    document.getElementById("button-search").disabled = false;
                    $('#live_table').html(data);
                }
            })
        }
        fetch_data();
});