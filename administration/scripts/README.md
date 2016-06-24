#Administrative side - scripts
***

##admin_scripts.js
###used in admin.php
File in charge of regular admin operations
Used for animating the admin user image and also navigation
Views are loaded through ajax into "#application_area" div within admin.php

##card_edit_inventory.js
### Strictly used for card_inventory_load.php
File in charge of making a selected card element editable.

##card_inventory.php
### Strictly used for card_inventory_load.php
File in charge of creating the card markup for every item within the inventory database.

##delete_card.php
###used for both Card and List views
File in charge of deleting a given element from the inventory database.

##edit_db.php
###Used by Card and List views
File in charge of updating a single item information in the database

##get_categories.php
###Used by Card and List views
File in charge of creating a select dropdown of all the existing categories within the database
Used in the item update option in both Card and List view

##inventory_addition.js
###Used by Card and List views
File in charge of enabling the item creation button in both Card and List inventory views

##itemAddition2db.php
###Used by Card and List views
File in charge of pushing the new item information into the database
NOTE: need to stick to a certain file name convention

##list_edit_inventory.js
###Used strictly for the List view
File in charge of enabling changes to a selected list item in the view

##list_inventory.php
###Used by list_inventory_load.php
File in charge of populating the list view with the complete item inventory

##return_items_db.php
###Used by Current view
File in charge of updating information on items returned by the a borrower.
Pretty much clears a certain user of the items that they have successfully returned.
