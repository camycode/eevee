(function ($) {

    var $directive_post_editor = $('#directive-post-editor');

    var $componentsPostEditorSubmitPostEditorBtn = $('#componentsPostEditorSubmitPostEditorBtn');

    var $componentsPostEditorHidePostEditorBtn = $('#componentsPostEditorHidePostEditorBtn');

    var editor = {

        show: function () {

            $directive_post_editor.show();
        },

        hide: function () {

            $directive_post_editor.hide();
        }

    };

    $componentsPostEditorSubmitPostEditorBtn.click(function () {

    });

    $componentsPostEditorHidePostEditorBtn.click(function () {

        editor.hide();

    });

    $.components.post.editor = editor;

})($);