<li class="">
    <?php
        $statsWidget = '';
        $statsWidget .= '<span class="BoardNotes_ProjectDropdown_StatsWidget" data-project="';
        $statsWidget .= $project['id'];
        $statsWidget .= '">';
        $statsWidget .= $this->render('BoardNotes:widgets/stats', array('stats_project_id' => $project['id']));
        $statsWidget .= '</span>';
    ?>

    <?= $this->url->icon('wpforms', t('Notes') . $statsWidget, 'BoardNotesController', 'boardNotesShowProject', array(
        'project_id' => $project['id'],
        'use_cached' => '1',
        'plugin' => 'BoardNotes',
    )) ?>
</li>
