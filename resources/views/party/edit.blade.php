@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add A Party</div>

                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/party/edit') }}">
                      {!! csrf_field() !!}

                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Name</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="name" value="{{ $party->name }}">

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Description</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="description" value="{{ $party->description }}">

                              @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Address</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="address" value="{{ $party->address }}">

                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">City</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="city" value="{{ $party->city }}">

                              @if ($errors->has('city'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('city') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">State</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="state" value="{{ $party->state }}">

                              @if ($errors->has('state'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('state') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">ZIP</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="zip" value="{{ $party->zip }}">

                              @if ($errors->has('zip'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('zip') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('starts_at') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Starts At</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="starts_at" value="{{ $party->starts_at }}">

                              @if ($errors->has('starts_at'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('starts_at') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('ends_at') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Ends At</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="ends_at" value="{{ $party->ends_at }}">

                              @if ($errors->has('ends_at'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ends_at') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                          <label class="col-md-4 control-label">Price</label>

                          <div class="col-md-6">
                              <input type="text" class="form-control" name="price" value="{{ $party->price }}">

                              @if ($errors->has('price'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('price') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>


                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  <i class="fa fa-btn fa-user"></i>Add Party
                              </button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>


@endsection
