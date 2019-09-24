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
		    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
		    <div class="col-sm-10">
		      <input type="text" name='name' class="form-control" id="name" value="<?=$data['user']['name'] ?? ''?>" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" name='email' class="form-control" id="staticEmail" value="<?=$data['user']['email'] ?? ''?>" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
		    </div>
		  </div>
		  <button class="btn btn-primary" name='register' id="register" type="button">Update</button>
		</form>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		$('.error').hide();
		$('.success').hide();

		$('#register').click(function(){
			$('.error').hide();
			$('.success').hide();
			$.ajax({

				url:'user.php',
				type:'POST',
				dataType:'json',
				data:{
					method:'update',
					email: $('input[name="email"]').val(),
					password: $('input[name="password"]').val(),
					name: $('input[name="name"]').val(),
					id: <?=$data['user']['id']?>
				},
				success:function(data){
					$('.success').html('Updated!');
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