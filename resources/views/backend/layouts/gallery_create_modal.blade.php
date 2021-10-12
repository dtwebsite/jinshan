@section('gallery_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增花絮</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">日期</label>
							<div class="col-sm-10">
								<input type="text" name="date" class="form-control" required="required" placeholder="請輸入標題日期">
								<small class="form-text text-danger">日期格式(年.月.日):日期請務必用" . "作區隔，年用西元年後兩位數，EX: 21.10.27</small>
							</div>
						</div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">標題</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" required="required" placeholder="請輸入標題">
								<small class="form-text text-danger">字數限制:24個中文字內</small>
                            </div>
                        </div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">內容</label>
							<div class="col-sm-10">
								<textarea name="content" class="form-control" required="required" placeholder="請輸入花絮內容"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
								<input id="detail_img" type="file" multiple accept="image/*" name="detail_img[]" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>633px X 633px</mark></p>
								<small class="text-danger">*中英文版的花絮圖片，需分開上傳</small>
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
							<label class="col-sm-2 control-label">列表排序</label>
							<div class="col-sm-10">
								<input type="number" value="0" name="sort" class="form-control" min="0" max="99999">
								<small class="form-text text-danger">請輸入花絮的列表排序(由大至小)</small>
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="gallery_id" value="">
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
	document.getElementById("detail_img").required = true;
	function gallery_create(){
		$('.create').click(function(){
			document.getElementById('create_form').reset();
			$('input[name=gallery_id]').val('');
			var lang = $(this).data('lang');
			$('input[name=lang]').val(lang);
			if(lang == 'en'){
				var gallery_id = $(this).data('gallery_id');
				$('input[name=gallery_id]').val(gallery_id);
			}
			$('#modal-create').modal('show');
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/gallery")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增花絮。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				gallery_list(data);
			}
		})
		return false;
	});
</script>
@endpush