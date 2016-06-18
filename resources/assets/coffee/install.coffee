window.InstallView = Backbone.View.extend
  el: "body"

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    self = this
    console.log('in install')
    App.initAjax()
    App.initMessenger()
    self.initWizard()

  initWizard: ->
    self = this
    # Setup wizard
    $('.wizard-next').on 'click', ->
      $form = $('#install-form')
      $btn = $(this)
      current = $btn.data('currentBlock')
      next = $btn.data('nextBlock')
      $btn.button 'loading'
      # Only validate going forward. If current group is invalid, do not go further
      if next > current
        url = '/install/step' + current
        $.post(url, $form.serializeObject()).done((response) ->
          self.goToStep current, next
          return
        ).fail((response) ->
          errors = _.toArray(response.responseJSON.errors)
          _.each errors, (error) ->
            (new (App.Notifier)).notify error
            return
          return
        ).always ->
          $btn.button 'reset'
          return
        return false
      else
        self.goToStep current, next
        $btn.button 'reset'
      return
    return

  goToStep: (current, next) ->
    # validation was ok. We can go on next step.
    $('.block-' + current).removeClass('show').addClass 'hidden'
    $('.block-' + next).removeClass('hidden').addClass 'show'
    $('.steps .step').removeClass('active').filter(':lt(' + next + 1 + ')').addClass 'active'
    return