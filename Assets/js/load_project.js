let _BoardNotes_Project_ = {}; // namespace

_BoardNotes_Project_.adjustAllNotesPlaceholders = function() {
    setTimeout(function() {
        // adjust notePlaceholder containers where not needed
        _BoardNotes_.adjustNotePlaceholders(0, 0);
        $("button" + ".checkDone").each(function() {
            var project_id = $(this).attr('data-project');
            var id = $(this).attr('data-id');
            _BoardNotes_.adjustNotePlaceholders(project_id, id);
        })
    }, 100);
}

_BoardNotes_Project_.prepareDocument = function() {
    // handle notes reordering
    function updateNotesOrder() {
        var order = $(this).sortable('toArray');
        order = order.join(",");
        var regex = new RegExp('item-', 'g');
        order = order.replace(regex, '');
        order = order.split(',');
        _BoardNotes_.sqlUpdatePosition(project_id, user_id, order, nrNotes);
    }

    _BoardNotes_.optionShowCategoryColors = ($("#session_vars").attr('data-optionShowCategoryColors') == 'true') ? true : false;
    _BoardNotes_.optionSortByState = ($("#session_vars").attr('data-optionSortByState') == 'true') ? true : false;

    var project_id = $("#refProjectId").attr('data-project');
    var user_id = $("#refProjectId").attr('data-user');
    var isMobile = _BoardNotes_.isMobile();

    // notes reordering is disabled in Overview Mode (ALL projects tab)
    // or when explicitly sorted by state
    if (!_BoardNotes_.optionSortByState) {
        if (isMobile){
            // show explicit reorder handles for mobile
            $(".sortableHandle").removeClass( 'hideMe' );
        }
        else{
          // drag entire notes for non-mobile
          $( '#sortableRef' + project_id ).sortable({ items: 'li.liNote' });
          $(function() {
            $( '#sortableRef' + project_id ).sortable({
              placeholder: "ui-state-highlight",
              update: updateNotesOrder
            });
            $( '#sortableRef' + project_id ).disableSelection();
          });
        }
    }

    if(isMobile) {
        // choose mobile view
        $("#mainholderP" + project_id).removeClass('mainholder').addClass('mainholderMobile');
    }

    _BoardNotes_Translations_.initialize();

    _BoardNotes_Project_.adjustAllNotesPlaceholders();
    _BoardNotes_.refreshCategoryColors();
    _BoardNotes_.refreshSortByState();

    // prepare method for dashboard view if embedded
    if (typeof _BoardNotes_Dashboard_ !== 'undefined') {
        _BoardNotes_Dashboard_.prepareDocument();
    }
}

window.onresize = _BoardNotes_Project_.adjustAllNotesPlaceholders;
$( document ).ready( _BoardNotes_Project_.prepareDocument );
