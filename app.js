(function () {
    'use strict';

    function getCommand(form) {
        var command = form.querySelector('input[name="cmd"]');
        return command ? command.value : '';
    }

    function isDestructiveCommand(command) {
        return [
            'delete1',
            'delete2',
            'deleteComments',
            'deleteSelectedUsers',
            'deleteUser'
        ].indexOf(command) !== -1;
    }

    function hasSelectedItems(form, submitter) {
        if (submitter && submitter.name && submitter.name.slice(-2) === '[]') {
            return true;
        }

        return form.querySelectorAll(
            'input[type="checkbox"][name$="[]"]:checked'
        ).length > 0;
    }

    function setBusyState(form) {
        var submit = form.querySelector(
            'button[type="submit"], input[type="submit"]'
        );

        if (!submit) {
            return;
        }

        submit.disabled = true;
        submit.setAttribute('aria-busy', 'true');

        if (submit.tagName.toLowerCase() === 'button') {
            submit.dataset.originalLabel = submit.textContent;
            submit.textContent = 'Please wait...';
        } else {
            submit.dataset.originalLabel = submit.value;
            submit.value = 'Please wait...';
        }
    }

    function addSelectionTools(form, checkboxes) {
        var toolbar = document.createElement('div');
        var selectAll = document.createElement('button');
        var clearAll = document.createElement('button');

        toolbar.className = 'selection-tools';
        toolbar.setAttribute('aria-label', 'Selection tools');

        selectAll.type = 'button';
        selectAll.className = 'selection-tool';
        selectAll.textContent = 'Select all';
        selectAll.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = true;
            });
        });

        clearAll.type = 'button';
        clearAll.className = 'selection-tool';
        clearAll.textContent = 'Clear all';
        clearAll.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false;
            });
        });

        toolbar.appendChild(selectAll);
        toolbar.appendChild(clearAll);
        form.insertBefore(toolbar, form.firstChild);
    }

    function enhanceSelectionForms() {
        document.querySelectorAll('form').forEach(function (form) {
            var checkboxes = Array.prototype.slice.call(
                form.querySelectorAll('input[type="checkbox"][name$="[]"]')
            );

            if (checkboxes.length > 1) {
                addSelectionTools(form, checkboxes);
            }
        });
    }

    function enhancePostRows() {
        document.querySelectorAll('[data-post-row]').forEach(function (row) {
            function loadPost() {
                var editor = document.querySelector('[data-post-editor]');
                if (!editor) {
                    return;
                }

                var command = editor.querySelector('input[name="cmd"]');
                var postId = editor.querySelector('input[name="postid"]');
                var title = editor.querySelector('input[name="blogtitle"]');
                var body = editor.querySelector('textarea[name="textarea"]');
                var submit = editor.querySelector(
                    'button[type="submit"], input[type="submit"]'
                );

                postId.value = row.dataset.postId;
                title.value = row.dataset.postTitle;
                body.value = row.dataset.postBody;
                command.value = 'updatePost';

                if (submit.tagName.toLowerCase() === 'button') {
                    submit.textContent = 'Update blog';
                } else {
                    submit.value = 'Update blog';
                }
                editor.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            row.querySelectorAll('[data-edit-post]').forEach(function (button) {
                button.addEventListener('click', function () {
                    var link = row.querySelector('.delete-blog-title');
                    if (link) {
                        window.location.href = link.href;
                    } else {
                        loadPost();
                    }
                });
            });

            row.addEventListener('click', function (event) {
                if (event.target.closest(
                    'input[type="checkbox"], label, .row-delete-button'
                )) {
                    return;
                }

                var link = row.querySelector('.delete-blog-title');
                if (link) {
                    window.location.href = link.href;
                } else {
                    loadPost();
                }
            });
        });
    }

    function enhanceForms() {
        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                var command = getCommand(form);
                var submitter = event.submitter;

                if (submitter && submitter.name === 'cmd') {
                    command = submitter.value;
                }

                if (isDestructiveCommand(command)) {
                    if (!hasSelectedItems(form, submitter)) {
                        event.preventDefault();
                        window.alert('Select at least one item to continue.');
                        return;
                    }

                    if (!window.confirm(
                        'This action cannot be undone. Do you want to continue?'
                    )) {
                        event.preventDefault();
                        return;
                    }
                }

                if (!event.defaultPrevented) {
                    setBusyState(form);
                }
            });
        });
    }

    function enhanceDismissibleMessages() {
        document.querySelectorAll('[data-dismissible]').forEach(function (message) {
            var close = document.createElement('button');
            close.type = 'button';
            close.className = 'message-dismiss';
            close.setAttribute('aria-label', 'Dismiss message');
            close.textContent = 'x';
            close.addEventListener('click', function () {
                message.remove();
            });
            message.appendChild(close);
        });
    }

    function enhanceUserRows() {
        document.querySelectorAll('[data-user-row]').forEach(function (row) {
            row.addEventListener('mouseenter', function () {
                row.classList.add('is-hovered');
            });
            row.addEventListener('mouseleave', function () {
                row.classList.remove('is-hovered');
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        enhanceForms();
        enhanceSelectionForms();
        enhancePostRows();
        enhanceUserRows();
        enhanceDismissibleMessages();
    });
}());
