<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>inventory side</title>
</head>

<body>
    <link rel="stylesheet" href="../sass/admin_inventory.css">

    <div class="container-fluid">
        <!--||||||||||||||||||||||||||||||||||-->
        <!--|||MODAL BUTTON AND ITS STRUCTURE SECTION-->
        <!--||||||||||||||||||||||||||||||||||-->
        <div class="row">
            <div class="col s12">

                <!--MODAL TRIGGER FOR ITEM ADDITION-->
                <img data-target="addition_modal" class="item_addition hoverable modal-trigger" src="../images/plus.svg" alt="item addition button">

                <!--||||||||||||||||||||||||||||||||||-->
                <!--|||ADDITION MODAL STRUCTURE 	  -->
                <!--||||||||||||||||||||||||||||||||||-->
                <div class="row">
                    <div class="col s12 m2">
                        <div id="addition_modal" class="modal center-align">
                            <div class="modal-content">
                                <p class="modal-header">item addition</p>
                                <div class="card">
                                    <div class="card-image waves-effect waves-block waves-light">
                                        <img class="item-image" src="../images/inventory/default.svg">
                                        <div class="divider"></div>
                                    </div>
                                    <!--ITEM NAME-->
                                    <div class="input-field col s12">
                                        <label class="addition-label" for="item-name">name</label>
                                        <input id="item-name" type="text" class="validate">
                                    </div>
                                    <!--ITEM CATEGORY-->
                                    <div class="input-field col s12">
                                        <select id="item-category">
                                            <script>
                                                $("#item-category").load("scripts/get_categories.php");
                                            </script>
                                        </select>
                                        <label class="addition-label" for="item-category">category</label>
                                    </div>
                                    <!--ITEM DESCRIPTION-->
                                    <div class="input-field col s12">
                                        <label for="item-description">Description</label>
                                        <textarea id="item-description" class="materialize-textarea" length="500"></textarea>
                                    </div>
                                    <!--ITEM QUANTITY-->
                                    <div class="input-field col s12">
                                        <label class="addition-label" for="item-quantity">quantity</label>
                                        <input id="item-quantity" type="number" class="validate">
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="modal-footer">
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
                                <a id="add_it" href="#!" class="modal-action waves-effect waves-green btn-flat">Add</a>
                            </div>
                        </div>
                    </div>
                </div>


                <!--||||||||||||||||||||||||||||||||||-->
                <!--|||DELETION MODAL STRUCTURE 	  -->
                <!--||||||||||||||||||||||||||||||||||-->
                <div class="row">
                    <div class="col s12 m4">
                        <div id="deletion_modal" class="modal">
                            <div class="modal-content">
                                <div class="row">
                                    <h4 class="deletion-warning">are you sure you want to delete this item?</h4>
                                </div>
                                <p class="deletion-message">This deletion is permanent</p>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" id="keep" class="modal-action modal-close waves-effect waves-green btn-flat">Keep It</a>
                                <a href="#!" id="delete" class="modal-action modal-close waves-effect waves-green btn-flat">Delete It</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--||||||||||||||||||||||||||||||||||-->
        <!--|||DEMONSTRATION FOR ITEMS IN THE INVENTORY-->
        <!--||||||||||||||||||||||||||||||||||-->
        <div class="row">
            <div id="inventory_area" class="inventory_area">
                <script>
                    $("#inventory_area").load("scripts/card_inventory.php");
                </script>
            </div>
        </div>
    </div>







    <script src="scripts/inventory_addition.js"></script>
</div>

</body>

</html>