@section('process_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增製程</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">標題</label>
							<div class="col-sm-10">
								<input type="text" name="title" class="form-control" required="required" placeholder="請輸入製程名稱">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">首頁簡介</label>
							<div class="col-sm-10">
								<textarea name="content" class="form-control" placeholder="請輸入首頁簡介"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">內頁簡介</label>
							<div class="col-sm-10">
								<textarea name="inner_content" class="form-control" placeholder="請輸入內頁簡介"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
								<input id="img" type="file" accept="image/*" name="img" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>750px X 750px</mark></p>
								<small class="text-danger">*中英文版的製程圖片，需分開上傳</small>
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
								<input type="number" value="1" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="process_id" value="">
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
	function process_create(){
		$('.create').click(function(){
			document.getElementById('create_form').reset();
			$('input[name=process_id]').val('');
			var lang = $(this).data('lang');
			$('input[name=lang]').val(lang);
			if(lang == 'en'){
				var process_id = $(this).data('process_id');
				$('input[name=process_id]').val(process_id);
			}
			$('#modal-create').modal('show');
		})
	}
	$('#create_form').submit(function(){
		var data = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/process")}}',
			dataType:'json',
			data:data,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增製程。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				process_list(data);
			}
		})
		return false;
	});
</script>
@endpush