@extends('layouts.layout')

@section('content')

    {{-- <div id="content">
        <ul class="nav navbar-nav search-nav" style="margin-top: 20px">
            <li>
                <div class="search">
                    <div class="form-group form-animate-text">
                        <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                        <input type="text" class="form-text" required>
                        <span class="bar"></span>
                        <label class="label-search">Type anywhere to <b>Search</b> </label>
                    </div>
                </div>
            </li>
        </ul>
    </div> --}}

    <div id="content" class="search-v1">
        <div class="panel">
          <div class="panel-body">
            <div class="col-md-12">
                 <div class="input-group">
                  <input type="text" class="form-control" aria-label="...">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search</button>
                  </div><!-- /btn-group -->
                </div><!-- /input-group -->
            </div>
          </div>
        </div>
    </div>

@endsection