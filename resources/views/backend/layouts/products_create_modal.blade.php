@section('products_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增商品</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">名稱</label>
							<div class="col-sm-10">
								<input type="text" name="name" class="form-control" required="required" placeholder="請輸入商品名稱">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
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
							<label class="col-sm-2 control-label">內頁圖片</label>
							<div class="col-sm-10">
								<input id="detail_img" type="file" multiple accept="image/*" name="detail_img[]" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>633px X 633px</mark></p>
								<small class="text-danger">*中英文版的商品圖片，需分開上傳</small>
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
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-sm-10">
								<input type="number" value="0" name="sort" class="form-control" min="0" max="99999">
								<small class="form-text text-danger">請輸入商品排序(由大至小)</small>
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="product_id" value="">
					<button type="submit" class="btn btn-secondary float-right">儲存</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- 新增功能End --}}
@endsection
@push('script')
<script type="text/javascript">
	document.getElementById("img").required = true;
	document.getElementById("detail_img").required = true;
	function products_create(){
		$('.create').click(function(){
			document.getElementById('create_form').reset();
			$('input[name=product_id]').val('');
			var lang = $(this).data('lang');
			$('input[name=lang]').val(lang);
			if(lang == 'en'){
				var product_id = $(this).data('product_id');
				$('input[name=product_id]').val(product_id);
			}
			$('#modal-create').modal('show');
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/products")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增商品。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				products_list(data);
			}
		})
		return false;
	});
</script>
@endpush