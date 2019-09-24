<div class="row">
	<div class="col-md-12">
		<h3><?=$post->title?></h3>
		<b><?=$post->created_at?></b>
	</div>

	<div class="col-md-12">
		<p><?=$post->body?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Comments:<h3>
	</div>
	<div class="col-md-12">
		<div class='row'>
	<?php
foreach ($post->comments() as $key => $comment) {
    ?>
				<div class="col-md-12">
					<div class="commit-user">
						<b><?=$comment->user()->name?> <?=$comment->user()->email?></b>
						<span><?=$comment->created_at?></span>
					</div>

					<div class="commit-body">
						<p class="text-justify"><?=$comment->body?></p>
					</div>
				</div>
			<?php
}
?>
		</div>
	</div>
	<hr />
	<div class="col-md-12 add-comments">
			<form method="post" action="post.php?method=addComment&post_id=<?=$post->id?>">
						<input type="hidden" name='redirect' value="post.php?method=view&id=<?=$post->id?>">
						<div class="form-group">
							<textarea name='body' id="<?=$post->id?>" class='form-control'></textarea>
						</div>
						<button class="btn  btn-primary" class="addComment" type="submit">Add Comment</button>
			</form>
		</div>
</div>