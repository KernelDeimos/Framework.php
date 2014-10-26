<h1>'tis functional!</h1>
<?php if ($displayDBWarning===true): ?>
	<h3>Note: couldn't connect to the database. This is normal if you're running this for the first time; just find SITE_PATH/conf/database.ini and make the needed changes. (if you don't plan on using a database, you may ignore this.)</h3>
<?php endif; ?>
<?php if ($displayDBSuccess===true): ?>
	<h3>Successfully connected to the configured database! :D</h3>
<?php endif; ?>