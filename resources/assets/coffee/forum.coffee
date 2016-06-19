window.ForumView = Backbone.View.extend
  el: "body"
  currentPageImageURLs : []
  clearHightTimer: null

  events:
    "click a.likeable": "likeable"
    "click a.captcha-image-box": "reLoadCaptchaImage"
    "click a.btn-reply2reply": "reply2reply"

  initialize: (opts) ->
    @parentView = opts.parentView

    @initPjax()
    @initComponents()

  initComponents : ->
    self = this

    Hifone.initAjax()
    Hifone.initTextareaAutoResize()
    Hifone.initDeleteForm()

    self.initScrollToTop()
    self.forceImageDataType()
    self.initLightBox()
    self.initEmoji()
    
    self.initExternalLink()
    self.initToolTips()
    self.initHighLight()
    self.initTimeAgo()

    self.initNotificationsCount()

    self.initSelect2()
    self.initInlineAttach()
    self.initEditorUploader()
    self.initAutocompleteAtUser()
    self.initEditorPreview()
    self.initLocalStorage()

    self.uploadAvatar()

  initPjax : ->
      self = this
      $(document).pjax 'a:not(a[target="_blank"],a[data-pjax="no"])', '.forum'
      $(document).on 'pjax:start', ->
        NProgress.start()
        return
      $(document).on 'pjax:end', ->
        NProgress.done()
        self.initComponents()
        console.log('in pjax')
        return
      $(document).on 'pjax:complete', ->
        original_title = document.title
        NProgress.done()
        self.resetTitle(0)
        return
      return

  resetTitle :(nCount) ->
    console.log('_resetTitle ' + nCount)
    if nCount > 0
        $('.notification-count').html '<i class="fa fa-bell"></i> ' + nCount
        $('.notification-count').hasClass('new') or $('.notification-count').addClass('new')
    else
        $('.notification-count').html '<i class="fa fa-bell"></i>'
        $('.notification-count').removeClass 'new'
    return

  initScrollToTop : ->
    $.scrollUp.init()

  initSelect2 : ->
    $('.selectpicker').select2
      theme: 'classic'
    return

