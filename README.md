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
> Validations in the user view are for correct email (with re in js) ,
> correct vote ( you cant vote with more stars than you have ).
> Also the button Save is disabled until you enter a correct email.
> User votes with 0 stars are also saved because if the same user
> decide to vote again the scores will be overwrite and he/she wont be able
> to make 5 stars vote for every feature !

Found Bugs
----------
* Problem with adding new feature on (k-1) possition form k elements . If you save a feature and then move it and save again than there will be no problem.