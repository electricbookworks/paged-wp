<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Paged Preview</title>
	<meta name="description" content="Paged Preview">
	<meta name="author" content="Electric Book Works">

	<?php do_action( 'paged_head' ); ?>
</head>

<body>

<?php
/* Start the Loop */
while ( have_posts() ) :
    the_post();
    the_content();
endwhile; // End of the loop.
?>

<?php do_action( 'paged_foot' ); ?>

</body>
</html>