# Open External Links In New Window
  initExternalLink: ->
    $('a[href^="http://"], a[href^="https://"]').each ->
      a = new RegExp('/' + window.location.host + '/')
      if !a.test(@href)
        $(this).click (event) ->
          event.preventDefault()
          event.stopPropagation()
          window.open @href, '_blank'
          return
      return
    return

  forceImageDataType: ->
    $('.content-body img:not(.emoji)').each ->
      $(this).attr('data-type', 'image').attr 'data-remote', $(this).attr('src')
      return
    return

  initLightBox : ->
    $('.content-body').delegate 'img:not(.emoji)', 'click', (event) ->
      event.preventDefault()
      $(this).ekkoLightbox onShown: ->
        console.log('Checking our the events huh?');
    return

  initEmoji: ->
    emojify.setConfig
      img_dir: Hifone.Config.emoj_cdn + '/assets/images/emoji'
      ignored_tags:
        'SCRIPT': 1
        'TEXTAREA': 1
        'A': 1
        'PRE': 1
        'CODE': 1
    emojify.run()
    $('#body_field').textcomplete [ {
      match: /\B:([\-+\w]*)$/
      search: (term, callback) ->
        callback $.map(emojies, (emoji) ->
          if emoji.indexOf(term) == 0 then emoji else null
        )
        return
      template: (value) ->
        '<img src="' + Hifone.Config.emoj_cdn + '/assets/images/emoji/' + value + '.png"></img>' + value
      replace: (value) ->
        ':' + value + ': '
      index: 1
      maxCount: 5
    } ]
    return

  initHighLight: ->
    Prism.highlightAll()
    return

  initToolTips: ->
    $('[data-toggle="tooltip"]').tooltip()
    return

  initInlineAttach: ->
    $('#body_field').inlineattach
      uploadUrl: Hifone.Config.uploader_url
      extraParams: '_token': Hifone.Config.token
      onUploadedFile: (response) ->
        #
        return
    return

  initTimeAgo: ->
    moment.locale 'zh-cn'
    $('.timeago').each ->
      time_str = $(this).text()
      if moment(time_str, 'YYYY-MM-DD HH:mm:ss', true).isValid()
        $(this).text moment(time_str).fromNow()
      return
    return

  initNotificationsCount: ->
    self = this
    if Hifone.Config.current_user_id > 0
      $.get Hifone.Config.notification_url, (data) ->
        nCount = parseInt(data)
        self.resetTitle(nCount)
        return
    return

  initEditorUploader: ->
    self = this
    $('.btn-upload').click ->
      $('.input-file').click()
      return
    $('.input-file').change ->
      $form = $('.create_form')
      formData = new FormData($form[0])
      progressText = '![Uploading file...]()'
      urlText = '![file]({filename})'
      filenameTag = '{filename}'
      txtBox = $('.post-editor')
      $.ajax {
        url: Hifone.Config.uploader_url
        type: 'POST'
        data: formData
        cache: false
        contentType: false
        processData: false
        beforeSend: ->
          $('.btn-upload').attr 'disabled', 'disabled'
          self._caretPos txtBox, progressText, 0
          return
        success: (result) ->
          text = txtBox.val().replace(progressText, urlText.replace(filenameTag, result.filename))
          txtBox.val text
          return
        error: (err) ->
          text = txtBox.val().replace(progressText, '')
          txtBox.val text
          return
        complete: ->
          $('.btn-upload').removeAttr 'disabled'
          return

      }, 'json'
      false
    return

  initEditorPreview: ->
    self = this
    $('.insert-codes a').on 'click', ->
      self.appendCodesFromHint $(this)
    self.hookPreview $('.editor-toolbar'), $('.post-editor')
    return

  initAutocompleteAtUser: ->
    at_users = []
    user = undefined
    $users = $('.media-heading').find('a.author')
    i = 0
    while i < $users.length
      user = $users.eq(i).text().trim()
      if $.inArray(user, at_users) == -1
        at_users.push user
      i++
    $('textarea').textcomplete [ {
      mentions: at_users
      match: /\B@(\w*)$/
      search: (term, callback) ->
        callback $.map(@mentions, (mention) ->
          if mention.indexOf(term) == 0 then mention else null
        )
        return
      index: 1
      replace: (mention) ->
        '@' + mention + ' '

    } ], appendTo: 'body'
    return

  preview: (body) ->
    $('#preview-box').text 'Loading...'
    replyContent = $('#body_field')
    oldContent = replyContent.val()
    if oldContent
      marked oldContent, (err, content) ->
        $('#preview-box').html content
        emojify.run document.getElementById('preview-box')
        return
    return

  hookPreview: (switcher, textarea) ->
    self = this
    preview_box = $(document.createElement('div')).attr('id', 'preview-box')
    preview_box.addClass 'box preview markdown-reply'
    $(textarea).after preview_box
    preview_box.hide()
    $('.edit a', switcher).click ->
      $('.preview', switcher).removeClass 'active'
      $(this).parent().addClass 'active'
      $(preview_box).hide()
      $(textarea).show()
      $('.status-post-submit').show()
      $('#editor-toolbar-insert-code').show()
      $('.btn-upload').show()
      false
    $('.preview a', switcher).click ->
      $('.edit', switcher).removeClass 'active'
      $(this).parent().addClass 'active'
      $(preview_box).show()
      $(textarea).hide()
      $('.status-post-submit').hide()
      $('#editor-toolbar-insert-code').hide()
      $('.btn-upload').hide()
      self.preview $(textarea).val()
      false

  appendCodesFromHint: (link) ->
    self = this
    before_text = undefined
    caret_pos = undefined
    language = undefined
    prefix_break = undefined
    source = undefined
    src_merged = undefined
    txtBox = undefined
    language = link.data('lang')
    txtBox = $('.post-editor')
    merged_txt = '\n```' + language + '\n\n```'
    self._caretPos txtBox, merged_txt, 5
    txtBox.focus()
    txtBox.trigger 'click'
    false

  _caretPos: (txtBox, merged_txt, pos) ->
    caret_pos = txtBox.caret()
    src_merged = merged_txt + '\n'
    source = txtBox.val()
    before_text = source.slice(0, caret_pos)
    txtBox.val before_text + src_merged + source.slice(caret_pos + 1, source.count)
    txtBox.caret caret_pos + src_merged.length - pos
    return

  initLocalStorage: ->
    console.log('call initLocalStorage')
    $('#body_field').focus (event) ->
      # Thread ON Thread Creation View
      localforage.getItem 'thread_title', (err, value) ->
        if $('#thread_create_form #thread_title').val() == '' and !err
          $('#thread_create_form #thread_title').val value
        return
      $('#thread_create_form #thread_title').keyup ->
        localforage.setItem 'thread_title', $(this).val()
        return
      localforage.getItem 'thread_create_body', (err, value) ->
        if $('#thread_create_form #body_field').val() == '' and !err
          $('#thread_create_form #body_field').val value
        return
      $('#thread_create_form #body_field').keyup ->
        localforage.setItem 'thread_create_body', $(this).val()
        return
      # Reply ON Thread Details View
      localforage.getItem 'reply_create_body', (err, value) ->
        if $('#reply_create_form #body_field').val() == '' and !err
          $('#reply_create_form #body_field').val value
        return
      $('#reply_create_form #body_field').keyup ->
        localforage.setItem 'reply_create_body', $(this).val()
        return
      return
    # Clear Local Storage on submit
    $('#thread_create_form').submit (event) ->
      localforage.removeItem 'thread_create_body'
      localforage.removeItem 'thread_title'
      return
    # Clear Local Storage on submit
    $('#reply_create_form').submit (event) ->
      localforage.removeItem 'reply_create_body'
      return
    return

  reply2reply: (e) ->
    _el = $(e.target)
    username = _el.data('username')
    replyContent = $('#body_field')
    oldContent = replyContent.val()
    prefix = '@' + username + ' '
    newContent = ''
    if oldContent.length > 0
      if oldContent != prefix
        newContent = oldContent + '\n' + prefix
    else
      newContent = prefix
    replyContent.focus()
    replyContent.val newContent

  uploadAvatar: ->
    $('.upload-btn').on 'click', ->
      $('#avatarinput').click()
      return
    #upload avatar
    $('#avatarinput').change ->
      $('#avatarinput-submit').click()
      return
    return

  likeable : (e) ->
    if !Hifone.isLogined()
      location.href = "/auth/login"
      return false

    $target = $(e.currentTarget)
    likeable_type = $target.data("type")
    likeable_id = $target.data("id")
    likes_count = parseInt($target.data("count"))

    $el = $(".likeable[data-type='#{likeable_type}'][data-id='#{likeable_id}']")

    if $el.data("state") != "active"
      $.ajax
        url : "/like"
        type : "POST"
        data :
          type : likeable_type
          id : likeable_id

      likes_count += 1
      $el.data('count', likes_count)
      @likeableAsLiked($el)
      $("i.fa", $el).attr("class","fa fa-heart")
    else
      $.ajax
        url : "/like/#{likeable_id}"
        type : "DELETE"
        data :
          type : likeable_type
      if likes_count > 0
        likes_count -= 1
      $el.data("state","").data('count', likes_count).attr("title", "").removeClass("active")
      if likes_count == 0
        $('span', $el).text("")
      else
        $('span', $el).text("#{likes_count} 个赞")
      $("i.fa", $el).attr("class","fa fa-heart-o")
    false

  likeableAsLiked : (el) ->
    likes_count = el.data("count")
    el.data("state","active").attr("title", "取消赞").addClass("active")
    $('span',el).text("#{likes_count} 个赞")
    $("i.fa",el).attr("class","fa fa-heart")

  reLoadCaptchaImage: (e) ->
    btn = $(e.currentTarget)
    img = btn.find('img:first')
    currentSrc = img.attr('src')
    img.attr('src', currentSrc.split('?')[0] + '?' + (new Date()).getTime())
    return false
