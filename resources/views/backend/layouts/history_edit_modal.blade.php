@section('history_edit_modal')
{{-- 修改功能Start --}}
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">編輯歷史</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="edit_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">年份</label>
							<div class="col-sm-10">
								<input type="text" name="year" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">內容</label>
							<div class="col-sm-10">
								<textarea name="content" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 control-label">排序</label>
							<div class="col-sm-10">
								<input type="number" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="hid" value="">
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
	function history_edit(){
		$('.edit').click(function(){
			$('#modal-edit').modal('show');
			document.getElementById('edit_form').reset();
			var hid = $(this).data('hid');
			var data_lang = $(this).data('lang');
			$.get('{{ asset('admin/history') }}/'+hid+'/edit',function(res){
				$.each(res,function(k,v){
					var year = v.year||'';
					var content = v.content||'';
					var lang = v.lang||'';
					if(lang != data_lang){
						return;
					}else{
						$('[name=year]').val(year);
						$('[name=content]').val(content);
						$('[name=sort]').val(v.sort);
						$('[name=lang]').val(lang);
						$('[name=hid]').val(v.hid);
					}

				});
			});
		})
	}
	$('#edit_form').submit(function(){
		var formdata = new FormData(this);
		var hid = $('[name=hid]').val();
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/history")}}/'+hid,
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已修改歷史。',
					e.status
				);
				$('#modal-edit').modal('hide');
				var data = {};
				history_list(data);
			}
		})
		return false;
	});
</script>
@endpush