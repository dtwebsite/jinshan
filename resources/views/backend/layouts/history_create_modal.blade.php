@section('history_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增歷史</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
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
							<label class="col-sm-2 control-label">順序</label>
							<div class="col-sm-10">
								<input type="number" value="1" name="sort" class="form-control" min="1" max="99999">
							</div>
						</div>
					</div>
					<input type="hidden" name="lang" value="">
					<input type="hidden" name="hid" value="">
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
	function history_create(){
		$('.create').click(function(){
			document.getElementById('create_form').reset();
			$('input[name=hid]').val('');
			var lang = $(this).data('lang');
			$('input[name=lang]').val(lang);
			if(lang == 'en'){
				var hid = $(this).data('hid');
				$('input[name=hid]').val(hid);
			}
			$('#modal-create').modal('show');
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/history")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增歷史。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				history_list(data);
			}
		})
		return false;
	});
</script>
@endpush