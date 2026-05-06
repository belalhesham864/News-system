@extends('layout.dashboard.app')
@section('title')
home 
@endsection
@section('body')
      <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <!-- Content Row -->
                @livewire('admin.statistics')

                    <!-- Content Row -->
<!--Charts-->
                    <div class="row">

                    <div class="card-body shadow col-6">

                    <h4>{{ $chart1->options['chart_title'] }}</h4>
                    {!! $chart1->renderHtml() !!}

                </div>
                    <div class="card-body shadow col-6">

                    <h4>{{ $chart_users->options['chart_title'] }}</h4>
                    {!! $chart_users->renderHtml() !!}

                </div>

                        <!-- Pie Chart -->
                  
                    </div>
                    <div class="row">

                    <div class="card-body shadow col-6">

                    <h4>{{ $chart_comment->options['chart_title'] }}</h4>
                   <div style="height: 550px; width: 550px;">
        {!! $chart_comment->renderHtml() !!}
    </div>

                </div>
                    <div class="card-body shadow col-6">

                    <h4>{{ $chart_contatct->options['chart_title'] }}</h4>
                    {!! $chart_contatct->renderHtml() !!}

                </div>

                        <!-- Pie Chart -->
                  
                    </div>

                    <!-- posts && comment Row -->
                  @livewire('admin.latest-posts-comment')

                </div>
@endsection
@push('js')

{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}

{!! $chart_users->renderJs() !!}
{!! $chart_comment->renderJs() !!}
{!! $chart_contatct->renderJs() !!}

@endpush