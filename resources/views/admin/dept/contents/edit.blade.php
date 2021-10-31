@extends('layouts/contentLayoutMaster')
@section('title', 'Contents')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

<form method="post" action="{{ route('contents.update', $contents->id) }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
              <label for="name">Type</label>
              <input type="text" class="form-control" name="typ" value="{{ $contents->typ }}"/>
          </div>
          <div class="form-group">
              <label for="details">Subject</label>
              <input type="text" class="form-control" name="subject" value="{{ $contents->subject }}"/>
          </div>
          <div class="form-group">
              <label for="consent_details">Body</label>
              <input type="textarea" class="form-control" name="body" value="{{ $contents->body }}"/>
          </div>
            <div class="row">
            {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$contents['status'])) !!}
            </div>
            <div class="row">
                {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Order","name"=>"ord","value"=>$contents['ord'])) !!}
                </div>
            <div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control" name="coverimg" value="{{ $contents->coverimg }}">
            </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
            <!-- <button type="submit" class="btn btn-block btn-danger">Update</button> -->
        </form>
@endsection