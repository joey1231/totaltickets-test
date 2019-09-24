<div class="row">

	<div class="col-md-6">
		<h3>Please Enter Details to login:</h3>
		<form method="POST" action="register">
			<div class="alert alert-danger error" role="alert">
			  A simple danger alert—check it out!
			</div>
		  <div class="form-group row">
		    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" name='email' class="form-control" id="staticEmail" value="<?=$_POST['email'] ?? ''?>" required>
		    </div>
		  </div>
		  <div class="form-group row">
		    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
		    </div>
		  </div>
		  <button class="btn btn-primary" name='register' id="register" type="button">Login</button>
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

				url:'auth.php',
				type:'POST',
				dataType:'json',
				data:{
					method:'login',
					email: $('input[name="email"]').val(),
					password: $('input[name="password"]').val()
				},
				success:function(data){
					location.href = 'profile.php';
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