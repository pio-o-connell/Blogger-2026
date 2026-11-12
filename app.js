(function () {
    'use strict';

    function getCommand(form) {
        var command = form.querySelector('input[name="cmd"]');
        return command ? command.value : '';
    }

    function isDestructiveCommand(command) {
        return [
            'delete1',
            'deletePosts',
            'delete2',
            'deleteComment',
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
                    submit.textContent = 'Create/Edit Post';
                } else {
                    submit.value = 'Create/Edit Post';
                }
                editor.dataset.originalTitle = row.dataset.postTitle;
                editor.dataset.originalBody = row.dataset.postBody;
                var indicator = editor.querySelector('[data-unsaved-indicator]');
                if (indicator) {
                    indicator.hidden = true;
                }
                var list = row.closest('.delete-blog-list');
                if (list) {
                    list.querySelectorAll('[data-post-row]').forEach(
                        function (otherRow) {
                            otherRow.classList.toggle(
                                'is-selected',
                                otherRow === row
                            );
                        }
                    );
                }
                editor.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            row.querySelectorAll('[data-edit-post]').forEach(function (button) {
                button.addEventListener('click', function () {
                    if (button.disabled) {
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
                    if (command !== 'deleteComment' &&
                        !hasSelectedItems(form, submitter)) {
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

    function enhancePostEditor() {
        document.querySelectorAll('[data-post-editor]').forEach(function (editor) {
            var title = editor.querySelector('input[name="blogtitle"]');
            var body = editor.querySelector('textarea[name="textarea"]');
            var cancel = editor.querySelector('[data-cancel-edit]');
            var indicator = editor.querySelector('[data-unsaved-indicator]');

            function updateDirtyState() {
                if (indicator) {
                    indicator.hidden =
                        title.value === (editor.dataset.originalTitle || '') &&
                        body.value === (editor.dataset.originalBody || '');
                }
            }

            title.addEventListener('input', updateDirtyState);
            body.addEventListener('input', updateDirtyState);
            if (cancel) {
                cancel.addEventListener('click', function () {
                    title.value = editor.dataset.originalTitle || '';
                    body.value = editor.dataset.originalBody || '';
                    updateDirtyState();
                });
            }

        });
    }

    function enhanceCommentEditors() {
        document.querySelectorAll('[data-comment-revert]').forEach(
            function (revert) {
                var form = revert.closest('form');
                var editor = form
                    ? form.querySelector('[data-comment-editor]')
                    : null;

                if (!editor) {
                    return;
                }

                revert.addEventListener('click', function () {
                    editor.value = editor.dataset.originalBody || '';
                    editor.dispatchEvent(new Event('input', {
                        bubbles: true
                    }));
                    editor.focus();
                });
            }
        );
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

    function enhanceMobileNavigation() {
        document.querySelectorAll('.menu-toggle').forEach(function (toggle) {
            var menu = document.getElementById(toggle.getAttribute('aria-controls'));

            if (!menu) {
                return;
            }

            toggle.addEventListener('click', function () {
                var expanded = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!expanded));
                menu.classList.toggle('is-open', !expanded);
            });

            menu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    toggle.setAttribute('aria-expanded', 'false');
                    menu.classList.remove('is-open');
                });
            });
        });
    }

    function enhancePersonalBlogTabs() {
        document.querySelectorAll('.personal-blog-tabs').forEach(
            function (tabList) {
                var tabs = Array.prototype.slice.call(
                    tabList.querySelectorAll('.tab')
                );
                var main = tabList.closest('#main');

                if (!tabs.length || !main) {
                    return;
                }

                tabs.forEach(function (tab) {
                    tab.addEventListener('click', function () {
                        var target = tab.dataset.tab;

                        tabs.forEach(function (currentTab) {
                            var active = currentTab === tab;
                            currentTab.classList.toggle('is-active', active);
                            currentTab.setAttribute(
                                'aria-selected',
                                String(active)
                            );
                        });

                        main.querySelectorAll('.tab-panel').forEach(
                            function (panel) {
                                panel.classList.toggle(
                                    'is-active',
                                    panel.dataset.panel === target
                                );
                            }
                        );
                    });
                });
            }
        );
    }

    function enhanceContentPaneAccordions() {
        document.querySelectorAll('#main').forEach(function (main) {
            var panes = Array.prototype.slice.call(
                main.querySelectorAll(
                    ':scope > #content, :scope > #bloggerlist, ' +
                    ':scope > .previous-posts'
                )
            );

            if (panes.length !== 2) {
                return;
            }

            panes.sort(function (left, right) {
                var leftIsPrimary = left.id === 'content' ||
                    left.classList.contains('previous-posts');
                var rightIsPrimary = right.id === 'content' ||
                    right.classList.contains('previous-posts');
                return leftIsPrimary && !rightIsPrimary
                    ? -1
                    : rightIsPrimary && !leftIsPrimary ? 1 : 0;
            });

            panes.forEach(function (pane, paneIndex) {
                var originalPaneId = pane.id || 'pane-' + paneIndex;
                var button = document.createElement('button');
                var isPrimary = originalPaneId === 'content' ||
                    pane.classList.contains('previous-posts');
                var selectedPost = pane.querySelector('.selected-post-title');
                var heading = pane.querySelector('h1, h2');
                var label;

                if (selectedPost) {
                    label = 'Comments for: ' + selectedPost.textContent.trim();
                } else if (pane.classList.contains('previous-posts')) {
                    label = 'Previous posts and comments';
                } else if (isPrimary && heading) {
                    label = heading.textContent.trim();
                } else if (originalPaneId === 'bloggerlist') {
                    label = 'Blog list';
                } else {
                    label = 'Current Selected Blog';
                }

                pane.classList.add('accordion-pane');
                pane.dataset.accordionPane = '';
                pane.dataset.originalPaneId = originalPaneId;
                button.type = 'button';
                button.className = 'accordion-control';
                button.textContent = label;
                button.setAttribute('aria-controls', originalPaneId);
                button.setAttribute('aria-expanded', paneIndex === 0
                    ? 'true'
                    : 'false');

                pane.insertBefore(button, pane.firstChild);
                pane.classList.toggle('is-collapsed', paneIndex !== 0);

                button.addEventListener('click', function () {
                    var expanded = button.getAttribute('aria-expanded') === 'true';
                    var otherPane = panes[paneIndex === 0 ? 1 : 0];
                    var otherExpanded = otherPane.querySelector(
                        '.accordion-control'
                    ).getAttribute('aria-expanded') === 'true';

                    if (expanded && !otherExpanded) {
                        return;
                    }

                    button.setAttribute('aria-expanded', String(!expanded));
                    pane.classList.toggle('is-collapsed', expanded);
                });
            });
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
        enhancePostRows();
        enhancePostEditor();
        enhanceCommentEditors();
        enhanceUserRows();
        enhanceDismissibleMessages();
        enhanceMobileNavigation();
        enhancePersonalBlogTabs();
        enhanceContentPaneAccordions();
    });
}());
