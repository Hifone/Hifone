AppView = Backbone.View.extend
  el: "body"
  repliesPerPage: 50
  windowInActive: true

  events:
    "click a.likeable": "likeable"
    "click a.captcha-image-box": "reLoadCaptchaImage"

  initialize: ->
    @initComponents()

    if $('body').data('controller-name') in ['thread', 'reply']
      window._threadView = new ThreadView({parentView: @})

    if $('body').data('controller-name') in ['page']
      window._pageView = new PageView({parentView: @})

  initComponents: () ->
    #$("abbr.timeago").timeago()
    $(".alert").alert()
    $('.dropdown-toggle').dropdown()
    $('.bootstrap-select').remove()

    # 绑定评论框 Ctrl+Enter 提交事件
    $(".cell_comments_new textarea").unbind "keydown"
    $(".cell_comments_new textarea").bind "keydown", "ctrl+return", (el) ->
      if $(el.target).val().trim().length > 0
        $(el.target).parent().parent().submit()
      return false

    $(window).off "blur.inactive focus.inactive"
    $(window).on "blur.inactive focus.inactive", @updateWindowActiveState

  likeable : (e) ->
    if !App.isLogined()
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

  updateWindowActiveState: (e) ->
    prevType = $(this).data("prevType")

    if prevType != e.type
      switch (e.type)
        when "blur"
          @windowInActive = false
        when "focus"
          @windowInActive = true

    $(this).data("prevType", e.type)

window.App =
  locale: 'zh-CN'
  notifier : null
  current_user_id: null
  access_token : ''
  asset_url : ''
  twemoji_url: 'https://twemoji.maxcdn.com/'
  root_url : ''

  isLogined : ->
    App.current_user_id != null

  loading : () ->
    console.log "loading..."

  fixUrlDash : (url) ->
    url.replace(/\/\//g,"/").replace(/:\//,"://")

  # 警告信息显示, to 显示在那个dom前(可以用 css selector)
  alert : (msg,to) ->
    $(".alert").remove()
    $(to).before("<div class='alert alert-warning'><a class='close' href='#' data-dismiss='alert'>X</a>#{msg}</div>")

  # 成功信息显示, to 显示在那个dom前(可以用 css selector)
  notice : (msg,to) ->
    $(".alert").remove()
    $(to).before("<div class='alert alert-success'><a class='close' data-dismiss='alert' href='#'>X</a>#{msg}</div>")

  openUrl : (url) ->
    window.open(url)

  # scan logins in jQuery collection and returns as a object,
  # which key is login, and value is the name.
  scanLogins: (query) ->
    result = {}
    for e in query
      $e = $(e)
      result[$e.text()] = $e.attr('data-name')
    result

$ ->
  window._appView = new AppView()
