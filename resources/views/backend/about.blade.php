@extends('backend.layouts.main')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>簡介圖文<small>Introduction Graphic</small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<form id="edit_form" class="form-horizontal form-label-left">
				{{ csrf_field() }}
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">首圖1</label>
					<div class="col-md-6 col-sm-6 ">
						<img class="index_img1 w-50 mb-3" src="">
						<p>圖片尺寸:<mark>675px X 690px</mark></p>
						<input type="file" accept="image/*" name="index_img1" class="form-control">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">首圖2</label>
					<div class="col-md-6 col-sm-6 ">
						<img class="index_img2 w-50 mb-3" src="">
						<p>圖片尺寸:<mark>900px X 580px</mark></p>
						<input type="file" accept="image/*" name="index_img2" class="form-control">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">內圖1</label>
					<div class="col-md-6 col-sm-6 ">
						<img class="inner_img w-50 mb-3" src="">
						<p>圖片尺寸:<mark>535px X 855px</mark></p>
						<input type="file" accept="image/*" name="inner_img" class="form-control">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">簡介</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="introduction" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">簡介(英文版)</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="en_introduction" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">完整介紹</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="full_introduction" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">完整介紹(英文版)</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="en_full_introduction" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">品質</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="quality" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">品質(英文版)</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="en_quality" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">服務</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="service" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">服務(英文版)</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="en_service" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">創新</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="innovation" class="form-control" style="min-height:150px;"></textarea>
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-3 col-sm-3 label-align">創新(英文版)</label>
					<div class="col-md-6 col-sm-6 ">
						<textarea name="en_innovation" class="form-control" style="min-height:150px;"></textarea>
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
	about_list();
	function about_list(){
		$.get('{{ asset('admin/about') }}',function(res){
			$.each(res,function(k,v){
				var name = v.name||'';
				var value = v.value||'';
				if(name == 'index_img1' || name == 'index_img2' || name == 'inner_img'){
					$('.'+name).attr('src',value);
				}else{
					$('[name='+name+']').val(value);
				}
			});
			about_edit();
		});
	}

	function about_edit(){
		$('#edit_form').submit(function(){
		var data = new FormData(this);
		data.append('_method','PUT');
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/about")}}/1',
			dataType:'json',
			data:data,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'設定已修改。',
					e.status
				);
				about_list();
			}
		})
		return false;
	});
	}
</script>
@endpush