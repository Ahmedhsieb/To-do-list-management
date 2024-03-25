<?php
include 'nav.php';

include_once "../Lib/registry.php";
include_once "../Lib/db.php";
include_once "../Lib/validation.php";
include_once "../Models/user_db.php";
// include_once "../Models/user.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;
use Todo_list\Lib\validation;

// use Todo_list\Models\user;

registry::set("validation", new validation);

registry::set("note", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));

$notes = registry::get("note")->getAllData("note");

if(isset($_GET['id']))
    $note_for_update = registry::get("note")->getDataById("note", $_GET['id']);

?>
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container sidebar-closed " style="margin-right: 50px;" id="container">

    <div class="overlay"></div>
    <div class="cs-overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="">

            <div class="row app-notes layout-top-spacing" id="cancel-row">
                <div class="col-lg-12">
                    <div class="app-hamburger-container">
                        <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-menu chat-menu d-xl-none">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg></div>
                    </div>

                    <div class="app-container">

                        <div class="app-note-container">

                            <div class="app-note-overlay"></div>

                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center">
                                        <a id="btn-add-notes" class="btn btn-primary" href="javascript:void(0);">Add</a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 mt-5">
                                        <ul class="nav nav-pills d-block" id="pills-tab3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions active" id="all-notes"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit">
                                                        <path
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg> All Notes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="note-fav"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-star">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg> Favourites</a>
                                            </li>
                                        </ul>

                                        <hr />
                                    </div>
                                </div>
                            </div>


                            <div id="ct" class="note-container note-grid">
                            <?php if(!empty($notes)):?>
                                <?php foreach($notes as $note):?>
                                    <div class="note-item all-notes
                                                <?php if($note['is_fav']): ?>
                                                    note-fav
                                                <?php endif; ?>">

                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title" data-noteTitle="<?=$note['title']?>"><?=$note['title']?>
                                                </p>
                                                <p class="meta-time"><?=$note['date']?></p>
                                                <div class="note-description-content">
                                                    <p class="note-description"
                                                        data-noteDescription="<?=$note['details']?>">
                                                        <?=$note['details']?></p>
                                                </div>
                                            </div>
                                            <div class="note-action">
                                                <!-- Make Favourite Note -->
                                                <a href="../Backend/Note/makeFav.php?id=<?=$note['id']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" 

                                                        <?php if($note['is_fav']): ?>
                                                            fill= "rgba(255, 187, 68, 0.46)"
                                                        <?php else: ?>
                                                            fill= "none"
                                                        <?php endif;?>
                                
                                                        stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-star fav-note">
                                                        <polygon
                                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                        </polygon>
                                                    </svg>
                                                </a>
                                                <!-- Delete Note -->
                                                <a href="../Backend/Note/deleteNote.php?id=<?=$note['id']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-trash-2 delete-note">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                        </path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </a>
                                                <!-- Update Note -->
                                                <a id="btn-update-notes" href="note.php?id=<?=$note['id']?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" 
                                                        style="
                                                            padding: 4px;
                                                            border-radius: 5px;
                                                            cursor: pointer;
                                                            color: #607d8b;
                                                            width: 28px;
                                                            height: 28px;
                                                            stroke-width: 1.6;
                                                            "
                                                        onmouseover="this.style.color = '#516ae7'"
                                                        onmouseout="this.style.color = '#607d8b'"

                                                        class="feather feather-edit">
                                                        <path 
                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path
                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php endif;?>

                            </div>

                        </div>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="notesMailModal" tabindex="-1" role="dialog"
                        aria-labelledby="notesMailModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-x close" data-dismiss="modal">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                    <div class="notes-box">
                                        <div class="notes-content">

                                        <?php if(isset($_GET['id'])):?> <!-- Update Note -->
                                            <form action="../Backend/Note/updateNote.php" method="POST"
                                                id="notesMailModalTitle">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="d-flex note-title">
                                                            <input type="text" name="title" id="n-title"
                                                                class="form-control" value="<?=$note_for_update['title']?>" placeholder="Title">
                                                        </div>
                                                        <span class="validation-text"></span>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="d-flex note-description">
                                                            <textarea id="n-description" name="details"
                                                                class="form-control" placeholder="Description"
                                                                rows="3" ><?=$note_for_update['title']?></textarea>
                                                        </div>
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="id" value="<?=$note_for_update['id']?>">

                                                <div class="modal-footer">
                                                    <!-- <button id="btn-n-save" class="float-left btn">Save</button> -->
                                                    <button class="btn" data-dismiss="modal"> <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-trash">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg> Discard</button>
                                                    <button  class="btn" type="submit">Update</button>
                                                </div>
                                            </form>
                                        <?php else: ?> <!-- Add Note -->
                                            <form action="../Backend/Note/addNote.php" method="POST"
                                                id="notesMailModalTitle">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="d-flex note-title">
                                                            <input type="text" name="title" id="n-title"
                                                                class="form-control" placeholder="Title">
                                                        </div>
                                                        <span class="validation-text"></span>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="d-flex note-description">
                                                            <textarea id="n-description" name="details"
                                                                class="form-control" placeholder="Description"
                                                                rows="3"></textarea>
                                                        </div>
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <!-- <button id="btn-n-save" class="float-left btn">Save</button> -->
                                                    <button class="btn" data-dismiss="modal"> <svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-trash">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg> Discard</button>
                                                    <button  class="btn" type="submit">Add</button>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->
<?php include "footer.php"; ?>