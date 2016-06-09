
(function($){

    var original_title = document.title;
    var nCount = 0;

    window.Hifone = {
        initialize: function(){
            var self = this;

            if($('body').data('page') == 'dashboard') {
                self.dashboardBootup();
            } else if($('body').data('page') == 'install') {
                self.installBootup();
            } else {
                self.forumBootup();
            }
        },

        installBootup: function(){
            var self = this;
            self.initAjax();
            self.initMessenger();
            self.initWizard();
        },

        dashboardBootup: function(){
            var self = this;

            self.initAjax();
            self.initMessenger();
            self.initSortable();
            self.sparkLine();
            self.initDeleteForm();
            self.initChangeRole();
            self.initSidebarToggle();
        },
        /*
        * Things to be execute when normal page load
        * and pjax page load.
        */
        forumBootup: function(){
            var self = this;

            //自动读取token，为middleware做验证
            self.initPjax();

            self.initComponents();

        },

        initComponents: function(){
             var self = this;

            //自动读取token，为middleware做验证
            self.initAjax();
            self.initExternalLink();
            self.initTimeAgo();
            self.initEmoji();
            self.initAutocompleteAtUser();
            self.initScrollToTop();
            self.initTextareaAutoResize();
            self.initHighLight();
            self.initLocalStorage();
            self.initSelect2();
            self.initEditorUploader();
            self.initEditorPreview();
            self.initReplyOnPressKey();
            self.initReply2Reply();
            self.initDeleteForm();
            self.initInlineAttach();
            self.uploadAvatar();
            self.forceImageDataType();
            self.initToolTips();
            self.initCaptcha();
            self.initLightBox();
            self.initNotificationsCount();
        },

        /*------------------------------------
        *   Global section
        *-------------------------------------
        */
        initAjax: function(){

            // Ajax Setup
            $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                var token;
                if (! options.crossDomain) {
                    token = $('meta[name="token"]').attr('content');
                    if (token) {
                        jqXHR.setRequestHeader('X-CSRF-Token', token);
                    }
                }

                return jqXHR;
            });

            $.ajaxSetup({
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Accept', 'application/json');
                    // xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
                },
                /* 以免影响pjax，未登录的情况下点发帖按钮跳转到登录失败
                statusCode: {
                    401: function () {
                        window.location.href = '/';
                    },
                    403: function () {
                        window.location.href = '/';
                    }
                }
                */
            });

            // Prevent double form submission
            $('form').submit(function() {
                var $form = $(this);
                $form.find(':submit').prop('disabled', true);
            });

        },

        initMessenger: function(){
            // Messenger config
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-top',
                theme: 'air'
            };
        },

        Notifier: function () {
                this.notify = function (message, type, options) {
                if (_.isPlainObject(message)) {
                    message = message.detail;
                }
                type = (typeof type === 'undefined' || type === 'error') ? 'error' : type;

                var defaultOptions = {
                    message: message,
                    type: type,
                    showCloseButton: true
                };

                options = _.extend(defaultOptions, options);

                Messenger().post(options);
            };
        },

        /*
        * Append Delete Form
        */
        initDeleteForm: function() {
            $('[data-method]').append(function(){
                var data_url =  ($(this).attr('data-url') == undefined) ? $(this).attr('href'): $(this).attr('data-url');
                return "\n"+
                "<form action='"+data_url+"' method='POST' style='display:none'>\n"+
                "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
                "   <input type='hidden' name='_token' value='"+Config.token+"'>\n"+
                "</form>\n"
                })
                .attr('style','cursor:pointer;')
                .removeAttr('href')
                .click(function() {
                    var button = $(this);
                    if (button.attr('data-method') == 'post') {
                        button.find("form").submit();
                    }
                    if (button.attr('data-method') == 'delete' && button.hasClass('confirm-action')) {
                        swal({
                                type: "warning",
                                title: "Confirm your action",
                                text: "Are you sure you want to do this?",
                                confirmButtonText: "Yes",
                                confirmButtonColor: "#FF6F6F",
                                showCancelButton: true
                            }, function() {
                                button.find("form").submit();
                        });
                    }
                });
        },

        /*------------------------------------
        *   Install section
        *-------------------------------------
        */
        initWizard: function() {
            var self = this;
            // Setup wizard
            $('.wizard-next').on('click', function () {
                var $form   = $('#install-form'),
                    $btn    = $(this),
                    current = $btn.data('currentBlock'),
                    next    = $btn.data('nextBlock');

                $btn.button('loading');

                // Only validate going forward. If current group is invalid, do not go further
                if (next > current) {
                    var url = '/install/step' + current;
                    $.post(url, $form.serializeObject())
                        .done(function(response) {
                            self.goToStep(current, next);
                        })
                        .fail(function(response) {
                            var errors = _.toArray(response.responseJSON.errors);
                            _.each(errors, function(error) {
                                (new self.Notifier()).notify(error);
                            });
                        })
                        .always(function() {
                            $btn.button('reset');
                        });

                    return false;
                } else {
                    self.goToStep(current, next);
                    $btn.button('reset');
                }
            });
        },

        goToStep: function (current, next) {
                // validation was ok. We can go on next step.
                $('.block-' + current)
                  .removeClass('show')
                  .addClass('hidden');

                $('.block-' + next)
                  .removeClass('hidden')
                  .addClass('show');

                $('.steps .step')
                    .removeClass("active")
                    .filter(":lt(" + (next+1) + ")")
                    .addClass("active");
        },

        /*------------------------------------
        *   Dashboard section
        *-------------------------------------
        */
        initChangeRole: function() {
            $('.change-role').on('change', function(){
                console.log($(this).val());
            });
        },

        initSortable: function(){
            var self = this;
            var linkList = document.getElementById("link-list");
            if(linkList) {
                new Sortable(linkList,{
                    group: "omega",
                    handle: ".drag-handle",
                    onUpdate: function() {
                        var orderedLinkIds = $.map(
                            $('#link-list .striped-list-item'),
                            function(elem){
                                return $(elem).data('link-id');
                        });
                        $.ajax({
                            async: true,
                            url: '/dashboard/api/links/order',
                            type: 'POST',
                            data:{ids: orderedLinkIds},
                            success: function(){
                                 (new self.Notifier()).notify("Links order has been updated.",'success');
                            },
                            error: function(){
                                (new self.Notifier()).notify("Links order could not be updated.",'error');
                            }
                        });
                    }
                });
            }
        },

        initSidebarToggle: function() {
             $(".sidebar-toggler").click(function(e) {
                e.preventDefault();
                $(".wrapper").toggleClass("toggled");
            });
        },

        sparkLine: function () {
            $('.sparkline').each(function () {
                var data = $(this).data();
                data.valueSpots = {
                    '0:': data.spotColor
                };

                $(this).sparkline(data.data, data);
                var composite = data.compositedata;

                if (composite) {
                    var stlColor = $(this).attr("data-stack-line-color"),
                        stfColor = $(this).attr("data-stack-fill-color"),
                        sptColor = $(this).attr("data-stack-spot-color"),
                        sptRadius = $(this).attr("data-stack-spot-radius");

                    $(this).sparkline(composite, {
                        composite: true,
                        lineColor: stlColor,
                        fillColor: stfColor,
                        spotColor: sptColor,
                        highlightSpotColor: sptColor,
                        spotRadius: sptRadius,
                        valueSpots: {
                            '0:': sptColor
                        }
                    });
                };
            });
        },


        /*------------------------------------
        *   Forum section
        *-------------------------------------
        */
        initPjax: function(){
            var self = this;
            $(document).pjax('a:not(a[target="_blank"],a[data-pjax="no"])', '.forum');
                $(document).on('pjax:start', function() {
                    NProgress.start();
                });
                $(document).on('pjax:end', function() {
                    NProgress.done();
                    self.initComponents();
                });
                $(document).on('pjax:complete', function() {
                    original_title = document.title;
                    NProgress.done();
                    self._resetTitle();
                });
        },


        /**
        * Init select2
        */

        initSelect2: function(){
            $('.selectpicker').select2({
                placeholder: '请选择节点',
                theme: "classic"
            });
        },
        /**
         * Open External Links In New Window
         */
        initExternalLink: function(){
            $('a[href^="http://"], a[href^="https://"]').each(function() {
               var a = new RegExp('/' + window.location.host + '/');
               if(!a.test(this.href) ) {
                   $(this).click(function(event) {
                       event.preventDefault();
                       event.stopPropagation();
                       window.open(this.href, '_blank');
                   });
               }
            });
        },

        /**
         * Automatically transform any Date format to human
         * friendly format, all you need to do is add a
         * `.timeago` class.
         */
        initTimeAgo: function(){
            moment.locale('zh-cn');
            $('.timeago').each(function(){
                var time_str = $(this).text();
                if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
                    $(this).text(moment(time_str).fromNow());
                }
            });
        },

        /**
         * Enable emoji everywhere.
         */
        initEmoji: function(){
            emojify.setConfig({
                img_dir : Config.cdnDomain + '/assets/images/emoji',
                ignored_tags : {
                    'SCRIPT'  : 1,
                    'TEXTAREA': 1,
                    'A'       : 1,
                    'PRE'     : 1,
                    'CODE'    : 1
                }
            });
            emojify.run();

            $('#body_field').textcomplete([
                { // emoji strategy
                    match: /\B:([\-+\w]*)$/,
                    search: function (term, callback) {
                        callback($.map(emojies, function (emoji) {
                            return emoji.indexOf(term) === 0 ? emoji : null;
                        }));
                    },
                    template: function (value) {
                        return '<img src="' + Config.cdnDomain + '/assets/images/emoji/' + value + '.png"></img>' + value;
                    },
                    replace: function (value) {
                        return ':' + value + ': ';
                    },
                    index: 1,
                    maxCount: 5
                }
            ]);
        },

        /**
         * Autocomplete @user
         */
        initAutocompleteAtUser: function() {
            var at_users = [],
                  user;
            $users = $('.media-heading').find('a.author');
            for (var i = 0; i < $users.length; i++) {
                user = $users.eq(i).text().trim();
                if ($.inArray(user, at_users) == -1) {
                    at_users.push(user);
                };
            };

            $('textarea').textcomplete([{
                mentions: at_users,
                match: /\B@(\w*)$/,
                search: function(term, callback) {
                    callback($.map(this.mentions, function(mention) {
                        return mention.indexOf(term) === 0 ? mention : null;
                    }));
                },
                index: 1,
                replace: function(mention) {
                    return '@' + mention + ' ';
                }
            }], {
                appendTo: 'body'
            });

        },

        /**
         * Autoresizing the textarea when you typing.
         */
        initTextareaAutoResize: function(){
            $('textarea').autosize();
        },

        /**
         * Scroll to top in one click.
         */
        initScrollToTop: function(){
            $.scrollUp.init();
        },

        /**
         * Code highlight.
         */
        initHighLight: function(){
            Prism.highlightAll();
        },

        /**
         * lightbox
         */
        initLightBox: function(){
            $(document).delegate('.content-body img:not(.emoji)', 'click', function(event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function() {
                        if (window.console) {
                            // return console.log('Checking our the events huh?');
                        }
                    }
                });
            });
        },

        /**
         * Init post content preview
         */
        initEditorPreview: function() {
            var self = this;

            $('.insert-codes a').on('click',function(){
                return self.appendCodesFromHint($(this));
            });
     
            self.hookPreview($(".editor-toolbar"), $(".topic-editor"));
        },

        initEditorUploader: function() {
            var self = this;
            /**
             * Upload attachment
             */
            $('#btn-upload').click(function() {
                $('.input-file').click();
            });

            $('.input-file').change(function() {
                var $form = $('.create_form');
                var formData = new FormData($form[0]);
                var progressText = '![Uploading file...]()';
                var urlText = "![file]({filename})";
                var filenameTag = '{filename}';
                var txtBox = $(".topic-editor");

                $.ajax({
                    url: Config.routes.upload_image,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#btn-upload').attr('disabled', 'disabled');
                        txtBox.val(txtBox.val() + progressText);
                    },
                    success: function (result) {
                        var text = txtBox.val().replace(progressText, urlText.replace(filenameTag, result.filename));
                        txtBox.val(text);
                    },
                    error: function (err) {
                        var text = txtBox.val().replace(progressText, "");
                        txtBox.val(text);
                    },
                    complete: function() {
                        $('#btn-upload').removeAttr('disabled');
                    }
                }, 'json');
                console.log(formData);
                return false;
            });

        },

        /**
         * Notify user unread notifications when they stay on the
         *
         */
        initNotificationsCount: function() {
            var self = this;

            if (Config.user_id > 0) {
                function scheduleGetNotification(){
                    $.get( Config.routes.notification_count, function( data ) {

                        nCount = parseInt(data);
                        self._resetTitle();
                        setTimeout(scheduleGetNotification, 15000);
                    });
                };
                setTimeout(scheduleGetNotification, 15000);
            }
        },

        _resetTitle: function() {
            if (nCount > 0) {
                $('.notification-count').html('<i class="fa fa-bell"></i> ' + nCount);
                $('.notification-count').hasClass('new') || $('.notification-count').addClass('new');
                document.title = '(' + nCount + ') '+ original_title;
            } else {
                document.title =  original_title;
                $('.notification-count').html('<i class="fa fa-bell"></i>  0' );
                $('.notification-count').removeClass('new');
            }
        },

        /*
         * Use Ctrl + Enter for reply
         */
        initReplyOnPressKey: function() {
            $(document).on("keydown", "#body_field", function(e)
            {
                if ((e.keyCode == 10 || e.keyCode == 13) && e.ctrlKey) {
                    $(this).parents("form").submit();
                    return false;
                }
            });
        },

        /**
         * Local Storage
         */
        initLocalStorage: function() {
            var self = this;
            $("#body_field").focus(function(event) {

                // Thread ON Thread Creation View
                localforage.getItem('thread_title', function(err, value) {
                    if ($('#thread_create_form #thread_title').val() == '' && !err) {
                        $('#thread_create_form #thread_title').val(value);
                    };
                });
                $('#thread_create_form #thread_title').keyup(function(){
                    localforage.setItem('thread_title', $(this).val());
                });

                localforage.getItem('thread_create_body', function(err, value) {
                    if ($('#thread_create_form #body_field').val() == '' && !err) {
                        $('#thread_create_form #body_field').val(value);
                    }
                });
                $('#thread_create_form #body_field').keyup(function(){
                    localforage.setItem('thread_create_body', $(this).val());
                });

                // Reply ON Thread Details View
                localforage.getItem('reply_create_body', function(err, value) {
                    if ($('#reply_create_form #body_field').val() == '' && !err) {
                        $('#reply_create_form #body_field').val(value);
                    }
                });
                $('#reply_create_form #body_field').keyup(function(){
                    localforage.setItem('reply_create_body', $(this).val());
                });
            });

            // Clear Local Storage on submit
            $("#thread_create_form").submit(function(event){
                localforage.removeItem('thread_create_body');
                localforage.removeItem('thread_title');
            });
            // Clear Local Storage on submit
            $("#reply_create_form").submit(function(event){
                localforage.removeItem('reply_create_body');
            });
        },

        /**
         * Upload image
         */
        initInlineAttach: function() {
            var self = this;
            $('#body_field').inlineattach({
                uploadUrl: Config.routes.upload_image,
                extraParams: {
                  '_token': Config.token,
                },
                onUploadedFile: function(response) {
                    //
                },
            });
        },

        preview: function(body) {
            $("#preview-box").text("Loading...");

            var replyContent = $("#body_field");

            var oldContent = replyContent.val();

            if (oldContent) {
                marked(oldContent, function (err, content) {
                  $('#preview-box').html(content);
                  emojify.run(document.getElementById('preview-box'));
                });
            }
        },
        hookPreview: function(switcher, textarea) {
            var preview_box;
            self = this;
            preview_box = $(document.createElement("div")).attr("id", "preview-box");
            preview_box.addClass("box preview markdown-reply");
            $(textarea).after(preview_box);
            preview_box.hide();
            $(".edit a", switcher).click(function() {
              $(".preview", switcher).removeClass("active");
              $(this).parent().addClass("active");
              $(preview_box).hide();
              $(textarea).show();
              $('.status-post-submit').show();
              $('#editor-toolbar-insert-code').show();
              return false;
            });
            return $(".preview a", switcher).click(function() {
              $(".edit", switcher).removeClass("active");
              $(this).parent().addClass("active");
              $(preview_box).show();
              $(textarea).hide();
              $('.status-post-submit').hide();
              $('#editor-toolbar-insert-code').hide();
              self.preview($(textarea).val());
              return false;
            });
        },

        appendCodesFromHint: function(link) {
            var before_text, caret_pos, language, prefix_break, source, src_merged, txtBox;
            language = link.data("lang");
            txtBox = $(".topic-editor");
            caret_pos = txtBox.caret();
            prefix_break = "";
            if (txtBox.val().length > 0) {
              prefix_break = "\n";
            }
            src_merged = prefix_break + "```" + language + "\n\n```\n";
            source = txtBox.val();
            before_text = source.slice(0, caret_pos);
            txtBox.val(before_text + src_merged + source.slice(caret_pos + 1, source.count));
            txtBox.caret(caret_pos + src_merged.length - 5);
            txtBox.focus();
            txtBox.trigger('click');
            return false;
        },
        /**
         * Upload avatar of user
         */
        uploadAvatar: function() {

            $('.upload-btn').on('click',function(){
                $('#avatarinput').click();
            });
            //upload avatar
            $('#avatarinput').change(function () {
                $('#avatarinput-submit').click();
            });

        },

        initCaptcha: function() {
            var captchaImg = $('.captcha_img');
            captchaImg.attr('style','cursor:pointer;')
            .on('click', function(){
                captchaImg.attr('src', "/captcha?random=" + Math.random());
            });
        },

        /**
         * Force image data type, fixing the "Could not detect remote target type..."
         * problem.
         */
        forceImageDataType: function() {
          $('.content-body img:not(.emoji)').each(function(){
              $(this).attr('data-type', 'image').attr('data-remote', $(this).attr('src'));
          });
        },

        initToolTips: function() {
          $('[data-toggle="tooltip"]').tooltip();
        },

        initReply2Reply: function() {
            $('.btn-reply2reply').on('click', function(){
                var button = $(this);
                var username = button.attr('data-username');
                replyContent = $("#body_field");
                oldContent = replyContent.val();
                prefix = "@" + username + " ";
                newContent = ''
                if(oldContent.length > 0){
                    if (oldContent != prefix) {
                        newContent = oldContent + "\n" + prefix;
                    }
                } else {
                    newContent = prefix
                }
                replyContent.focus();
                replyContent.val(newContent);
                self._moveEnd($("#body_field"));
            });
        },

        _moveEnd: function(obj){
          obj.focus();

          var len = obj.value === undefined ? 0 : obj.value.length;

          if (document.selection) {
            var sel = obj.createTextRange();
            sel.moveStart('character',len);
            sel.collapse();
            sel.select();
          } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
            obj.selectionStart = obj.selectionEnd = len;
          }
        },
    }
    
})(jQuery);

$(document).ready(function()
{
    Hifone.initialize();
});