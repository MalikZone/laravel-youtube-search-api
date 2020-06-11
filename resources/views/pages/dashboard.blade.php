@extends('layouts.layout')

@section('content')
    
    <div id="content">
        <div class="col-md-12" style="padding:20px;">
            <div class="col-md-12 padding-0">
                <div class="col-md-8 padding-0">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-6">
                            <div class="panel box-v1">
                              <div class="panel-heading bg-white border-none">
                                <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                    <a href="{{route('video-search')}}"><h4 class="text-left">Video Search</h4></a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                   <h4>
                                   <span class="fa fa-youtube"></span>
                                   </h4>
                                </div>
                              </div>
                              <div class="panel-body text-center">
                                
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection