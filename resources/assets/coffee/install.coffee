window.InstallView = Backbone.View.extend
  el: "body"

  events:
    "click .wizard-next": "wizard"

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    self = this
    console.log('in install')
    Hifone.initAjax()

  wizard: (e) ->
    self = this

    _el = $(e.target)
    # Setup wizard
    $form = $('#install-form')
    current = _el.data('currentBlock')
    next = _el.data('nextBlock')
    _el.button 'loading'
    # Only validate going forward. If current group is invalid, do not go further
    if next > current
      url = '/install/step' + current
      $.post(url, $form.serializeObject()).done((response) ->
        self.goToStep current, next
        return
      ).fail((response) ->
        errors = _.toArray(response.responseJSON.errors)
        _.each errors, (error) ->
          $.notifier.notify error
          return
        return
      ).always ->
        _el.button 'reset'
        return
      return false
    else
      self.goToStep current, next
      _el.button 'reset'

  goToStep: (current, next) ->
    # validation was ok. We can go on next step.
    $('.block-' + current).removeClass('show').addClass 'hidden'
    $('.block-' + next).removeClass('hidden').addClass 'show'
    $('.steps .step').removeClass('active').filter(':lt(' + (next + 1) + ')').addClass 'active'
    return