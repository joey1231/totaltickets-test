<div class="row">
	<div class="offset-md-10 col-md-2">
		<a class="btn btn-success" href="post.php?method=create"> Create Post</a>
	</div>
	<br/>
	<div class="col-md-12">

		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Title</th>
		      <th scope="col">Created At</th>
		      <th scope="col">action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
foreach ($posts as $key => $post) {
    ?>
		  				<tr>
		  					<th scope="row"><?=$post->id?></th>
					      	<td><?=$post->title?></td>
					      	<td><?=$post->created_at?></td>
					      	<td>
					      		<a href="post.php?method=view&id=<?=$post->id?>" class="btn btn-success">View</a>
					      		<a href="post.php?method=edit&id=<?=$post->id?>" class="btn btn-warning">Edit</a>
					      		<a href="post.php?method=delete&id=<?=$post->id?>" class="btn btn-danger">Delete</a>
					      	</td>
		  				</tr>
		  			<?php
}
?>
		  </tbody>
		</table>
	</div>
</div>
