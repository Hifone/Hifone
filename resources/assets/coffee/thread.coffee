window.ThreadView = Backbone.View.extend
  el: "body"
  currentPageImageURLs : []
  clearHightTimer: null

  events:
    "click #replies .reply .btn-reply": "reply"

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    $("textarea.topic-editor").unbind "keydown.cr"

  reply : ->
    # do nothing

