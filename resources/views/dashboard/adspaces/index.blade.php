@extends('layouts.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="ion ion-ios-information-outline"></i> {{ trans('dashboard.adspaces.adspaces') }}
                </span>
                <a class="btn btn-sm btn-success pull-right" href="{{ route('dashboard.adspace.create') }}">
                    {{ trans('dashboard.adspaces.add.title') }}
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @include('partials.errors')
                    <div class="striped-list">
                        @foreach($adspaces as $adspace)
                        <div class="row striped-list-item">
                            <div class="col-xs-6">
                                <i class="{{ $adspace->icon }}"></i> {{ $adspace->id }}. {{ $adspace->name }}
                                @if($adspace->adblock)
                                <p>(<small>{{ $adspace->adblock->name }}</small>)</p>
                                @endif
                            </div>
                            <div class="col-xs-3">
                                {{ trans('dashboard.adspaces.position') }}: {{ $adspace->position }}
                            </div>
                            <div class="col-xs-3 text-right">
                                <a href="/dashboard/adspace/{{ $adspace->id }}/edit" class="btn btn-default">{{ trans('forms.edit') }}</a>
                                <a href="{{ route('dashboard.advertisement.create', ['adspace_id'=>$adspace->id]) }}" class="btn btn-default">{{ trans('forms.create') }}</a>
                                <a href="/dashboard/adspace/{{ $adspace->id }}/delete" class="btn btn-danger confirm-action" data-method='delete'>{{ trans('forms.delete') }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                     <div class="text-right">
                    <!-- Pager -->
                    {!! $adspaces->appends(Request::except('page', '_pjax'))->render() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
