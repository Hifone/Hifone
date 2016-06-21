class Notifier
  constructor: ->
    @initMessenger()

  initMessenger: =>
    # Messenger config
    Messenger.options =
      extraClasses: 'messenger-fixed messenger-on-top'
      theme: 'air'
    return

  notify : (message, type, options) ->
    if _.isPlainObject(message)
        message = message.detail
    type = if typeof type == 'undefined' or type == 'error' then 'error' else type
    defaultOptions = 
      message: message
      type: type
      showCloseButton: true
    options = _.extend(defaultOptions, options)
    Messenger().post options

jQuery.notifier = new Notifier