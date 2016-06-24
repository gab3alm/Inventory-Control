# DESCRIPTION OF SCRIPTS
Any kind of html markup used relates to the materializecss framework used.
***

##add_borrower_to_db.php
###Used in public/inventory.php
File is in charge of adding a student borrower to the database once he/she has submitted his item/s request.
It also changes values of availability for the items that the borrower is requesting.

##db_connect.php
File contains database login information
I should not have included this file in the GIT repo, now I have to change passwords. Oh well.
NOTE: include database file to .gitignore file

##get_category_scripts.php
###Used in public/inventory.php
File in charge of fetching all the available items from all the categories present within the database.
It creates the markup necessary for the item cards seen in the public/inventory.php

##inventoryMotion.js
###Used in public/inventory.php
Most important file used by inventory.php. File takes care of category bubbles, item cards animation. 
It also takes care of the updating the borrower item cart, and pushing the borrower's information into 
the database.

##load_circle_categories.js
###Used in public/inventory.php
File in charge of creating markup for the main category bubbles and secondary category bubbles in the student
inventory checkout page.

##logout.php
###Used by logout() in scripts/inventoryMotion.js
File in charge of unsetting && destroying session values.

##movement_button.js
###Used by public/inventory.php
File in charge of button behavior of PREVIOUS/NEXT in the inventory page.

##register_user.php
###Used by public/index.php
File in charge of sending new user information to database

##verify_user.php
###Used by public/index.php
File in charge of user login information verification

