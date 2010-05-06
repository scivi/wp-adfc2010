<div id="searchform">
	<form action="<?php echo home_url( '/' );?>" method="get">
		<input type="text" name="s" id="s" onblur="if(this.value=='')this.value='Bitte Suchwort eingeben';" onfocus="if(this.value=='Bitte Suchwort eingeben')this.value='';" value="Bitte Suchwort eingeben" />
		<input type="image" alt="Durchsuchen" class="searchsubmit" src="<?php bloginfo('template_directory') ?>/gfx/search_submit.gif" />
	</form>
</div>