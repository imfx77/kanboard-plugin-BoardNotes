<?= $this->asset->css('plugins/TodoNotes/Assets/css/dashboard.css') ?>
<?= $this->asset->js('plugins/TodoNotes/Assets/js/tabs.js') ?>
<?= $this->asset->js('plugins/TodoNotes/Assets/js/load_dashboard.js') ?>

<div id="myNotesHeader" class="page-header"><h2>
<?= t('TodoNotes__DASHBOARD_MY_NOTES')?> > <?= t('TodoNotes__DASHBOARD_ALL_TAB') ?>
</h2></div>

<!--
//----------------------------------------
// ACTUAL CONTENT BEGINS HERE !!!
// it shall be regenerated dynamically by reloading the "tabs" and "content" containers from within the page
//----------------------------------------
-->

<section class="mainholderDashboard sidebar-container" id="mainholderDashboard">

<div id="tabs" class="sidebar tabs">

    <?= $this->render('TodoNotes:dashboard/tabs', array(
         'projectsAccess' => $projectsAccess,
         'user_id' => $user_id,
    )) ?>

</div>

<div id="content" class="sidebar-content">

<?php

$project = array('id' => 0, 'name' => t('TodoNotes__DASHBOARD_ALL_TAB'));
if ($tab_id > 0) {
    $projectAccess = $projectsAccess[$tab_id - 1];
    $project = array('id' => $projectAccess['project_id'],
                     'name' => $projectAccess['project_name'],
                     'is_custom' => $projectAccess['is_custom']);
}

?>

<?= $this->render('TodoNotes:project/data', array(
    'projectsAccess' => $projectsAccess,
    'project' => $project,
    'project_id' => $project['id'],
    'user' => $user,
    'user_id' => $user_id,
    'is_refresh' => false,
    'is_dashboard_view' => 1,
    'data' => $data,
    'categories' => $categories,
    'columns' => $columns,
    'swimlanes' => $swimlanes,
)) ?>

</div>

</section>

<!--
//----------------------------------------
// ACTUAL CONTENT ENDS HERE !!!
// all sections below must appear ONCE ONLY and NOT be refreshed
//----------------------------------------
-->

<?php

$isAdmin = $this->user->isAdmin();

// tabId (hidden reference for tabs)
print '<div class="hideMe" id="tabId"';
print ' data-tab="' . $tab_id  . '"';
print ' data-project="' . $project['id'] . '"';
print ' data-admin="' . ($isAdmin ? '1' : '0') . '"';
print '></div>';

//----------------------------------------

print '<div class="hideMe" id="dialogReindexNotesAndLists" title="' . t('TodoNotes__DASHBOARD_REINDEX') . '">';

print '<p style="white-space: pre-wrap;">';
print t('TodoNotes__DIALOG_REINDEX_MSG');
print '</p>';

print '</div>';

//----------------------------------------

print '<div class="hideMe" id="dialogCreateCustomNoteList" title="' . t('TodoNotes__DASHBOARD_CREATE_CUSTOM_NOTE_LIST') . '">';

print '<input type="text" id="nameCreateCustomNoteList" placeholder="' . t('TodoNotes__DIALOG_CREATE_CUSTOM_NOTE_LIST_NAME_PLACEHOLDER') . '">';
print '<br>';
if ($isAdmin) {
    print '<input type="checkbox" id="globalCreateCustomNoteList">';
    print '<label for="globalCreateCustomNoteList">&nbsp;&nbsp;' . t('TodoNotes__DIALOG_CREATE_CUSTOM_NOTE_LIST_GLOBAL_CHECKBOX') . '</label>';
} else {
    print '<input type="checkbox" disabled id="globalCreateCustomNoteList">';
    print '<label for="globalCreateCustomNoteList">&nbsp;&nbsp;' . t('TodoNotes__DIALOG_CREATE_CUSTOM_NOTE_LIST_GLOBAL_CHECKBOX') . ' ' . t('TodoNotes__DASHBOARD_ADMIN_ONLY') . '</label>';
}
print '<br><br>';
print '<p style="white-space: pre-wrap;">';
print t('TodoNotes__DIALOG_CREATE_CUSTOM_NOTE_LIST_MSG');
print '</p>';

print '</div>';

//----------------------------------------

print '<div class="hideMe" id="dialogRenameCustomNoteList" title="' . t('TodoNotes__DIALOG_RENAME_CUSTOM_NOTE_LIST_TITLE') . '">';

print '<input type="text" id="nameRenameCustomNoteList">';
print '<br><br>';
print '<p style="white-space: pre-wrap;">';
print t('TodoNotes__DIALOG_RENAME_CUSTOM_NOTE_LIST_MSG');
print '</p>';

print '</div>';

//----------------------------------------

print '<div class="hideMe" id="dialogDeleteCustomNoteList" title="' . t('TodoNotes__DIALOG_DELETE_CUSTOM_NOTE_LIST_TITLE') . '">';

print '<p style="white-space: pre-wrap;">';
print t('TodoNotes__DIALOG_DELETE_CUSTOM_NOTE_LIST_MSG');
print '</p>';

print '</div>';

//----------------------------------------

print '<div class="hideMe" id="dialogReorderCustomNoteList" title="' . t('TodoNotes__DIALOG_REORDER_CUSTOM_NOTE_LIST_TITLE') . '">';

print '<p style="white-space: pre-wrap;">';
print t('TodoNotes__DIALOG_REORDER_CUSTOM_NOTE_LIST_MSG');
print '</p>';

print '</div>';

//----------------------------------------
