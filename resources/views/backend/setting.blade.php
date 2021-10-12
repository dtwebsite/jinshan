@extends('backend.layouts.main')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>基本設定<small>Basic Setting</small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<form id="edit_form" class="form-horizontal form-label-left">
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">地址</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="address">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">英文地址</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="en_address">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">電話</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="phone">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">傳真</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="fax">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="email">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">LINE</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="line" placeholder="https://">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">FACEBOOK</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" class="form-control" name="facebook" placeholder="https://">
					</div>
				</div>
				<div class="ln_solid"></div>
				<div class="item form-group">
					<div class="col text-center">
						<button type="submit" class="btn btn-success">送出</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	setting_list();
	function setting_list(){
		$.get('{{ asset('admin/setting') }}',function(res){
			$.each(res,function(k,v){
				var name = v.name||'';
				var value = v.value||'';
				$('[name='+name+']').val(value);
			});
			setting_edit();
		});
	}

	function setting_edit(){
		$('#edit_form').submit(function(){
		var data = $(this).serializeArray();
		data.push({ name : "_method", value : "PUT"},{ name : "_token", value : "{{ csrf_token() }}"});
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/setting")}}/1',
			dataType:'json',
			data:data,
			success: function (e) {
				Swal.fire(
					e.message,
					'設定已修改。',
					e.status
				);
				setting_list();
			}
		})
		return false;
	});
	}
</script>
@endpush