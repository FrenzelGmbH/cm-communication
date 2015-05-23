(function ($) {
    // communication plugin
    $.communication = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.communication');
            return false;
        }
    };

    // Default settings
    var defaults = {
        listSelector: '[data-communication="list"]',
        parentSelector: '[data-communication="parent"]',
        appendSelector: '[data-communication="append"]',
        formSelector: '[data-communication="form"]',
        contentSelector: '[data-communication="content"]',
        toolsSelector: '[data-communication="tools"]',
        formGroupSelector: '[data-communication="form-group"]',
        errorSummarySelector: '[data-communication="form-summary"]',
        errorSummaryToggleClass: 'hidden',
        errorClass: 'has-error',
        offset: 0
    };

    // Edit the communication
    $(document).on('click', '[data-communication="update"]', function (evt) {
        evt.preventDefault();

        $.communication('createForm');        

        var data = $.data(document, 'communication'),
            $this = $(this),
            $append = $this.parents(data.appendSelector);

        $.ajax({
            url: $this.data('communication-fetch-url'),
            type: 'PUT',
            data: {"id" : $this.data('communication-id')},
            error: function (xhr, status, error) {
                alert(error);
            },
            success: function (response, status, xhr) {
                $append.append(response);
            }
        });
    });

    // Delete communication
    $(document).on('click', '[data-communication="delete"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'communication'),
            $this = $(this);

        if (confirm($this.data('communication-confirm'))) {
            $.ajax({
                url: $this.data('communication-url'),
                type: 'DELETE',
                error: function (xhr, status, error) {
                    alert('error');
                },
                success: function (result, status, xhr) {
                    console.log(result);
                    console.log($this.parents('[data-communication="parent"][data-communication-id="' + $this.data('communication-id') + '"]'));
                    $this.parents('[data-communication="parent"][data-communication-id="' + $this.data('communication-id') + '"]').find(data.contentSelector).text(result);
                    $this.parents(data.toolsSelector).remove();
                }
            });
        }
    });

    // AJAX updating form submit
    $(document).on('submit', '[data-communication-action="update"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'communication'),
            $this = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: $(this).serialize(),
            beforeSend: function (xhr, settings) {
                $this.find('[type="submit"]').attr('disabled', true);
            },
            complete: function (xhr, status) {
                $this.find('[type="submit"]').attr('disabled', false);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 400) {
                    $.communication('updateErrors', $this, xhr.responseJSON);
                } else {
                    alert(error);
                }
            },
            success: function (response, status, xhr) {
                $this.parents('[data-communication="parent"][data-communication-id="' + $this.data('communication-id') + '"]').html(response);
                $.communication('removeForm');
            }
        });
    });

    // AJAX create form submit
    $(document).on('submit', '[data-communication-action="create"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'communication'),
            $this = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function (xhr, settings) {
                $this.find('[type="submit"]').attr('disabled', true);
            },
            complete: function (xhr, status) {
                $this.find('[type="submit"]').attr('disabled', false);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 400) {
                    $.communication('updateErrors', $this, xhr.responseJSON);
                } else {
                    alert(error);
                }
            },
            success: function (response, status, xhr) {
                $(data.listSelector).html(response);
                $.communication('clearErrors', $this);
                $this.trigger('reset');
            }
        });
    });

    // Methods
    var methods = {
        init: function (options) {
            if ($.data(document, 'communication') !== undefined) {
                return;
            }

            // Set plugin data
            $.data(document, 'communication', $.extend({}, defaults, options || {}));

            return this;
        },
        destroy: function () {
            $(document).unbind('.communication');
            $(document).removeData('communication');
        },
        data: function () {
            return $.data(document, 'communication');
        },
        createForm: function () {
            var data = $.data(document, 'communication'),
                $form = $(data.formSelector),
                $clone = $form.clone();

            methods.removeForm();

            $clone.removeAttr('id');
            $clone.attr('data-communication', 'js-form');

            data.clone = $clone;
        },
        removeForm: function () {
            var data = $.data(document, 'communication');

            if (data.clone !== undefined) {
                $('[data-communication="js-form"]').remove();
                data.clone = undefined;
            }
        },
        scrollTo: function (id) {
            var data = $.data(document, 'communication'),
                topScroll = $('[data-communication="parent"][data-communication-id="' + id + '"]').offset().top;
            $('body, html').animate({
                scrollTop: topScroll - data.offset
            }, 500);
        },
        updateErrors: function ($form, response) {
            var data = $.data(document, 'communication'),
                message = '';

            $.each(response, function (id, msg) {
                $('#' + id).closest(data.formGroupSelector).addClass(data.errorClass);
                message += msg;
            });

            $form.find(data.errorSummarySelector).toggleClass(data.errorSummaryToggleClass).text(message);
        },
        clearErrors: function ($form) {
            var data = $.data(document, 'communication');

            $form.find('.' + data.errorClass).removeClass(data.errorClass);
            $form.find(data.errorSummarySelector).toggleClass(data.errorSummaryToggleClass).text('');
        }
    };
})(window.jQuery);