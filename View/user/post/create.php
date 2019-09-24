<div class="row">

	<div class="col-md-6">
		<h3>Profile</h3>
		<form method="POST" action="register">
			<div class="alert alert-danger error" role="alert">
			  A simple danger alert—check it out!
			</div>
			<div class="alert alert-success success" role="alert">
			  A simple danger alert—check it out!
			</div>
			<div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label">title</label>
		    <div class="col-sm-10">
		      <input type="text" name='title' class="form-control" id="name" value="<?=$data['post']->name ?? ''?>" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label">body</label>
		    <div class="col-sm-10">
		      <textarea name='body' class="form-control" required><?=$data['post']->body ?? ''?></textarea>
		    </div>
		  </div>

		  <button class="btn btn-primary" name='register' id="create" type="button">Create</button>
		</form>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		$('.error').hide();
		$('.success').hide();
		$('#create').click(function(){
			$('.error').hide();
			$('.success').hide();
			$.ajax({

				url:'user.php',
				type:'POST',
				dataType:'json',
				data:{
					method:'savePost',
					title: $('input[name="title"]').val(),
					body: $('textarea[name="body"]').val(),
					id: <?=$data['user']['id']?>
				},
				success:function(data){
					$('.success').html('Created!');
				},
				error: function(data){
					var html ='';
					var d = Object.keys(data.responseJSON) .map(function(key, value){
						return [data.responseJSON[key][0]];
					});
					$('.error').html(d.join('<br/> '));

					$('.error').show();
				}

			})
		});
	})
</script>