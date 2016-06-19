window.DashboardView = Backbone.View.extend
  el: "body"

  initialize: (opts) ->
    @parentView = opts.parentView

    @initComponents()

  initComponents : ->
    self = this
    
    Hifone.initAjax()
    Hifone.initTextareaAutoResize()
    Hifone.initDeleteForm()

    self.initSortable()
    self.initSidebarToggle()


  initSidebarToggle: ->
    $('.sidebar-toggler').click (e) ->
      e.preventDefault()
      $('.wrapper').toggleClass 'toggled'
      return
    return

  initSortable: ->
    self = this
    itemList = document.getElementById('item-list')
    if itemList
      item_name = $('#item-list').data('item-name')
      new Sortable(itemList,
        group: 'omega'
        handle: '.drag-handle'
        onUpdate: ->
          orderedItemIds = $.map($('#item-list .striped-list-item'), (elem) ->
            $(elem).data 'item-id'
          )
          $.ajax
            async: true
            url: '/dashboard/api/' + item_name + '/order'
            type: 'POST'
            data: ids: orderedItemIds
            success: ->
              $.notifier.notify 'Items order has been updated.', 'success'
              return
            error: ->
              $.notifier.notify 'Items order could not be updated.', 'error'
              return
          return
      )
    return