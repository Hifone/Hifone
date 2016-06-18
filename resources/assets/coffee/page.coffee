window.PageView = Backbone.View.extend
  el: "body"
  events:
    "click .editor-toolbar .edit a": "toggleEditView"
    "click .editor-toolbar .preview a": "togglePreviewView"

  initialize: (opts) ->
    @parentView = opts.parentView
    $("<div id='preview' class='markdown form-control'></div>").insertAfter( $('#page_body') )

  toggleEditView: (e) ->
    $(e.target).parent().addClass('active')
    $('.preview a').parent().removeClass('active')
    $('#preview').hide()
    $('#page_body').show()
    false

  togglePreviewView: (e) ->
    $(e.target).parent().addClass('active')
    $('.edit a').parent().removeClass('active')
    $('#preview').html('Loading...')
    $('#page_body').hide()
    $('#preview').show()
    $.post '/wiki/preview', {body: $('#page_body').val()}, (data)->
      $('#preview').html(data)
      false
    false