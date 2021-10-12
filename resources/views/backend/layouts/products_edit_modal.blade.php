@push('style')
<style type="text/css">
#modal-edit .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
}
#modal-edit .modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
#modal-edit .modal-body {
	overflow-y: auto;
}
#modal-edit{
	padding-right: 0 !important;
}
.detail_img img{
	width: 100%;
	display: block;
}
</style>
@endpush
@section('products_edit_modal')
{{-- 修改功能Start --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">編輯商品</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit_form">
				{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">名稱</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" required="required">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
								<div class="img_content"></div>
								<input id="img" type="file" accept="image/*" name="img" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>217px X 217px</mark></p>
								<small class="text-danger">*中英文版的商品圖片，需分開上傳</small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">特點</label>
							<div class="col-sm-10">
								<textarea name="features" class="form-control" placeholder="請輸入商品特點"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">用途</label>
							<div class="col-sm-10">
								<textarea name="application" class="form-control" placeholder="請輸入商品用途"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">材質</label>
							<div class="col-sm-10">
								<textarea name="material" class="form-control" placeholder="請輸入商品材質"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">狀態</label>
							<div class="col-sm-10">
								<select name="status" class="form-control">
									<option value="1" selected="selected">啟用</option>
									<option value="0">停用</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">順序</label>
							<div class="col-sm-10">
								<input type="number" name="sort" class="form-control" min="0" max="99999">
								<small class="form-text text-danger">請輸入商品排序(由大至小)</small>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">內頁圖片</label>
							<div class="col-sm-10">
								<input type="file" multiple accept="image/*" name="detail_img[]" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>633px X 633px</mark></p>
								<small class="text-danger">*中英文版的商品圖片，需分開上傳</small>
							</div>
						</div>
						<div class="detail_img"></div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="product_id" value="">
					<input type="hidden" name="_method" value="PUT">
					<button type="submit" class="btn btn-secondary float-right">儲存</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- 修改功能End --}}
@endsection
@push('script')
<script type="text/javascript">
	function products_edit(){
		$('.edit').click(function(){
			$('#modal-edit').modal('show');
			document.getElementById('edit_form').reset();
			var product_id = $(this).data('product_id');
			var data_lang = $(this).data('lang');
			$('.img_content').html('');
			$.get('{{ asset('admin/products') }}/'+product_id+'/edit',function(res){
				$.each(res,function(k,v){
					var name = v.name||'';
					var img = v.img||'';
					var features = v.features||'';
					var application = v.application||'';
					var material = v.material||'';
					var status = v.status||'';
					var lang = v.lang||'';
					if(lang != data_lang){
						return;
					}else{
						$('[name=name]').val(name);
						$('.img_content').append('<img src="/'+img+'">');
						$('[name=features]').val(features);
						$('[name=application]').val(application);
						$('[name=material]').val(material);
						$('[name=status]').val(status);
						$('[name=sort]').val(v.sort);
						$('[name=lang]').val(lang);
						$('[name=product_id]').val(v.product_id);
						var detail_img_str = '';
						$.each(v.detail_img,function(key,value){
							detail_img_str += '<div class="col-md-55">';
							detail_img_str +=	'<div class="thumbnail">';
							detail_img_str += 		'<div class="image view view-first">';
							detail_img_str += 			'<img src="/'+value.img+'" alt="image">';
							detail_img_str += 			'<div class="mask">';
							detail_img_str += 				'<div class="tools tools-bottom">';
							detail_img_str += 					'<a href="#"><i class="fa fa-pencil"></i></a>';
							detail_img_str += 					'<a href="#"><i class="fa fa-times"></i></a>';
							detail_img_str += 				'</div>';
							detail_img_str += 			'</div>';
							detail_img_str += 		'</div>';
							detail_img_str += 	'</div>';
							detail_img_str += '</div>';
						});
						$('.detail_img').html(detail_img_str);
					}
				});
			});
		})
	}

	$('#edit_form').submit(function(){
		var formdata = new FormData(this);
		var product_id = $('[name=product_id]').val();
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/products")}}/'+product_id,
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
				e.message,
				'已修改商品。',
				e.status
				);
				$('#modal-edit').modal('hide');
				var data = {};
				products_list(data);
			}
		})
		return false;
	});
</script>
@endpush