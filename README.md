CaseTrek-task
=============

Task from CaseTrek

About
-----
* Use `casetrek-task.sql` to load database.
* The `config.php` contains the credentials needed to access the database .
* The Admin login and password are `admin` and `pass`. The Login data are static hardcoded !
* The class handling the features is in `feature.php` .
* The class handling the votes is in `vote.php` .
* The `admin.php` and `user.php` are the views .
* The `log.php` contains the Admin class handling the login and logout. `login.php` is required in `admin.php` .
* Libraries used : `jquery` , `jquery-raty` .

Some explanations
-----------------
> I've created the table `features` with two id's because
> I think it's easier to handle them than writing some
> js that would be complicated . The `order_id` contains the
> oreder number that is AI and the `id` contains the unique and
> not changing id for the relation with the votes.

Found Bugs
----------
* Problem with adding new feature on (k-1) possition form k elements . If you save a feature and then move it and save again than there will be no problem.