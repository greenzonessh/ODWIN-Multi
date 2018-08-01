<?php
	$breadcrumb = [];
	$breadcrumb[0]['title'] = 'Dashboard';
	$breadcrumb[0]['url'] = url('backend/dashboard');
	$breadcrumb[1]['title'] = 'Language';
	$breadcrumb[1]['url'] = url('backend/language');
	$breadcrumb[2]['title'] = 'Add';
	$breadcrumb[2]['url'] = url('backend/language/create');
	if (isset($data)){
		$breadcrumb[2]['title'] = 'Edit';
		$breadcrumb[2]['url'] = url('backend/language/'.$data[0]->id.'/edit');
	}
?>

<!-- LAYOUT -->
@extends('backend.layouts.main')

<!-- TITLE -->
@section('title')
	<?php
		$mode = "Create";
		if (isset($data)){
			$mode = "Edit";
		}
	?>
    Language - <?=$mode;?>
@endsection

<!-- CONTENT -->
@section('content')
	<?php
		$code = old('code');
		$name = old('name');
		$active = 1;
		$method = "POST";
		$mode = "Create";
		$url = "backend/language";
		if (isset($data)){
			$code = $data[0]->code;
			$name = $data[0]->name;
			$active = $data[0]->active;
			$method = "PUT";
			$mode = "Edit";
			$url = "backend/language/".$data[0]->id;
		}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3>Language</h3>
		</div>
		<div class="title_right">
			<div class="col-md-4 col-sm-4 col-xs-8 form-group pull-right top_search">
                @include('backend.elements.back_button',array('url' => '/backend/language'))
			</div>
        </div>
        <div class="clearfix"></div>
		@include('backend.elements.breadcrumb',array('breadcrumb' => $breadcrumb))
	</div>
	<div class="clearfix"></div>
	<br/><br/>	
	<div class="row">
		<div class="col-xs-12">
			<div class="x_panel">
				<div class="x_content">
                    @if ($errors->any())
                        <div class="row">
                            <div class="col-md-12 alert alert-danger alert-dismissible" role="alert">
                            {{ implode('', $errors->all(':message')) }}
                            </div>
                        </div>
                    @endif
					{{ Form::open(['url' => $url, 'method' => $method,'class' => 'form-horizontal']) }}
						{!! csrf_field() !!}
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Code <span class="required">*</span></label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" id="code" name="code" required="required" class="form-control" value="<?=$code;?>" autofocus>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
							<div class="col-sm-7 col-xs-12">
								<input type="text" id="name" name="name" required="required" class="form-control" value="<?=$name;?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 col-xs-12">Status </label>
							<div class="col-sm-5 col-xs-12">
								{{
								Form::select(
									'active',
									['1' => 'Active', '0' => 'Deactive'],
									$active,
									array(
										'class' => 'form-control',
									))
								}}								
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-sm-6 col-xs-12 col-sm-offset-3">
								<a href="<?=url('/backend/language')?>" class="btn btn-warning">Cancel</a>
								<button type="submit" class="btn btn-primary">Submit </button>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

<!-- CSS -->
@section('css')

@endsection

<!-- JAVASCRIPT -->
@section('script')

@endsection