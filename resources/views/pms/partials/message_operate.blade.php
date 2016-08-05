<div class="panel-footer operate">

  <div class="pull-left" style="font-size:15px;">

  </div>

  <div class="pull-right">
    @if ( Auth::user() && (Auth::user()->can("manage_threads") || Auth::user()->id == $thread->creator()->id) )
      <a id="thread-edit-button" href="{{ route('thread.edit', [$thread->id]) }}" title="{{ trans('forms.edit') }}" class="admin">
        <i class="fa fa-pencil-square-o"></i>
      </a>
    @endif

  </div>
  <div class="clearfix"></div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">{{ trans('hifone.appends.content') }}</h4>
      </div>

     {!! Form::open(['route' => ['thread.append', $thread->id],'method' => 'post']) !!}

        <div class="modal-body">

          <div class="alert alert-warning">
              {{ trans('hifone.appends.notice') }}
          </div>

          <div class="form-group">
            {!! Form::textarea('content', null, ['class' => 'form-control',
                                                'style' => 'min-height:20px',
                                          'placeholder' => trans('hifone.markdown_support')]) !!}

          </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('forms.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('forms.submit') }}</button>
          </div>

      {!! Form::close() !!}

    </div>
  </div>
</div>
