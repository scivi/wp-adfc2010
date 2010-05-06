<div id="searchform">
	<?php
		$query_or_hint = get_search_query();
		if (! $query_or_hint) $query_or_hint = 'Bitte Suchwort eingeben';
	?>
	<form action="<?php echo home_url( '/' );?>" method="get">
		<input type="text" name="s" id="s" value="<?php echo $query_or_hint; ?>"
			   onblur="if(this.value=='')this.value='Bitte Suchwort eingeben';" 
			   onfocus="if(this.value=='Bitte Suchwort eingeben')this.value='';" />
		<input type="image" alt="Durchsuchen" class="searchsubmit" src="<?php bloginfo('template_directory') ?>/gfx/search_submit.gif" />
	</form>
</div>